<?php
namespace Admin;
use Cover;
use Input;
use Log;
use News;
use Redirect;
use View;
use JavaScript;
use Cache;
use Response;
use Config;
use Language;

class SlidersController extends BaseController {	
	protected $params = array ( 'model' => 'Slider', 'route' => 'sliders', 'cover_type' => 'medium' );	

	public function visibility () {
		$model = $this->params['model'];
		$id = Input::get ( 'id' );
		$item = $model::find ( $id );		
		$item->visible = !$item->visible;
		$item->save ();		
		return Response::json ( array ( $item->visible ) );		
	}
	
	public function index() {
		$model = $this->params['model'];		
		$items = $model::lang()->orderBy('position')->get();
		$tree_data = [];		
		foreach( $items as $item ) { 
			$tree_data[] = $this->treeData( $item ); 
		}
        JavaScript::put([ 'items' => $tree_data ]);
		return View::make('admin.'.$this->params['route'].'.index', array ( 'items' => $items, 'params' => $this->params ) );
	}
	
	public function search() {
		$model = $this->params['model'];
		$query = Input::get('query');
		$this->params['query'] = $query;
		$items = $model::search ( $query );
		return View::make('admin.'.$this->params['route'].'.index', array ( 'items' => $items, 'params' => $this->params ) );
	}

	public function create() {
		$item 	 = new $this->params['model'];		
		$this->params['edit_type'] = 'create';
		return View::make('admin.'.$this->params['route'].'.edit' , array ( 'item' => $item, 'params' => $this->params ));
	}

	public function store() {
		$item = new $this->params['model'];		
       	$this->fillItem ( $item );
		$item->lang = Language::current ( 'admin' );
		$item->position = -1;
       	if ($item->save()) {
       		$this->saveAttachments($item);						
			$item->addNewToBottom ();
           	return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.edit', $item->id)
            	->with('success', trans('admin_messages.'.$this->params['route'].'.save_success', ['title' => $item->title]));
       	}
       	return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.create')
           ->withInput()
           ->with('error', trans('admin_messages.'.$this->params['route'].'.save_fail'))
           ->withErrors($item->errors);
	}

	public function edit($id) {
		$model = $this->params['model'];
		$item 	 = $model::findOrFail($id);
		if ( is_object ( $item->cover ) )
			$item->cover->setParams( $item->cover_styles );		
		$this->params['edit_type'] = 'edit';		
		$cover = $item->cover;		
		foreach ( Config::get ( 'data.langs' ) as $lang )
			$this->params['langs'][$lang['key']] = $lang['name'];				
		return View::make('admin.'.$this->params['route'].'.edit', array ( 'item' => $item, 'params' => $this->params ));
	}

	public function update($id) {	
		$model = $this->params['model'];
		$item = $model::findOrFail($id);		
		$this->fillItem ( $item );						
		if ($item->save()) {				
			$this->saveAttachments($item);
			return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.edit', $item->id)
					->with('success', trans('admin_messages.'.$this->params['route'].'.update_success', ['title' => $item->title]));
		}				
		return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.edit', $item->id)
			->withInput()
			->with('error', trans('admin_messages.'.$this->params['route'].'.update_fail'))
			->withErrors($item->errors);		
	}

	public function destroy( $id ) {
		$model = $this->params['model'];
		$item = $model::findOrFail($id);
		if ( is_object ( $item->cover  ) ) {
			$item->cover->delete_files ( $item->cover_styles );		
			$item->cover->delete ();
		}
		$item->delete();		
		return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.index')
		    ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success', ['title' => $item->title]) );
	}
	
	protected function saveAttachments($item) {
		$item->saveCover( $this->getCoverParams() );
	}
	
	protected function fillItem ( $item ) {
		$input = Input::except('cover');
		$item->fill ( $input );
		$item->visible = intval ( Input::get('visible') );			
	}

	protected function getCoverParams() {		
		return Input::only('cover')['cover'] ?: [];
	}

	public function structure() {	
		$model = $this->params['model'];
        $changes = Input::get('structure_changes');
		aprint ( $changes );
        $model::updateStructure($changes);
        return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.index')
                ->with('success', trans('admin_messages.'.$this->params['route'].'.structure_changed'));
    }
	
	protected function treeData ( $item ) {
		$result = [];
        $result['id']    = $item->id;
        $result['label'] = $item->title;		
        $result['original_position'] = $item->position;
        $result['position'] = $item->position;		
		$result['row'] = View::make ( 'admin.'.$this->params['route'].'.index_row', compact ( 'item' ) + ['params' => $this->params] )->__toString();
        return $result;
	}
		
}