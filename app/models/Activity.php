<?php

class Activity extends BaseModel
{
	protected $guarded = ['id'];

	public function observable()
	{
		return $this->morphTo()->withTrashed();
	}

	public function user()
	{
		return $this->belongsTo('User');
	}
}