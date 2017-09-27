<?php

class BaseController extends Controller {

	public $params = [];

	public $viewNames = [
		'index' => 'index.index',
		'edit' => 'edit.edit',
		'create' => 'edit.edit',
		'show' => 'show.show',
	];

	public function __construct()
	{
		// Session
		if (!@session_start()) {
			session_regenerate_id(true);
			session_start();
		}

		// Menu
		$this->getMenu('top');
		View::share ( 'top_menu', $this->menus );
	}

	/**
	 * Menu
	 */
	private function getMenu($type) {

		$this->menus = [];

		$menu = Menu::where('type',$type)->first();

		if ( $menu )
		{
			$this->menus = $menu->pages()->select('id','title','url')->sFirstLevel()->sVisible()->orderBy('position','asc')->get();

			foreach ( $this->menus as $menu_item )
			{
				$menu_item->sub_menu = $menu->pages()->select('title','url','self_url')->sVisible()->where('parent_id', $menu_item->id )->orderBy('position','asc')->get();
			}
		}

	}

	public function viewName($method)
	{
		return 'frontend.' . $this->getRoute() . '.' . array_get($this->viewNames, $method, "{$method}.{$method}");
	}

	public function getRoute()
	{
		return $this->getParam('route');
	}

	public function getParam($param)
	{
		return array_get($this->params, $param);
	}
}
