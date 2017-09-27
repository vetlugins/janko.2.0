<?php

class SearchController extends BaseController {
	public function index () {		
		$page = Page::url ( 'search' )->firstOrFail ();
		$items = [];
		$search_query = Input::get ( 'search_query' );
		$page->page_title = $search_query;

		//Поиск по объектам каталога
		$objects_query = Objects::search ( $search_query, ['title', 'text'], [['id','desc']], -2 );	
		$objects = $objects_query->all();

		//Поиск по рубрикам каталога
		$rubrics_query = CatRubric::search ( $search_query, ['title', 'text'], [['id','desc']], -2 );	
		$rubrics = $rubrics_query->all();

		//Поиск по страницам
		$items_query = Page::search ( $search_query, ['title', 'full_text', 'short_text'], [['id','desc']], -2 );	
		$items = $items_query->all();

		//Поиск по новостям
		$news_query = News::search ( $search_query, ['title', 'text' , 'preview'], [['id','desc']], -2 );	
		$news = $news_query->all();

		//Поиск по услугам
		$services_query = Services::search ( $search_query, ['title', 'text'], [['id','desc']], -2 );	
		$services = $services_query->all();

		//Поиск по фото
		$photo_query = Album::search ( $search_query, ['title', 'text'], [['id','desc']], -2 );	
		$photos = $photo_query->all();


		$slides = Slider::visible()->get();


		if ( count ( $items or $news or $services or $photos or $rubrics or $objects ) )
			return View::make ( 'frontend.search', compact ( 'page', 'slides', 'rubrics', 'faq', 'objects', 'jobs', 'photos', 'services',  'items', 'news', 'search_query', 'simplePagination', 'items', 'message' ) );
		else {
			$message = 'К сожалению, по Вашему запросу ничего не найдено.';
			return View::make ( 'frontend.search', compact ( 'page', 'slides', 'rubrics', 'faq', 'objects', 'jobs', 'photos', 'services',  'items', 'news', 'search_query', 'simplePagination', 'items', 'message' ) );
		}
	}
}