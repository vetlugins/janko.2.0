<?php

class ServicesController extends BaseController {

	protected $items_per_page = 6;

	public function index() {	
		$page = Page::url( 'about/services' )->firstOrFail();
		$services = Services::select('id','title','url','date', 'preview')->with('cover')->visible()->simplePaginate( $this->items_per_page );
		$slides = Slider::visible()->get();
		return View::make('frontend.services.index', compact( 'page', 'slides','services' ) + [ 'simplePagination' => $this->items_per_page ] );
	}

	public function show($url) {
		$service = Services::url($url)->get();
		$news = Page::url( 'about/services' )->firstOrFail();
		$newPage = Services::url ($url)->firstOrFail();
		$slides = Slider::visible()->get();
		return View::make('frontend.services.show', compact( 'service', 'slides' ) + array ( 'page' => $newPage , 'newss' => $news ) );
	}

}