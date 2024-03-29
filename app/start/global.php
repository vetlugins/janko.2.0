<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',
	app_path().'/support'

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a basic log file setup which creates a single file for logs.
|
*/

Log::useFiles(storage_path().'/logs/laravel.log');

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/



App::error(function(Exception $exception, $code)
{
	if ( empty ( $_SESSION['less'] ) && Config::get('data.sandbox') != 1 )	
		return Response::view('frontend.errors.error404.error404', array(), 404);
});

App::missing(function($exception)
{
	//return Response::view('frontend.404', array(), 404);
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenance mode is in effect for the application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});

/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';

/*
|--------------------------------------------------------------------------
| Подключение вспомогательных
|--------------------------------------------------------------------------
|
| app/support/helpers.php содержит хэлперы для работы с HTML.
|
*/

require app_path().'/helpers.php';

Blade::extend(function($value) {
  return preg_replace('/(\s*)@(break|continue)(\s*)/', '$1<?php $2; ?>$3', $value);
});

Blade::extend(function($value) {
	return preg_replace('/\@define(.+)/', '<?php ${1}; ?>', $value);
});

Blade::extend(function($value) {
	return preg_replace('/\@php(.+)/', '<?php ${1}; ?>', $value);
});

/*
|--------------------------------------------------------------------------
| Подключение обзерверов и событий
|--------------------------------------------------------------------------
|
| Реагируем на изменения в приложении
|
*/
Page::observe(new ModelObserver);
News::observe(new ModelObserver);
Menu::observe(new ModelObserver);
Param::observe(new ModelObserver);
Photo::observe(new ModelObserver);
User::observe(new ModelObserver);


