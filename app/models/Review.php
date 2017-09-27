<?php
use Carbon\Carbon;

class Review extends BaseModel {	
	protected $guarded = ['id'];
	public $route = 'reviews';
	use CountOff;
	public $cover_styles = array (		
		'thumb' => '100x100#',
	);	
	
	public function __construct(array $attributes = array()) {
	    $this->setRawAttributes(array(
	      'date' => date ( 'Y-m-d' ),
		  'visible'	=> 1
	    ), true);		
	    parent::__construct($attributes);
	}	

	public function cover() {		
        return $this->morphOne('Cover', 'coverable');
	}
	
	public function scopeLatest($query, $count) {
		return $query->where('visible', 1)->orderBy('date', 'desc')->take($count);
	}
	
	public function scopeVisible ( $query ) {
		return $query->where('visible', 1)->orderBy('date', 'desc');
	}
	
	public function scopeUrl ( $query, $url ) {
		return $query->where ( 'url', $url )->where ( 'visible', 1 );
	}

	protected function validationRules() {		
		$rules['page_title'] = "max:255";
		$rules['page_description'] = "max:255";
		$rules['keywords']	= "max:255";			
		$rules['person_name']	= "max:255";
		$rules['contract']	= "max:255";
	    return $rules;
	}

	public static function updateStructure($changes) {
        if (is_string($changes)) $changes = json_decode($changes);
        foreach ($changes as $change) {
            $page = Review::find($change->id);
            if ($page) {                
                $page->insertAt($change->position);                
            }
        }
    }

}