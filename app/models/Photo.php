<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Photo extends Cover {

	protected $guarded = ['id'];
	public $timestamps = false;
	public $cover_styles = [
		'thumb' => '310x232#',
		'medium' => '471x346#',
		'big' => '640x427#'

		/*'admin'	=> 'x150',
		'cart'   => '80x60#',
		'basecart' => '60x100#',
		'thumb'	=> '310x232#',
		'big'	=> '640x427#',
		'medium'	=> '750',

		'small1' => '80x80#',
		'medium1'=> '471x346#',
		'big1'   => '1037x777',
		'thumb1' => '240x250#',*/
	];

	public function objectable () {
		return $this->morphTo();
	}
}