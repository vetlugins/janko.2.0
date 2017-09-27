<?php

class PhotosController extends BaseController {

	protected $items_per_page = 6;

	public function index() {
		$page = Page::url('photos')->firstOrFail();	
		$albums = Album::select('id','title','url','parent_id')->with('cover')->visible()->get();
		$slides = Slider::visible()->get();
		return View::make('frontend.photos.index', compact( 'page', 'albums', 'slides' ));
	}	

	public function show($url) {
		$page = Page::url('photos')->firstOrFail();
		$album = Album::url ( $url )->with('photos')->firstOrFail();
		$page_parents = [0 => array('url'=>'about/photo', 'title'=>'Фото'), 1 => array('title'=>$page->title) ];
		$slides = Slider::visible()->get();
		return View::make('frontend.photos.show', compact( 'page','album', 'page_parents', 'slides' ));
	}	

}