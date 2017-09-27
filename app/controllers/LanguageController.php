<?php

class LanguageController extends BaseController {
	public function switchToLang ( $lang = '' ) {				
		return Redirect::to ( '/'.$lang );		
	}
}