<?php

namespace Admin;
use \Hash;
use \Input;
use \Redirect;
use \User;
use \Validator;
use \View;

class UsersController extends BaseController{

	public $params = [
		'module' => 'Пользователи CMS',
		'route' => 'users',
		'model' => 'User'
	];
	function index()
	{
		$items = User::all();

		return View::make(
			$this->viewName(__FUNCTION__),
			[
				'items' => $items,
				'params' => $this->params
			]
		)->withUsers($items);
	}

	function create()
	{
		$items = new User;

		$this->params['edit_type'] = 'create';

		return View::make(
			$this->viewName(__FUNCTION__),
			[
				'items' => $items,
				'params' => $this->params
			]
		)->withUsers($items);
	}

	function store()
	{
		$items = new User;
		$attrs = $this->_userAttrs();

		$rules = [
			'email' 				=> 'required|email|unique:users',
			'password' 				=> 'required|min:6',
			'password_confirmation' => 'same:password'
		];

		$validator = Validator::make($attrs, $rules);

		if ($validator->fails()) return Redirect::route('admin.'.$this->params['route'].'.create' , ['items' => $items, 'params' => $this->params ])
											->withErrors($validator)
											->withError('Не удалось добавить пользователя')
											->withInput($attrs);

		$items->email    = Input::get('email');

		$items->name     = Input::get('name');

		$items->password = Hash::make(Input::get('password'));

		$items->save();

		return Redirect::route('admin.'.$this->params['route'].'.index' , ['items' => $items, 'params' => $this->params])->withSuccess('Пользователь добавлен.');
	}

	public function edit($id)
	{
		$items = User::query()
			->findOrFail($id)
		;

		$this->params['edit_type'] = 'edit';

		return View::make(
			$this->viewName(__FUNCTION__),
			[
				'items' => $items,
				'params' => $this->params
			]
		);
	}

	public function update($id)
	{
		$item = User::query()
			->findOrFail($id)
		;

		$this->fillItem ( $item );

		if ( Input::get('password') !== Input::get('password_confirmation') )
		{
			return Redirect::route('admin.'.$this->params['route'].'.edit')
				->withInput()
				->withErrors($item->errors)
				->with('error', trans('admin_messages.'.$this->params['route'].'.wrong_passwords') );
		}

		$item->password = Hash::make(Input::get('password'));

		if ($item->save())
		{
			//$this->clearCache ( $item );
			return Redirect::route('admin.'.$this->params['route'].'.edit', $item->id )
					->with('success', trans('admin_messages.'.$this->params['route'].'.update_success') );
		}		
		return Redirect::route('admin.'.$this->params['route'].'.create')
				->withInput()
				->withErrors($item->errors)
				->with('error', trans('admin_messages.'.$this->params['route'].'.update_fail') );
			
	}

	protected function fillItem( $item ) {		
		//$input = Input::all();
		$input = Input::except('password_confirmation');
		$item->fill ( $input );
		//$item->visible = intval ( Input::get('visible') );				
	}

	function destroy($id)
	{
		$items = User::query()
			->findOrFail($id)
		;

		$items->delete($id);

		return Redirect::route('admin.'.$this->params['route'].'.index')->withSuccess('Пользователь ' . $items->email . ' удален.');
	}

	private function _userAttrs()
	{
		return Input::only('email', 'name', 'password', 'password_confirmation');
	}
}