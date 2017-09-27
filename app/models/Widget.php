<?php

class Widget extends BaseModel {

    protected $guarded = ['id'];
	public $route = 'widgets';

	const WID_NUMBER = 1;
	const WID_ADVANTAGE = 2;
	const WID_SLIDER = 3;
	const WID_INFO = 4;

	protected function validationRules() {
		return [];
	}

	public function view($type){

		return Config::get('modules/widget.'.$type.'.view');

	}

	/**
	 * Scopes
	 */
	public function scopeSEnabled($query){
		return $query->where('enabled',1);
	}

}