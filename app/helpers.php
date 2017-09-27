<?php

HTML::macro('icon', function($icon, $text = '', $classes = [], $title = '', $id = '' ){
  $classes_str = implode(' ', $classes);
  $result = '<i class="fa fa-'.$icon.' '.$classes_str.'" title="'.$title.'" id="'.$id.'"></i>';
  if (!empty($text)) $result .= " $text";
  return $result;
});

HTML::macro('icon_link_to_route', function($route, $text = '', $icon = '', $link_params = [], $classes = [], $route_params = []) {
  $processed_params = [];
  foreach($link_params as $k => $v) {
    $processed_params[] = "$k=\"$v\"";
  };
  $link_params_str = implode(' ', $processed_params);
  $result  = "<a href=\"" . URL::route($route, $route_params) . "\" $link_params_str>";
  $result .= HTML::icon($icon, $text, $classes);
  $result .= "</a>";
  return $result;
});

HTML::macro('icon_link_to_url', function($url, $text = '', $icon = '', $link_params = [], $classes = [], $route_params = []) {
  $processed_params = [];
  foreach($link_params as $k => $v) {
    $processed_params[] = "$k=\"$v\"";
  };
  $link_params_str = implode(' ', $processed_params);
  $result  = "<a href=\"/$url\" $link_params_str>";
  $result .= HTML::icon($icon, $text, $classes);
  $result .= "</a>";
  return $result;
});

HTML::macro('active_if_route', function($route) {
  if (preg_match('/^' . preg_quote($route, '/') . '/', Route::currentRouteName())){
    return 'active';
  } else {
    return '';
  }
});

HTML::macro('form_field', function($model, $field, $label, $placeholder, $errors, $type = 'text') {
  $result = '<div class="form-group ';
  if ($errors->has($field)) $result .= 'has-error has-feedback';
  $result .= '">';
  $result .= Form::label($field, $label, ['class' => 'required col-sm-2 control-label']);
  $result .= '<div class="col-sm-10">';
  if ($type == 'password') {
    $result .= Form::password($field, ['class' => 'form-control']);
  } else {
    $result .= Form::$type($field, $model->$field, ['class' => 'form-control', 'placeholder' => $placeholder]);
  }
  if ($errors->has($field))
  {
    $result .= '<span class="fa fa-exclamation-triangle form-control-feedback"></span>';
    $result .= '<span class="help-block">' . $errors->first($field) . '</span>';
  }
  $result .= '</div>';
  $result .= '</div>';
  return $result;
});

HTML::macro('js', function($javascript) {
  $result = $javascript;
  $result = preg_replace('/[\n\r]/', '', $result);
  $result = preg_replace('/"/', '\"', $result);
  return $result;
});

HTML::macro('pluralize', function($number, $wordforms) {
  $number = $number % 100;
  if ($number>=11 && $number<=19) {
      $ending=$wordforms[2];
  }
  else {
      $i = $number % 10;
      switch ($i)
      {
          case (1): $ending = $wordforms[0]; break;
          case (2):
          case (3):
          case (4): $ending = $wordforms[1]; break;
          default: $ending=$wordforms[2];
      }
  }
  return "$number $ending";
});

HTML::macro('form_checkbox', function($field, $id, $label, $value, $checked, $errors ) {
	if ( !$id ) $id = $field;
	$result = '<input type="checkbox" value="'.$value.'" name="'.$field.'" id="'.$id.'"';
	if ( $checked )
		$result .= ' checked="checked" ';
	$result .= '/> <label for="'.$id.'">'.$label.'</label>';
	return $result;
});

HTML::macro('multi_level_select', function($field, $values, $set_values, $params, $optgroup = 1 ) {	
	$result = '<select name="'.$field.'" ';
	foreach ( $params as $key => $value ) {
		$result .= $key.'="'.$value.'" ';
	}
	$result .= '>'; $flag_group = 0;	
	foreach ( $values as $id => $value ) {		
		if ( in_array ( $value['id'], $set_values ) ) $selected = 'selected'; else $selected = '';
		if ( $optgroup ) {
			if ( isset ( $value['level'] ) && $value['level'] == 1 ) {
				if ( $flag_group ) { 
					$result .= "\n".'</optgroup>';
					$flag_group = 0;
				}
				$result .= "\n".'<optgroup label="'.$value['title'].'">';
				$flag_group = 1;
			}
			else {
				$margin = '';
				if ( isset ( $value['level'] ) && $value['level'] > 2 ) {
					$margin = 'class="margin-left'.($value['level']+$value['level']-4).'0"';
				}				
				$result .= "\n".'<option value="'.$value['id'].'" '.$selected.' '.$margin.'>'.$value['title'].'</option>';
			}
		}
		else {
			if ( isset ( $value['level'] ) && $value['level'] == 1 ) {
				$result .= "\n".'<option value="'.$value['id'].'" '.$selected.' class="option-bold">'.$value['title'].'</option>';
			}
			else {
				$margin = 'class="margin-left'.($value['level']+$value['level']-2).'0"';
				$result .= "\n".'<option value="'.$value['id'].'" '.$selected.' '.$margin.'>'.$value['title'].'</option>';
			}
		}
	}
	
	$result .= "\n".'</select>';
	return $result;
});

/**
 * Param
 */
function param($value){
	return Param::obtain($value);
}

function  aprint( $arr ) {
	echo '<pre>';
	print_r ( $arr );
	echo '</pre>';
}

function get_comments_count ( $count ) {
	if ( $count % 10 == 1 && $count % 100 != 11 )
		$res = $count.' комментарий';
	elseif ( ( $count % 10 == 2 || $count % 10 == 3 || $count % 10 == 4 ) && $count % 100 != 12 && $count % 100 != 13 && $count % 100 != 14 ) 
		$res = $count.' комментария';
	elseif ( $count  )
		$res = $count.' комментариев';
	else
		$res = '';
	return $res;
}

function get_contacts_word ( $count ) {
	if ( $count % 10 == 1 && $count % 100 != 11 )
		$res = 'контакт';
	elseif ( ( $count % 10 == 2 || $count % 10 == 3 || $count % 10 == 4 ) && $count % 100 != 12 && $count % 100 != 13 && $count % 100 != 14 ) 
		$res = 'контакта';
	else
		$res = 'контактов';
	return $res;
}

function get_money_word ( $count ) {
	if ( $count % 10 == 1 && $count % 100 != 11 )
		$res = 'рубль';
	elseif ( ( $count % 10 == 2 || $count % 10 == 3 || $count % 10 == 4 ) && $count % 100 != 12 && $count % 100 != 13 && $count % 100 != 14 ) 
		$res = 'рубля';
	else
		$res = 'рублей';		
	return $res;
}


function output_numbers ( $value, $word = 1 ) {
	$new_value = ''; $orig_value = $value;
	$flag = 0;
	while ( $value ) {
		if ( strlen($value) < 3 ) {
			$s = substr ( $value, -strlen($value) );			
			$flag = 1;
		}
		else {
			$s = substr ( $value, -3 );
		}	
		if ( !$new_value ) $new_value = $s;
		else
			$new_value = $s.'&nbsp;'.$new_value;
		if ( $flag ) {
			break;
		}
		else {
			$l = strlen($value) - 3;
			$value = substr ( $value, 0, $l );
		}
	}

	if ( $new_value ) {
		if ( $word == 1 )
			return $new_value.' '.get_money_word ( $orig_value );
		elseif ( $word == 3 )
			return $new_value.' '.get_contacts_word ( $orig_value );
		return $new_value;
	}
	else
		return 0;
}

function translit($text, $file_mode = true) {
	if($file_mode) {
		$text = trim($text);
		$text = strtr($text, Config::get('mdata/translit.symbols'));
		$text = strtr($text, Config::get('mdata/translit.letters'));
		$text = strtr($text, array('--' => '-', '---' => '-'));
	}

	$text = mb_strtolower($text);

	return $text;
}

function fa_ext($ext){
	$fa = [
		'txt' => 'file-text',
		'pdf' => 'file-pdf-o',
		'doc' => 'file-word-o',
		'exe' => 'file-exel-o',
		'zip' => 'file-archive-o',
		'rar' => 'file-archive-o'
	];

	if(array_key_exists($ext,$fa)){
		$icon = $fa[$ext];
	}else{
		$icon = 'file-o';
	}

	return $icon;
}

function setPaddingBounce($totals){

	if ($totals > 9){
		$padding = ' 6px 7px 6px 7px';
	}elseif($totals > 99){
		$padding = '9px 7px';
	}else{
		$padding = '4px 7px 3px 7px';
	}

	return $padding;
}

function replace_bg_color($text, $search = 'rgb(29, 196, 40)', $replace = '#824994'){

	return str_replace($search,$replace,$text);

}

function mobileDetect() {
	$md = null;
	if (is_null($md)) {
		include_once app_path() . '/support/Mobile_Detect.php';
		$md = new Mobile_Detect;
	}

	return $md;
}

function isMobile() {
	static $result = null;

	if (is_null($result)) {
		$md = mobileDetect();
		$result = $md->isMobile() && !$md->isTablet();
	}

	return $result;
}