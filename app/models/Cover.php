<?php

use Codesleeve\Stapler\ORM\StaplerableInterface;
use Codesleeve\Stapler\ORM\EloquentTrait;

class Cover extends BaseModel implements StaplerableInterface {

	use EloquentTrait;
	protected $guarded = ['id'];
	protected $image_quality = 90;

	public function __construct(array $attributes = []) {
		$this->hasAttachedFile('image', []);
    	parent::__construct($attributes);
    }
	
	public function setParams ( $styles, $name = 'image', $default_url = '/assets/frontend/covers/:style/missing2.png' )
	{
		foreach ( $styles as $type => $sizes )
		{
			if ( !is_array ( $sizes ) )
				$styles[$type] = [
					'dimensions' => $sizes,
					'convert_options' => [ 'quality' => $this->image_quality ]
				];
		}
		$this->hasAttachedFile( $name , [
        	'styles' => $styles,
            'default_url' => $default_url,			
    	]);
	}

    public function coverable() {
        return $this->morphTo()->withTrashed();
    }
	
	public function trans_filename ( $name = 'image' ) {
		$filename = $this->getAttribute ( $name.'_file_name' );
		if ( $filename ) {
			$filename = self::translit($filename);
			$filename = strtolower( $filename );
		}
		$this->setAttribute ( $name.'_file_name', $filename );
		return $this;
	}
	
	function delete_files ( $styles ) {				
		if ( is_array ( $styles ) ) {
			$arr = [];
			foreach ( $styles as $key => $values )
				$arr[] = $key;
			$this->image->destroy ( $arr );
		}
	}
}