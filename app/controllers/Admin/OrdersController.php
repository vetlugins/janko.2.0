<?php
namespace Admin;
use Cover;
use Input;
use Log;
use Redirect;
use View;
use Cache;
use Response;

class OrdersController extends BaseController {	
	protected $params = array ( 'model' => 'Order', 'route' => 'orders' );	
	
	public function index( $status = -1 ) {
		$model = $this->params['model'];
		$query = $model::orderBy('date', 'desc');
		if ( $status != -1 )
			$query->where( 'status', $status );			
		$items = $query->paginate( $model::$paginate_count );
		foreach ( $items as $item ) {
			$item->title = 'Заказ №'.$item->id;
		}
		return View::make('admin.'.$this->params['route'].'.index', array ( 'items' => $items, 'params' => $this->params ) );
	}
	
	public function search() {
		$model = $this->params['model'];
		$query = Input::get('query');
		$this->params['query'] = $query;
		$items = $model::search ( $query, ['person_name', 'person_phone', 'person_address'] );
		return View::make('admin.'.$this->params['route'].'.index', array ( 'items' => $items, 'params' => $this->params ) );
	}
	
	public function edit($id) {
		$model = $this->params['model'];
		$item 	 = $model::findOrFail($id);
		$this->params['edit_type'] = 'edit';		
		$item->title = 'Заказ №'.$item->id;	
		return View::make('admin.'.$this->params['route'].'.edit', array ( 'item' => $item, 'params' => $this->params ));
	}

	public function update($id) {	
		$model = $this->params['model'];
		$item = $model::findOrFail($id);		
		$this->fillItem ( $item );				
		if ($item->save()) {	
			return Redirect::route('admin.'.$this->params['route'].'.edit', $item->id)
					->with('success', trans('admin_messages.'.$this->params['route'].'.update_success', ['title' => $item->title]));
		}				
		return Redirect::route('admin.'.$this->params['route'].'.edit', $item->id)
			->withInput()
			->with('error', trans('admin_messages.'.$this->params['route'].'.update_fail'))
			->withErrors($item->errors);		
	}	
	
	protected function fillItem ( $item ) {
		$input = Input::all();
		$item->fill ( $input );		
	}

	public function destroy( $id ) {
		$model = $this->params['model'];
		$item = $model::findOrFail($id);		
		$item->delete();
		return Redirect::route('admin.'.$this->params['route'].'.index')
		    ->with('success', trans('admin_messages.'.$this->params['route'].'.delete_success', ['title' => $item->title]) );
	}
}