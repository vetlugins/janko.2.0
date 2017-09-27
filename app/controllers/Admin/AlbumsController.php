<?php
namespace Admin;
use Cover;
use Input;
use Redirect;
use Rubric;
use View;
use Response;
use URL;
use JavaScript;
use Ancestry;
use Cache;
use Language;
use Config;

class AlbumsController extends BaseController {
	
	protected $params = array ( 'route' => 'albums', 'cover_type' => 'medium', 'model' => 'Album' );	
	
	public function search() {
		$model = $this->params['model'];
		$query = Input::get('query');
		$this->params['query'] = $query;
		$items = $model::search ( $query, ['title','text'], [['created_at','desc']] );
		return View::make('admin.'.$this->params['route'].'.index', array ( 'items' => $items, 'params' => $this->params ) );
	}
	
	public function index() {		
		$model = $this->params['model'];		
		$items = $model::lang()->where('parent_id',0)->orderBy('position')->get();
		$tree_data = [];
		foreach( $items as $item ) { 
			$tree_data[] = $this->treeData( $item ); 
		}
        JavaScript::put([ 'items' => $tree_data ]);	
		$this->params['parent_id'] = 0;		
		return View::make('admin.'.$this->params['route'].'.index', array ( 'items' => $items, 'params' => $this->params ) );
	}

	public function create( $parent_id = 0 ) {	
		$item = new $this->params['model'];
		$this->params['edit_type'] = 'create';
		$parents = $item->dropDownData ();
		$this->params['parent_id'] = $parent_id;
		$item->getParents ( $parent_id );
		return View::make('admin.'.$this->params['route'].'.edit', array ( 'item' => $item, 'parents' => $parents, 'params' => $this->params, 'parents_nav' => $item->parents ));
	}
	
	public function visibility () {
		$model = $this->params['model'];
		$id = Input::get ( 'id' );
		$item = $model::find ( $id );		
		$item->visible = !$item->visible;
		$item->save ();
		$this->clearCache ( $item );
		return Response::json ( array ( 1 ) );		
	}

	public function store() {
		$item = new $this->params['model'];
		$this->fillItem ( $item );
		$item->lang = Language::current ();
		$item->position = -1;
		if ($item->save()) {			
			$item->updateParent(0, Input::get('parent_id'));
			$item->addNewToBottom ();
			$item->saveCover( $this->getCoverParams() );			
			$this->clearCache ( $item );
			return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.edit', $item->id )
					->with('success', trans('admin_messages.'.$this->params['route'].'.save_success') );
		}
		return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.create')
				->withInput()
				->withErrors($item->errors)
				->with('error', trans('admin_messages.'.$this->params['route'].'.save_fail') );
	}

	public function edit( $id ) {
		$model = $this->params['model'];
		$item = $model::findOrFail($id);
		if ( $item->cover )
			$item->cover->setParams( $item->cover_styles );
		$this->params['edit_type'] = 'edit';	
		$parents = $item->dropDownData ();	
		$this->params['parent_id'] = $item->parent_id;
		$item->getParents ( $id );			
		foreach ( Config::get ( 'data.langs' ) as $lang )
			$this->params['langs'][$lang['key']] = $lang['name'];
		return View::make('admin.'.$this->params['route'].'.edit', array ( 'item' => $item, 'parents' => $parents, 'params' => $this->params, 'parents_nav' => $item->parents ));
	}

	public function update($id) {
		$model = $this->params['model'];
		$item = $model::findOrFail($id);
		$old_parent_id = $item->parent_id;
		$this->fillItem ( $item );
		if ($item->save()) {
			$item->updateParent($old_parent_id, Input::get('parent_id'));
			$item->saveCover( $this->getCoverParams() );
			$this->clearCache ( $item );
			return Redirect::route('admin.'.$this->params['route'].'.edit', $item->id)
					->with('success', trans('admin_messages.'.$this->params['route'].'.update_success') );
		}
		return Redirect::route('admin.'.$this->params['route'].'.edit', $item->id)
				->withInput()
				->withErrors($item->errors)
				->with('error', trans('admin_messages.'.$this->params['route'].'.update_fail') );
	}

	public function destroy($id) {
		$model = $this->params['model'];
		$item = $model::findOrFail($id);
		$item->cover->delete_files ( $item->cover_styles );
		$item->cover->delete ();
		$item->delete();
		$this->clearCache ( $item );
		return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.index')
		    ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success') );
	}
	
	public function show ( $id ) {
		$model = $this->params['model'];
		$item = $model::findOrFail ( $id );
        $items = $model::where('parent_id', $id)->orderBy('title', 'asc')->get();
		if ( !count($items) ) return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.edit', $id);
        $tree_data  = [];
        foreach( $items as $item ) { 
			$tree_data[] = $this->treeData( $item ); 
		}
        JavaScript::put([ 'items' => $tree_data ]);
		$this->params['parent_id'] = $id;		
		$item->getParents ( $id );		
		return View::make('admin.'.$this->params['route'].'.index', array ( 'items' => $items, 'params' => $this->params, 'parents_nav' => $item->parents ));
	}

	protected function fillItem( $item ) {		
		$input = Input::except('cover');
		$item->fill ( $input );
		$item->visible = intval ( Input::get('visible') );				
	}
	
	protected function getCoverParams() {
		return Input::only('cover')['cover'] ?: [];
	}
	
	function children( $id ) {
		$model = $this->params['model'];
        $page       = $model::findOrFail($id);
        $children   = Ancestry::query($page)->children()->orderBy('position')->get();
        $tree_data  = array();
        foreach( $children as $item ) { 
			$tree_data[] = $this->treeData( $item ); 
		}
        return Response::json($tree_data);
    }
	
	protected function treeData ( $item ) {
		$result = [];
        $result['id']    = $item->id;
        $result['label'] = $item->title;		
        $result['parent_id'] = $item->parent_id;
        $result['original_position'] = $item->position;
        $result['original_parent'] = $item->parent_id;
        $result['position'] = $item->position;		
		$result['children_url'] = URL::route ( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.children', $item->id );
		$result['row'] = View::make ( 'admin.'.$this->params['route'].'.index_row', compact ( 'item' ) + ['params' => $this->params] )->__toString();				
		$result['load_on_demand'] = ($item->children > 0);
        return $result;
	}
	
	public function structure() {	
		$model = $this->params['model'];
        $changes = Input::get('structure_changes');
        $model::updateStructure($changes);
        return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.index')
                ->with('success', trans('admin_messages.'.$this->params['route'].'.structure_changed'));
    }
	
	protected function clearCache ( $item ) {
		
	}
}