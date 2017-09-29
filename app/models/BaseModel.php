<?php

class BaseModel extends Eloquent{

	public $errors = [];
	public static $paginate_count;

	/**
	 * Scopes
	 */
	public function scopeSUrl($query, $url, $field = 'url')
	{
		return $query->where($field, $url);
	}
	public function scopeSVisible($query){
		return $query->where('visible',1);
	}
	public function scopeSFirstLevel($query){
		return $query->where('parent_id',0);
	}
	public function scopeSSorted($query, $dir = 'asc', $field = 'position')
	{
		return $query->orderBy($field, $dir);
	}

	/**
	 * Validation
	 */
	protected function beforeValidation()
	{
		return true;
	}
	protected function validationRules()
	{
		return array();
	}
	protected function validator()
	{
		Validator::extend('unique_url', function($attribute, $value, $parameters) {
			if ( isset ( $parameters[1] ) ) {
				if ( Schema::hasColumn($parameters[0], 'deleted_at') )
					$check = DB::table($parameters[0])->where($attribute,'=',$value)->whereNull('deleted_at')->where('id','!=',$parameters[1])->first();
				else
					$check = DB::table($parameters[0])->where($attribute,'=',$value)->where('id','!=',$parameters[1])->first();
			}
			else {
				if ( Schema::hasColumn($parameters[0], 'deleted_at') )
					$check = DB::table($parameters[0])->where($attribute,'=',$value)->whereNull('deleted_at')->first();
				else
					$check = DB::table($parameters[0])->where($attribute,'=',$value)->first();
			}
			if ( isset ( $check->id ) )
				return 0;
			else
				return 1;
		});
		Validator::extend('banner_size', function($attribute, $value, $parameters) {
			if ( isset ( $parameters[0] ) )
				if ( !$value && !$parameters[0] )
					return 0;
				else
					return 1;
			else
				return 1;
		});
		Validator::extend('check_url', function( $attribute, $value, $parameters ) {
			$validator = Validator::make( [$attribute => $value], [$attribute => 'url'] );
			if ( $validator->fails () ) {
				$validator = Validator::make ( [$attribute => $value], [$attribute => 'regex:/^([a-z0-9\-\#\_])+$/'] );
				if ( $validator->fails() )
					return 0;
				else
					return 1;
			}
			else
				return 1;
		});

		return Validator::make($this->toArray(), $this->validationRules());
	}
	public function isValid()
	{
		$this->beforeValidation();
		$validator = $this->validator();
		$result = $validator->passes();
		$this->errors = $validator->messages();
		return $result;
	}

	/**
	 * Saver
	 */
	public function save(array $options = [])
	{
		if ($this->isValid()) {
			parent::save($options);
			return true;
		}
		return false;
	}
	public function forceSave(array $options = [])
	{
		return parent::save($options);
	}

	/**
	 * Save Files
	 */
	public function saveFiles($input_name = 'files', $input_prefix = '') {
		$files = Input::only($input_name)[$input_name] ?: [];
		$filenames = Input::get($input_prefix.'files');
		$file_ids = Input::get($input_prefix.'file_ids');
		$file_del = Input::get($input_prefix.'file_del');

		foreach ($files as $k => $doc) {
			if (!is_object($doc)) {
				if (isset($file_ids[$k])) {
					$file = Files::find($file_ids[$k]);
					if (!$file) continue;

					if (!empty($file_del[$k])) {
						$file->delete();
					} else {
						$file->title = array_get($filenames, $k);
						$file->save();
					}
				}

				continue;
			}

			$filename = $doc->getClientOriginalName();
			$dot = mb_strrpos($filename, '.', 0, 'UTF-8');
			$name = mb_substr($filename, 0, $dot, 'UTF-8');
			$ext = mb_substr($filename, $dot + 1, mb_strlen($filename, 'UTF-8') - $dot-1, 'UTF-8');

			$new_doc = new Files;
			$new_doc->filename = self::translit($name) . '.' . $ext;
			$new_doc->ext = $ext;
			//$new_doc->visible = 1;
			$new_doc->title = $name;
			$this->files()->save($new_doc);
			$path = $new_doc->get_path();

			if (!is_dir($path)) {
				mkdir($path, 0777, true);
			}

			$doc->move($path, $new_doc->filename);
		}

	}
	public function saveCover( $cover_attr, $destroy_original = 1 )
	{
		if ( isset ( $this->cover_styles ) && count ( $cover_attr ) )
		{
			if ($this->cover) {

				$this->cover->setParams( $this->cover_styles );

				$this->cover->fill($cover_attr)->trans_filename()->save();

				if ( $destroy_original ) $this->cover->image->destroy ( ['original'] );

			} else {

				$cover = new Cover;

				$cover->setParams( $this->cover_styles );

				$cover->fill($cover_attr)->trans_filename();

				$this->cover()->save($cover);

				if ( $destroy_original )$cover->image->destroy ( ['original'] );

			}
		}
	}

	/**
	 * Date Print
	 */
	public function printDate ( $field = 'date', $time = 0 ) {
		if ($this->$field) {
			if ( $time ) $format = 'd-m-Y'.' H:i';
			else $format = 'd-m-Y';
			return date ( $format, strtotime ( $this->$field ) );
		}
		else return '';
	}
	public function printRussianMonth($field = 'date', $time = 0) {
		$month = date ( 'n', strtotime ( $this->$field ) );
		if ($this->$field) {
			if ( $time ) {
				$month = date ( 'n', strtotime ( $this->$field ) );
			} else {
				$format = 'd-m-Y';
			}
			$format = 'd-m-Y'.' H:i';
			return str_limit($this->russian_months[$month], 3, '');
		}
		else return '';
	}
	public function printTime ( $field = 'date' ) {
		if ($this->$field) {
			return date ( 'H:i', strtotime ( $this->$field ) );
		}
		else return '';
	}


	/**
	 * Relations
	 */
	public function activities()
	{
		return $this->morphMany('Activity', 'observable');
	}
	public function afiles(){
		return $this->hasMany('Files','objectable_id');
	}
	public function files() {
		return $this->morphMany('Files', 'objectable');
	}

	/**
	 * jdata setter & getter
	 * метод для работы с полем 'jdata' у модели - поле json-данных
	 * если передан только первый аргумент, то возвращает значение для этого ключа
	 * если передан и второй аргумент, то устанавливает значение для ключа (который передан первым аргументом)
	 */
	public function jd() {
		$arguments = func_get_args();

		if (!array_key_exists(0, $arguments)) {
			return false;
		}
		$key = $arguments[0];
		if (array_key_exists(1, $arguments)) {
			return $this->setJsonAttr('jdata', $key, $arguments[1]);
		} else {
			return $this->getJsonAttr('jdata', $key);
		}
	}

	/**
	 * JSON
	 */
	public function setJsonAttr($attribute, $key, $value) {
		$json = json_decode($this->$attribute, $key) ?: [];
		if (is_null($key)) {
			$json = $value;
		} else {
			array_set($json, $key, $value);
		}
		$this->$attribute = json_encode($json);
		return $this;
	}
	public function getJsonAttr($attribute, $key = null) {
		$json = json_decode($this->$attribute, true) ?: [];
		$value = is_null($key) ? $json : array_get($json, $key);
		return $value;
	}
	public function getJsonAttrRaw($attribute, $key = null) {
		return json_encode($this->getJsonAttr($attribute, $key));
	}

	/**
	 * Make URL
	 */
	public function makeUrl($value = null, $checkUrlField = 'url')
	{
		$url = $this->translit($value ?: $this->title);
		$url = mb_strtolower($url);

		while(($last_symbol = substr($url, -1)) == '-')
		{
			$url = substr ($url, 0, - 1);
		}

		if (!$this->exists && !is_null($checkUrlField))
		{
			while(self::where($checkUrlField, $url)->first())
			{
				$url .= '-' . mt_rand(100, 999);
			}
		}

		return $url;
	}
	public static function translit($text,$file_mode=true)
	{
		$text=strtr($text, Config::get('mdata/translit.table'));

		if($file_mode)
		{
			$text=strtr($text, Config::get('mdata/translit.table_file'));
			$text=strtr($text,array('--'=>'-','---'=>'-'));
		}

		$text = mb_strtolower($text, 'utf-8');

		return $text;
	}
}