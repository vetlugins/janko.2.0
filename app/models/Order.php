<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;


class Order extends BaseModel {
	public $timestamps = false;
	protected $guarded = ['id'];
	protected $file_path = '/system/Email';
		
	public function objects() {
		return $this->belongsToMany( 'Objects', 'order_objects', 'order_id', 'objects_id' )->withPivot ( 'amount', 'cost', 'discount' );
	}	
}
