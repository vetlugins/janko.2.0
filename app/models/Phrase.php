<?php

class Phrase extends BaseModel
{	
	protected $guarded = ['id'];
	public $route = 'phrase';

/*
	protected function beforeValidation() {
		if (!$this->url) $this->url = $this->translit($this->title);
		$last_symbol = substr ( $this->url, strlen ( $this->url ) - 1, 1 );
		if ( $last_symbol == '-' ) 
			$this->url = substr ( $this->url, 0, strlen ( $this->url ) - 1 );
	}
	
	public function __construct(array $attributes = array()) {
	    $this->setRawAttributes(array(
	      'date' => Carbon::now(),
		  'visible'	=> 1		  
	    ), true);		
	    parent::__construct($attributes);
	}	

	public function cover() {		
        return $this->morphOne('Cover', 'coverable');
	}
	
	public function photos () {
		return $this->morphMany('Photo', 'object')->where('visible',1)->orderBy('position');
	}
	
	public function aphotos () {
		return $this->morphMany('Photo', 'object')->orderBy('position');
	}

	public function scopeLatest($query, $count) {
		return $query->where('visible', 1)->orderBy('date', 'desc')->take($count);
	}
	
	public function scopeVisible ( $query ) {
		return $query->where('visible', 1)->orderBy('date', 'desc');
	}

	public function scopeLang($query, $lang) {
		return $query->where('lang', $lang);
	} 

	public function scopeUrl ( $query, $url ) {
		return $query->where ( 'url', $url )->where ( 'visible', 1 );
	}

	protected function validationRules() {
		$rules['title'] = "required|max:255";	    	    
		$rules['page_title'] = "max:255";
		$rules['page_description'] = "required|max:255";
		$rules['keywords']	= "required|max:255";			
		
		if ($this->exists) {
			$rules['url'] = "required|max:240|unique_url:news,$this->id|regex:/^([a-z0-9\-])+$/";
		} else {
			$rules['url'] = "required|max:240|unique_url:news|regex:/^([a-z0-9\-])+$/";
		}		

	    return $rules;
	}
*/	
}