<?php
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Team extends BaseModel {

	use SoftDeletingTrait;

	protected $guarded = ['id'];
	public $timestamps = false;
	//public $route = 'team';
	public $table = 'team';
	use CountOff;
	public $cover_styles = array (		
		'medium' => '220x220#',
	);	


	protected function beforeValidation() {

	}

	public function jobs() {
		return $this->belongsToMany('Job', 'team_jobs')->where('visible', 1);
	}

	public function getJobIds() {
		$ids = $this->jobs()->lists('id');
		return $ids;
	}

	public static function getAllTeam(){
		return Team::orderBy('name')->get();
	}
	
	public function __construct(array $attributes = array()) {
	    $this->setRawAttributes(array(
		  'visible'	=> 1
	    ), true);		
	    parent::__construct($attributes);
	}	

	public function cover() {		
        return $this->morphOne('Cover', 'coverable');
	}
		
	public function scopeVisible ( $query ) {
		return $query->where('visible', 1)->where('lang', Language::current() );
	}
	
	public function scopeUrl ( $query, $url ) {
		return $query->where ( 'url', $url )->where ( 'visible', 1 );
	}

	protected function validationRules() {		
		$rules['page_title'] = "max:255";
		$rules['page_description'] = "max:255";
		$rules['keywords']	= "max:255";			
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
	
	public function scopeLang ( $query ) {		
		$query->where ( 'lang', Language::current( 'admin' ) );
	}

}