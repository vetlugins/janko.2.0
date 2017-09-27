<?php

class DocumentsController extends BaseController {

	protected $items_per_page = 50;

	public function index($url = false) {

		$model  = new Documents();
		$page   = Page::url('about/documents')->firstOrFail();
		$slides = Slider::visible()->get();

		$rubrics = $model->rubrics;

		if(!$url) $url = 'ies';

		$docs = $model->docs($url)->paginate($this->items_per_page);

		return View::make('frontend.documents.index', compact( 'page', 'slides','rubrics','url','docs') + [ 'simplePagination' => $this->items_per_page ] );
	}
}