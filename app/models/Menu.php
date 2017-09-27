<?php

class Menu extends BaseModel {

	protected $table = 'menus';
	protected $guarded = array ();
	public $timestamps = false;
	
	public function pages() {
	    return $this->belongsToMany('Page');
	}

}