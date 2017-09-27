<?php

class NewsController extends BaseController {

	protected $items_per_page = 6;

	public function index() {	
		$page = Page::url( 'news' )->firstOrFail();
		$page_parents = $page->parents;		
		$news = News::select('id','title','url','date', 'preview')->with('cover')->visible()->simplePaginate( $this->items_per_page );
		$slides = Slider::visible()->get();
		return View::make('frontend.news.index', compact( 'page','slides', 'news' , 'page_parents' ) + [ 'simplePagination' => $this->items_per_page ] );
	}

	public function show($url) {
		$new = News::url($url)->get();
		$news = Page::url( 'news' )->firstOrFail();
		$newPage = News::url ($url)->firstOrFail();
		$slides = Slider::visible()->get();
		return View::make('frontend.news.show', compact( 'new' ) + array ( 'page' => $newPage , 'newss' => $news,'slides' => $slides ) );
	}

}