<?php

class Role extends Eloquent {
	protected $fillable = ['name'];
	public $timestamps = false;

	public function users()
	{
		$this->belongsToMany('User');
	}
}