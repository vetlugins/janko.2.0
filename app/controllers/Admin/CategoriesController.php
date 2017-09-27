<?php
namespace Admin;

use Input;
use Redirect;
use Category;
use View;
use Response;
use Config;
use DB;
use Cache;
use URL;

class CategoriesController extends BaseController {

	public $params = [
		'module' => 'Катагории каталога',
		'route' => 'categories',
		'model' => 'Category',
	];

	public function index()
	{
		$model = $this->params['model'];

		$items = $model::query()
			->sFirstLevel()
			->orderBy('position', 'asc')
			->get()
		;

		$this->params['parent_id'] = 0;

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
		$item = new $this->params['model'];

		$this->params['edit_type'] = 'create';

		return View::make(
			$this->viewName(__FUNCTION__),
			[
				'item' => $item,
				'params' => $this->getParams(__FUNCTION__),
			]
		);
	}
	
	public function store()
	{
		$item = new $this->params['model'];

		$this->fillItem ( $item );

		if ($item->save())
		{
			return Redirect::route('admin.'.$this->params['route'].'.edit', $item->id )
					->with('success', trans('admin_messages.save_success'));
		}				
		return Redirect::route('admin.create')
				->withInput()
				->withErrors($item->errors)
				->with('error', trans('admin_messages.save_fail'));
	}

	public function edit($id) {

		$item =$this->getItem($id);

		$this->params['edit_type'] = 'edit';

		return View::make(
			$this->viewName(__FUNCTION__),
			[
				'item' => $item,
				'params' => $this->getParams(__FUNCTION__),
			]
		);
	}

	public function update($id)
	{
		$item =$this->getItem($id);

		$this->fillItem ( $item );

		if ($item->save())
		{
			return Redirect::route('admin.'.$this->params['route'].'.edit', $item->id)
					->with('success', trans('admin_messages.update_success'));
		}
		return Redirect::route('admin.'.$this->params['route'].'.edit', $item->id)
				->withInput()
				->withErrors($item->errors)
				->with('error', trans('admin_messages.update_fail'));
	}

	public function destroy($id)
	{
		$item =$this->getItem($id);

		$item->delete();

		return Redirect::route('admin.'.$this->params['route'].'.index')
		    ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success'));
	}

	public function visibility ()
	{
		$model = $this->params['model'];

		$id = Input::get ( 'id' );

		$item = $model::find ( $id );

		$item->visible = !$item->visible;

		$item->save ();

		return Response::json ([ $item->visible ] );
	}

	public function structure()
	{
		$model = $this->params['model'];
		$items = \Input::get('array_order');

		$count = 1;

		foreach ($items as $id_val)
		{
			$model::where('id','=',$id_val)
				->update(['position' => $count])
			;

			$count ++;
		}

	}
	

	protected function fillItem( $item )
	{
		$input = Input::all();
		$item->fill ( $input );
		$item->visible = intval ( Input::get('visible') );				
	}

	public function getItem($id)
	{
		$model = $this->params['model'];
		return $model::findOrFail($id);
	}

	public function getParams($method = null, $item = null)
	{
		$params = $this->params;

		if (in_array($method, ['create', 'edit']))
		{
			// parent pages
			$pages = Category::query()->sFirstLevel();

			if ($method == 'edit' && $item) {
				$pages->where('id', '!=', $item->id);
			}

			$pages = $pages->lists('title', 'id');

			$params['parentPages'] =
				[0 => 'Верхний уровень']
				+
				$pages
			;
		}

		return $params;
	}
}