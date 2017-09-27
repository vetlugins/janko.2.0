<?php
namespace Admin;
use Input;
use Redirect;
use Rubric;
use View;
use Response;
use Cache;
use DB;
use Language;

class ContactsController extends BaseController {	
	protected $params = array ( 'route' => 'contacts', 'model' => 'Contacts' );	
	
	public function index() {		
		$model = $this->params['model'];		
		$items = $model::lang()->orderBy('name')->paginate(30);		
		return View::make('admin.'.$this->params['route'].'.index', array ( 'items' => $items, 'params' => $this->params ) );
	}

	public function create() {	
		$item = new $this->params['model'];
		$this->params['edit_type'] = 'create';
		return View::make('admin.'.$this->params['route'].'.edit', array ( 'item' => $item, 'params' => $this->params ));
	}
	
	public function store() {
		$item = new $this->params['model'];
		$item->fill($this->getFillParams());
		$item->lang = Language::current ( 'admin' );
		if ($item->save()) {						
			return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.index')
					->with('success', trans('admin_messages.'.$this->params['route'].'.save_success') );
		}
		return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.create')
				->withInput()
				->withErrors($item->errors)
				->with('error', trans('admin_messages.'.$this->params['route'].'.save_fail') );
	}

	public function edit($id) {		
		$model = $this->params['model'];
		$item = $model::findOrFail($id);
		$this->params['edit_type'] = 'edit';
		return View::make('admin.'.$this->params['route'].'.edit', array ( 'item' => $item, 'params' => $this->params ));
	}

	public function update($id) {
		$model = $this->params['model'];
		$item = $model::findOrFail($id);		
		$item->fill($this->getFillParams());
		if ($item->save()) {						
			return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.edit', $item->id)
					->with('success', trans('admin_messages.'.$this->params['route'].'.update_success') );
		}
		return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.edit', $item->id)
				->withInput()
				->withErrors($item->errors)
				->with('error', trans('admin_messages.'.$this->params['route'].'.update_fail') );
				
	}

	public function destroy($id) {
		$model = $this->params['model'];
		$item = $model::findOrFail($id);
		$item->delete();		
		return Redirect::route( Language::route ( 'admin' ).'admin.'.$this->params['route'].'.index')
		    ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success') );
	}

	protected function getFillParams() {
		return Input::all();
	}	
}