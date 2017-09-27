<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Carbon\Carbon;

class Services extends BaseModel {

	use SoftDeletingTrait;		
	protected $guarded = ['id'];
	public $route = 'services';
	public $cover_styles = [
		'big'	=> '1000x550',
		'medium' => '600x350',
		'thumb' => '250x150',
	];

	public function __construct(array $attributes = [])
	{
		$this->setRawAttributes([
			'visible'	=> 1
		], true);

		parent::__construct($attributes);
	}

	/**
	 * Validation
	 */
	protected function beforeValidation()
	{
		if (!$this->url) $this->url = $this->translit($this->title);

		$last_symbol = substr ( $this->url, strlen ( $this->url ) - 1, 1 );

		if ( $last_symbol == '-' ) $this->url = substr ( $this->url, 0, strlen ( $this->url ) - 1 );

	}

	protected function validationRules()
	{
		$rules['title'] = "required|max:255";

		if ($this->exists) {
			$rules['url'] = "required|max:240|unique_url:services,$this->id|regex:/^([a-z0-9\-])+$/";
		} else {
			$rules['url'] = "required|max:240|unique_url:services|regex:/^([a-z0-9\-])+$/";
		}

		return $rules;
	}

	/**
	 * Relations
	 */
	public function cover() {		
        return $this->morphOne('Cover', 'coverable');
	}
	public function photos () {
		return $this->morphMany('Photo', 'object')->sVisible()->orderBy('position');
	}
	public function aphotos () {
		return $this->morphMany('Photo', 'object')->orderBy('position');
	}




}