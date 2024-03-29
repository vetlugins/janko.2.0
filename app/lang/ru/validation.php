<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| The following language lines contain the default error messages used by
	| the validator class. Some of these rules have multiple versions such
	| as the size rules. Feel free to tweak each of these messages here.
	|
	*/

	"accepted"             => "Необходимо принять :attribute.",
	"active_url"           => ":attribute - неправильный URL.",
	"after"                => "The :attribute must be a date after :date.",
	"alpha"                => "The :attribute may only contain letters.",
	"alpha_dash"           => "The :attribute may only contain letters, numbers, and dashes.",
	"alpha_num"            => "The :attribute may only contain letters and numbers.",
	"array"                => "The :attribute must be an array.",
	"before"               => "The :attribute must be a date before :date.",
	"between"              => array(
		"numeric" => "The :attribute must be between :min and :max.",
		"file"    => "The :attribute must be between :min and :max kilobytes.",
		"string"  => "The :attribute must be between :min and :max characters.",
		"array"   => "The :attribute must have between :min and :max items.",
	),
	"confirmed"            => "The :attribute confirmation does not match.",
	"date"                 => "The :attribute is not a valid date.",
	"date_format"          => "The :attribute does not match the format :format.",
	"different"            => "The :attribute and :other must be different.",
	"digits"               => "The :attribute must be :digits digits.",
	"digits_between"       => "The :attribute must be between :min and :max digits.",
	"email"                => "The :attribute must be a valid email address.",
	"exists"               => "The selected :attribute is invalid.",
	"image"                => "The :attribute must be an image.",
	"in"                   => "The selected :attribute is invalid.",
	"integer"              => "The :attribute must be an integer.",
	"ip"                   => "The :attribute must be a valid IP address.",
	"max"                  => array(
		"numeric" => "The :attribute may not be greater than :max.",
		"file"    => "The :attribute may not be greater than :max kilobytes.",
		"string"  => "Длина поля \":attribute\" не должна быть больше чем :max символов.",
		"array"   => "The :attribute may not have more than :max items.",
	),
	"mimes"                => "The :attribute must be a file of type: :values.",
	"min"                  => array(
		"numeric" => "The :attribute must be at least :min.",
		"file"    => "The :attribute must be at least :min kilobytes.",
		"string"  => ":attribute должен иметь длину хотя бы в :min символов.",
		"array"   => "The :attribute must have at least :min items.",
	),
	"not_in"               => "The selected :attribute is invalid.",
	"numeric"              => "The :attribute must be a number.",
	"regex"                => "The :attribute format is invalid.",
	"required"             => "Необходимо заполнить поле \":attribute\".",
	"required_if"          => "The :attribute field is required when :other is :value.",
	"required_with"        => "The :attribute field is required when :values is present.",
	"required_with_all"    => "The :attribute field is required when :values is present.",
	"required_without"     => "The :attribute field is required when :values is not present.",
	"required_without_all" => "The :attribute field is required when none of :values are present.",
	"same"                 => ":attribute и :other не совпадают.",
	"size"                 => array(
		"numeric" => "The :attribute must be :size.",
		"file"    => "The :attribute must be :size kilobytes.",
		"string"  => "The :attribute must be :size characters.",
		"array"   => "The :attribute must contain :size items.",
	),
	"unique"               => "Данные из поля \":attribute\" уже используются - необходимо указать другое значение.",
	"url"                  => "The :attribute format is invalid.",
	'banner_size'	=> 'Необходимо указать хотя бы один из размеров баннера.',

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Language Lines
	|--------------------------------------------------------------------------
	|
	| Here you may specify custom validation messages for attributes using the
	| convention "attribute.rule" to name the lines. This makes it quick to
	| specify a specific custom language line for a given attribute rule.
	|
	*/

	'custom' => array(		
		'url' 				=> array ( 'unique_url' => 'Этот URL уже используется.', 'regex' => 'URL содержит недопустимые символы.'  ),		
		'self_url'			=> array ( 'check_url' => 'URL содержит недопустимые символы.' ),
		'rubric_id'			=> array ( 'not_in'	=> 'Необходимо указать раздел афишы.' ),
		'object_id'			=> array ( 'not_in'	=> 'Необходимо указать объект каталога.' ),
		'time_start'		=> array ( 'date_format' => 'Время должно быть указано в формате ЧЧ:ММ.' ),
		'date'				=> array ( 'date_format' => 'Дата должна быть указана в формате ДД.ММ.ГГГГ.' ),
		'place_id'			=> array ( 'not_in' => 'Необходимо указать расположение.' ),
	
	),

	/*
	|--------------------------------------------------------------------------
	| Custom Validation Attributes
	|--------------------------------------------------------------------------
	|
	| The following language lines are used to swap attribute place-holders
	| with something more reader friendly such as E-Mail Address instead
	| of "email". This simply helps us make messages a little cleaner.
	|
	*/

	'attributes' => array(
		'title' => 'Заголовок',
		'url' => 'URL',
		'password' => 'Пароль',
		'password_confirmation' => 'Подтверждение пароля',
		'rubric_id'	=> 'Рубрика',		
		'time_start' => 'Время сеанса',
		'date'		=> 'Дата',
		'keywords' => 'Ключевые слова',
		'page_description' => 'Описание (description)',
		'page_title' => 'Заголовок окна браузера',
		'text'	=> 'Текст',
		'person_phone' => 'Телефон пользователя'
		
	),

);
