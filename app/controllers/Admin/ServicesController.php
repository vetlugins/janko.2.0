<?php
namespace Admin;
use Cover;
use Input;
use Log;
use News;
use Redirect;
use View;
use Cache;
use Response;
use Config;
use Language;

class ServicesController extends BaseController {	

	protected $cache_pages = 5;
	public $params = [
		'model' => 'Services',
		'route' => 'services',
		'module' => 'Услуги'
	];

	public function visibility ()
	{
		$id = Input::get ( 'id' );

		$item = $this->getItem($id);

		$item->visible = !$item->visible;

		$item->save();

		return Response::json ( [$item->visible] );
	}

	public function index()
	{
		$model = $this->params['model'];
		$items = $model::orderBy('date', 'desc')->paginate( $model::$paginate_count );

		return View::make(
			$this->viewName(__FUNCTION__),
			[
				'items' => $items,
				'params' => $this->params
			]
		);
	}
	
	public function create()
	{
		$item 	 = new $this->params['model'];

		$this->params['edit_type'] = 'create';

		return View::make(
			$this->viewName(__FUNCTION__),
			[
				'item' => $item,
				'params' => $this->params
			]
		);
	}

	public function store()
	{
		$item = new $this->params['model'];

       	$this->fillItem ( $item );

       	if ($item->save()) {

       		$this->saveAttachments($item);			
			$this->clearCache ( $item );

           	return Redirect::route( 'admin.'.$this->params['route'].'.edit', $item->id)
            	->with('success', trans('admin_messages.'.$this->params['route'].'.save_success', ['title' => $item->title]));
       	}
       	return Redirect::route( 'admin.'.$this->params['route'].'.create')
           ->withInput()
           ->with('error', trans('admin_messages.'.$this->params['route'].'.save_fail'))
           ->withErrors($item->errors);
	}

	public function edit($id)
	{
		$item = $this->getItem($id);

		if ( is_object ( $item->cover ) ) $item->cover->setParams( $item->cover_styles );

		$this->params['edit_type'] = 'edit';

		return View::make(
			$this->viewName(__FUNCTION__),
			[
				'item' => $item,
				'params' => $this->params
			]
		);
	}

	public function update($id)
	{
		$item = $this->getItem($id);

		$this->fillItem ( $item );

		if ($item->save())
		{
			$this->saveAttachments($item);			
			$this->clearCache ( $item );		
			return Redirect::route( 'admin.'.$this->params['route'].'.edit', $item->id)
					->with('success', trans('admin_messages.'.$this->params['route'].'.update_success', ['title' => $item->title]));
		}

		return Redirect::route( 'admin.'.$this->params['route'].'.edit', $item->id)
			->withInput()
			->with('error', trans('admin_messages.'.$this->params['route'].'.update_fail'))
			->withErrors($item->errors);		
	}

	public function destroy( $id )
	{
		$item = $this->getItem($id);

		if ( is_object ( $item->cover  ) )
		{
			$item->cover->delete_files ( $item->cover_styles );		
			$item->cover->delete ();
		}
		$item->delete();

		return Redirect::route( 'admin.'.$this->params['route'].'.index')
		    ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success', ['title' => $item->title]) );
	}
	
	protected function saveAttachments($item)
	{
		$item->saveCover( $this->getCoverParams() );
	}
	
	protected function fillItem ( $item )
	{
		$input = Input::except('cover');
		$item->fill ( $input );
		$item->visible = intval ( Input::get('visible') );
	}

	protected function getCoverParams() {		
		return Input::only('cover')['cover'] ?: [];
	}
	
	protected function clearCacheBefore ( $item ) {
		
	}
	
	protected function clearCache ( $item ) {
		
	}

	public function getItem($id)
	{
		$model = $this->params['model'];
		return $model::findOrFail($id);
	}
}