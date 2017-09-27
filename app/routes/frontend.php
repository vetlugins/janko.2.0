<?php

// Главная
Route::get( '/', ['as' => 'home', 'uses' => 'HomeController@index']);

// Прочие страницы сайта
Route::get('/{all}', ['as' => 'index','uses' => 'PagesController@show'])->where('all', '^(?!system)[\s\S]*+');