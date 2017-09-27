<?php
class Param extends BaseModel {

	protected $table = 'site_params';
	protected $guarded = array ();
	public    $timestamps = false;

	public static function obtain($param)
	{
		return Param::where('id', $param)->pluck('value');
	}
		
}