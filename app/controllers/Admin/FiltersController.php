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
				'params' => $this->params
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
		/*if (in_array($method, ['create', 'edit', 'index'])) {
			$categories = Category::query()
				->sFirstLevel()
				->sSorted()
				->with(['subCategories' => function($subCategory) {
					$subCategory->sSorted();
				}])
				->get()
			;
			$categoriesList = [];
			$optionsAttributes = [];
			foreach ($categories as $category) {
				$categoriesList[$category->id] = $category->title;
				$optionsAttributes[$category->id] = ['data-level' => 1];
				foreach ($category->subCategories as $subCategory) {
					$categoriesList[$subCategory->id] = $subCategory->title;
					$optionsAttributes[$subCategory->id] = ['data-level' => 2];
				}
			}
			$params['categoriesList'] = $categoriesList;
			$params['optionsAttributes'] = $optionsAttributes;
		}
		if (in_array($method, ['index', 'edit', 'create'])) {
			$params['vendorsList'] = ProductVendor::query()->sSorted()->pluck('title', 'id')->toArray();
			$params['materialsList'] = ProductMaterial::query()->sSorted()->pluck('title', 'id')->toArray();
		}
		if (in_array($method, ['imported'])) {
			$params['storesList'] = Store::query()->pluck('title', 'id')->toArray();
		}*/
		return $params;
	}

}