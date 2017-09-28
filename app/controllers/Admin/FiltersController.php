<?php
namespace Admin;

use Config;
use Cover;
use Input;
use Log;
use Product;
use Redirect;
use Category;
use View;
use Filter;
use Cache;
use Response;

class FiltersController extends BaseController {

	public $params = [
		'module' => 'Фильтры каталога',
		'route' => 'filters',
		'model' => 'Filter',
	];

	public function index($type)
	{
		$filter = Filter::query()
			->sType($type)
			->firstOrFail();

		$items = Filter::query()
			->get();

		return View::make(
			$this->viewName(__FUNCTION__),
			compact('filter','items')+
			[
				'params' => $this->getParams(__FUNCTION__)
			]
		);
	}

	public function create()
	{
		$item = new $this->params['model'];

		$categories = Category::query()
						->sFirstLevel()
						->sVisible()
						->get();

		return View::make(
			$this->viewName(__FUNCTION__), compact(
				'item'
			) + array(
				'categories' => $categories,
				'params' => $this->getParams(__FUNCTION__, $item),
				'edit_type' => __FUNCTION__,
			)
		);
	}

	public function getParams($method = null, $item = null)
	{
		$params = $this->params;

		return $params;
	}

}