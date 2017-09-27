<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Page extends BaseModel {

    use SoftDeletingTrait;

    protected $guarded = ['id'];
	public $route = 'pages';

	protected $fillable = [
		'title',
		'url',
		'self_url',
		'short_text',
		'full_text',
		'h1',
		'h1_color',
		'h1_subtext',
		'h1_subtext_color',
		'page_title',
		'page_description',
		'page_keywords',
		'seo',
		'parent_id'
	];

	public $cover_styles = [
		'big'	=> '1900x1000',
		'medium' => '600x350',
		'thumb' => '250x150',
	];

	public function __construct(array $attributes = array()) {
		$this->setRawAttributes([
			'visible' => 1,
		]);
		return parent::__construct($attributes);
	}

	/**
	 * Validation
	 */

	public function beforeValidation()
	{
		if (!$this->url) $this->url = $this->makeUrl();
	}

	protected function validationRules()
	{
		$rules = [
			'title' => 'required',
		];

		if ($this->exists) {
			$rules['url'] = "required|unique:{$this->getTable()},url,$this->id";
		} else {
			$rules['url'] = "required|unique:{$this->getTable()}";
		}

		return $rules;
	}

	/**
	 * Relations
	 */
	public function parents(){
		return $this->hasMany('Page','parent_id');
	}
	public function cover() {
		return $this->morphOne('Cover', 'coverable');
	}
	public function menu() {
        return $this->belongsToMany('Menu');
    }
	public function photos () {
		return $this->morphMany ( 'Photo', 'object' )->where('visible',1)->orderByRaw("RAND()");
	}
	public function aphotos () {
		return $this->morphMany('Photo', 'object')->orderBy('position');
	}
	public function activities() {
        return $this->morphMany('Activity', 'observable');
    }
	public function subPages() {
		return $this->hasMany('Page', 'parent_id');
	}

	/**
	 * Get URL
	 */
	public function getUrl ()
	{
		if ( $this->url == 'index' ) return 'http://'.Config::get('data.base_url').'/';

		if ( strpos ( $this->url, 'http://' ) === false ) return 'http://'.Config::get('data.base_url').'/'.$this->url;
	}

}