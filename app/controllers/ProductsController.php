<?php
class ProductsController extends BaseController {

	public $params = [
		'type' => array('products' => 'Продукция','components' => 'Компоненты'),
		'items_per_page' => 6
	];

	public function index($type='') {

		$type = $type ? $type : 'products';

		// максимальное/минимальное значение цены товара
		$max_cost = Objects::visible()->with('cover')->type($type)->max('cost');
		$min_cost = Objects::visible()->with('cover')->type($type)->min('cost');
		$_COOKIE['max_cost'] = $max_cost;

		// фильтр сортировки товара по диапазону цены
		if ( !isset($_COOKIE['min_range']) || !isset($_COOKIE['max_range']) ) {
			$min_range = $min_cost;
			$max_range = $max_cost;
		} else {
			$min_range = $_COOKIE['min_range'];
			$max_range = $_COOKIE['max_range'];
		}

		$objects = 	Objects::visible()->with('cover')->where('cost', '>=', $min_range)->where('cost', '<=', $max_range)->type($type)->orderBy('id','desc')->paginate($this->params['items_per_page'] );

		foreach ( $objects as $object ) {
			if ( CartController::inBasket ( $object->id ) )
				$object->in_basket = 1;
			else
				$object->in_basket = 0;
		}

		$page = Page::url('catalog')->firstOrFail();

		$latest = $this->retrieveRecentProducts($page->id);

		foreach ( $latest as $object ) {
			if ( CartController::inBasket ( $object->id ) )
				$object->in_basket = 1;
			else
				$object->in_basket = 0;
		}

		$this->params['categories'] = [
			'products'   => CatRubric::visible()->type('products')->with('cover')->where('parent_id', 0)->orderBy('position')->get(),
			'components' => CatRubric::visible()->type('components')->with('cover')->where('parent_id', 0)->orderBy('position')->get()
		];
		$this->params['totals'] = [
			'products' =>  Objects::visible()->type('products')->count(),
			'components' => Objects::visible()->type('components')->count()
		];
		$this->params['slides']                = Slider::visible()->get();

		return View::make('frontend.products.index', compact('type', 'page', 'latest', 'objects', 'max_cost', 'min_cost' , 'min_range' , 'max_range') + [ 'simplePagination' => $this->params['items_per_page'],'params' => $this->params ]);
	}

	public function rubric($rubric_url) {

		if ( CatRubric::visible()->where('url' , $rubric_url )->pluck('children') == 0 ) {
			$parent_id = CatRubric::visible()->where('url' , $rubric_url )->pluck('id');
			$parent_id  = array($parent_id);
		} else {
			$parent_id = CatRubric::visible()->where('url' , $rubric_url )->pluck('id');
			$childrens_id = CatRubric::visible()->where('parent_id' , $parent_id )->lists('id');
			$parent_id = CatRubric::visible()->whereIn('id' , $childrens_id )->lists('id');
		}

		$url = $rubric_url;
		$category = CatRubric::url($url)->firstOrFail();
		$type = $category->type;

		// максимальное/минимальное значение цены товара
		$max_cost = Objects::visible()->with('cover')->type($type)->max('cost');
		$min_cost = Objects::visible()->with('cover')->type($type)->min('cost');

		$_COOKIE['max_cost'] = $max_cost;
		// фильтр сортировки товара по диапазону цены
		if ( !isset($_COOKIE['min_range']) || !isset($_COOKIE['max_range']) ) {
			$min_range = $min_cost;
			$max_range = $max_cost;
		} else {
			$min_range = $_COOKIE['min_range'];
			$max_range = $_COOKIE['max_range'];
		}

		$objects = 	Objects::visible()->with('cover')->where('cost', '>=', $min_range)->where('cost', '<=', $max_range)->whereIn('catrubric_id', $parent_id)->orderBy('id','desc')->paginate($this->params['items_per_page'] );

		$page = Page::url('catalog')->firstOrFail();

		$latest = $this->retrieveRecentProducts($page->id);

		foreach ( $latest as $object ) {
			if ( CartController::inBasket ( $object->id ) )
				$object->in_basket = 1;
			else
				$object->in_basket = 0;
		}

		$this->params['categories'] = [
			'products'   => CatRubric::visible()->type('products')->with('cover')->where('parent_id', 0)->orderBy('position')->get(),
			'components' => CatRubric::visible()->type('components')->with('cover')->where('parent_id', 0)->orderBy('position')->get()
		];
		$this->params['totals'] = [
			'products' =>  Objects::visible()->type('products')->count(),
			'components' => Objects::visible()->type('components')->count()
		];
		$this->params['slides']                = Slider::visible()->get();


		return View::make('frontend.products.index', compact( 'category', 'page', 'latest', 'url' ,'type', 'objects', 'max_cost', 'min_cost' , 'min_range' , 'max_range') + [ 'simplePagination' => $this->params['items_per_page'],'params' => $this->params ]);
	}	

	public function pushToRecentProducts($id) {
		$latest = Session::get('latest');
		$latest[] = $id;
		$latest = array_unique($latest);
		if ( count($latest) > 30 )  $latest = array_slice($latest, 15);
		Session::put('latest', $latest);		
	}

	public function retrieveRecentProducts($id) {
		$latestItems = Session::get('latest') ? : [];
		$latestItems = array_diff( $latestItems, [$id] );
		if ( !count($latestItems) ) return [];
		$latestItems = array_reverse($latestItems);
		$ids = implode(',', $latestItems);
		$recent = Objects::whereIn('id', $latestItems)->orderByRaw(DB::raw("FIELD(id, $ids)") )->take(9)->get();
		return $recent;
	}

	public function item( $page ) {

		$catalog = Page::url('catalog')->firstOrFail();
		$latest = $this->retrieveRecentProducts($page->id);

		foreach ( $latest as $object ) {
			if ( CartController::inBasket ( $object->id ) )
				$object->in_basket = 1;
			else
				$object->in_basket = 0;
		}

		$this->pushToRecentProducts($page->id);

		if ( CartController::inBasket ( $page->id ) )
			$page->in_basket = 1;
		else
			$page->in_basket = 0;

		$this->params['slides'] = Slider::visible()->get();

		return View::make('frontend.products.item', compact( 'page') + array ( 'catalogs' => $catalog,'params' => $this->params ));
	}

	public function url ( $url ) {
		//получаем адрес после последнего слэша
		$page = Objects::url ( $url )->with('cover', 'photos')->first();
		if ( $page )
			return $this->item ( $page );
		else
			return $this->rubric ( $url );
		
	}

	public function lookup($id){

		$services = Objects::find($id);

		$item = [
			'services' => $services->title,
		];

		return Response::json($item);
	}

}