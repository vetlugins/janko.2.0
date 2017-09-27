<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Filter extends BaseModel {

	protected $guarded = ['id'];
	public $route = 'filters';

	/**
	 * Scope
	 */
	public function scopeSType($query,$type){
		return $query->where('type',$type);
	}

}
