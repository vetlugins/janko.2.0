<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Product extends BaseModel {

	use SoftDeletingTrait;	

	protected $guarded = ['id'];
	public $route = 'products';
	public $table = 'products';



}
