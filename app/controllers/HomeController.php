<?php

class HomeController extends BaseController {

	public $params = [
		'route' => 'home'
	];

	public function index() {

		// Страница
		$page = Page::query()
			->sUrl('index')
			->sVisible()
			->firstOrFail();

		return View::make(
			$this->viewName(__FUNCTION__),
			compact('page')+
			['params' => $this->params]
		);
	}
}
