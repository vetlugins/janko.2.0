<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get(   '/login',			['as' => 'admin.login', 		'uses' => 'SessionsController@create']);
    Route::post(  '/login',			['as' => 'admin.login.create', 	'uses' => 'SessionsController@store']);
    Route::delete('/logout', 		['as' => 'admin.logout', 		'uses' => 'SessionsController@destroy']);

    Route::get(   '/remind',		['as' => 'admin.password.remind', 'uses' => 'RemindersController@getRemind']);
    Route::post(  '/remind',		['as' => 'admin.password.remind', 'uses' => 'RemindersController@postRemind']);
    Route::get(   '/reset/{token}',	['as' => 'admin.password.reset', 'uses' => 'RemindersController@getReset']);
    Route::post(  '/reset',			['as' => 'admin.password.post_reset', 'uses' => 'RemindersController@postReset']);
});

Route::group(['prefix' => 'admin', 'before' => 'auth', 'namespace' => 'Admin'], function() {

    # Dashboard
    Route::get( '/', ['as' => 'admin', 'uses' => 'DashboardController@index']);

    # Users
    Route::resource('users', 'UsersController');
    Route::resource('users.activity', 'UsersActivityController', ['only' => 'index']);

    # Landing
    Route::put('/widgets/{id}', 	        ['as' => 'admin.widgets.update', 	        'uses' => 'WidgetsController@update']);
    Route::get('/widgets/{id}/edit', 	    ['as' => 'admin.widgets.edit', 	            'uses' => 'WidgetsController@edit']);
    Route::get('/widgets/visibility',       ['as' => 'admin.widgets.visibility',        'uses' => 'WidgetsController@visibility']);
    Route::post('/widgets/structure', 	    ['as' => 'admin.widgets.structure', 	    'uses' => 'WidgetsController@structure']);
    Route::get('/widgets/create', 	        ['as' => 'admin.widgets.create', 	        'uses' => 'WidgetsController@create']);
    Route::get('/widgets', 	                ['as' => 'admin.widgets.index', 	        'uses' => 'WidgetsController@index']);

    # Pages
    Route::post('/pages/structure', 	    ['as' => 'admin.pages.structure', 	    'uses' => 'PagesController@structure']);
    Route::post('/pages/{id}/restore', 	    ['as' => 'admin.pages.restore', 	    'uses' => 'PagesController@restore']);
    Route::get('/pages/visibility',         ['as' => 'admin.pages.visibility',      'uses' => 'PagesController@visibility']);
    Route::get('/pages', 	                ['as' => 'admin.pages.index', 	        'uses' => 'PagesController@index']);
    Route::get('/pages/{id}/edit', 	        ['as' => 'admin.pages.edit', 	        'uses' => 'PagesController@edit']);
    Route::get('/pages/create', 	        ['as' => 'admin.pages.create', 	        'uses' => 'PagesController@create']);
    Route::get('/pages/{id}', 	            ['as' => 'admin.pages.show', 	        'uses' => 'PagesController@show']);
    Route::post('/pages/store', 	        ['as' => 'admin.pages.store', 	        'uses' => 'PagesController@store']);
    Route::put('/pages/{id}', 	            ['as' => 'admin.pages.update', 	        'uses' => 'PagesController@update']);
    Route::delete('/pages/{id}', 	        ['as' => 'admin.pages.destroy', 	    'uses' => 'PagesController@destroy']);

    # Categories
    Route::get('/categories/visibility',        ['as' => 'admin.categories.visibility',     'uses' => 'CategoriesController@visibility']);
    Route::post('/categories/structure', 	    ['as' => 'admin.categories.structure', 	    'uses' => 'CategoriesController@structure']);
    Route::resource('categories', 'CategoriesController');

    # Products
    Route::resource('products', 'ProductsController');

    # Filters
    Route::post('/filters/structure',   ['as' => 'admin.filters.structure', 'uses' => 'FiltersController@structure']);
    Route::get('/filters/create', 	    ['as' => 'admin.filters.create',    'uses' => 'FiltersController@create']);
    Route::get('/filters/{type}',       ['as' => 'admin.filters.index',     'uses' => 'FiltersController@index'] );

    # Orders
    Route::resource('orders', 'OrdersController');

    # Photos
    Route::get('/photos/visibility',                            ['as' => 'admin.photos.visibility',         'uses' => 'PhotosController@visibility'] );
    Route::get('/photos/rotation',                              ['as' => 'admin.photos.rotation',           'uses' => 'PhotosController@rotation'] );
    Route::get('/photos/title',                                 ['as' => 'admin.photos.title',              'uses' => 'PhotosController@edit_title'] );
    Route::get('/photos/{object_type}/{object_id}',             ['as' => 'admin.photos.index',              'uses' => 'PhotosController@index'] );
    Route::get('/photos/{id}/edit',                             ['as' => 'admin.photos.edit',               'uses' => 'PhotosController@edit'] );
    Route::post('/photos/{object_type}/{object_id}',            ['as' => 'admin.photos.store',              'uses' => 'PhotosController@store'] );
    Route::get('/photos/{object_type}/{object_id}/create',      ['as' => 'admin.photos.create',             'uses' => 'PhotosController@create'] );
    Route::post('/photos/{object_type}/{object_id}/positions',  ['as' => 'admin.photos.update_position',    'uses' => 'PhotosController@update_position'] );
    Route::delete('/photos/{id}',                               ['as' => 'admin.photos.destroy',            'uses' => 'PhotosController@destroy'] );

    # Files
    Route::get('/files/visibility',                             ['as' => 'admin.files.visibility',          'uses' => 'FilesController@visibility'] );
    Route::get('/files/rotation',                               ['as' => 'admin.files.rotation',            'uses' => 'FilesController@rotation'] );
    Route::get('/files/title',                                  ['as' => 'admin.files.title',               'uses' => 'FilesController@edit_title'] );
    Route::get('/files/{object_type}/{object_id}',              ['as' => 'admin.files.index',               'uses' => 'FilesController@index'] );
    Route::get('/files/{id}/edit',                              ['as' => 'admin.files.edit',                'uses' => 'FilesController@edit'] );
    Route::post('/files/{object_type}/{object_id}',             ['as' => 'admin.files.store',               'uses' => 'FilesController@store'] );
    Route::post('/files/{object_type}/{object_id}/positions',   ['as' => 'admin.files.update_position',     'uses' => 'FilesController@update_position'] );
    Route::delete('/files/{id}',                                ['as' => 'admin.files.destroy',             'uses' => 'FilesController@destroy'] );

    # Услуги
    Route::get('/services/search',      ['as' => 'admin.services.search',       'uses' => 'ServicesController@search']);
    Route::get('/services/visibility',  ['as' => 'admin.services.visibility',   'uses' => 'ServicesController@visibility']);
    Route::post('/services/structure', 	['as' => 'admin.services.structure', 	'uses' => 'ServicesController@structure']);
    Route::get('/services', 	        ['as' => 'admin.services.index', 	    'uses' => 'ServicesController@index']);
    Route::get('/services/{id}/edit', 	['as' => 'admin.services.edit', 	    'uses' => 'ServicesController@edit']);
    Route::get('/services/create', 	    ['as' => 'admin.services.create', 	    'uses' => 'ServicesController@create']);
    Route::get('/services/{id}', 	    ['as' => 'admin.services.show', 	    'uses' => 'ServicesController@show']);
    Route::post('/services/store', 	    ['as' => 'admin.services.store', 	    'uses' => 'ServicesController@store']);
    Route::put('/services/{id}', 	    ['as' => 'admin.services.update', 	    'uses' => 'ServicesController@update']);
    Route::delete('/services/{id}', 	['as' => 'admin.services.destroy', 	    'uses' => 'ServicesController@destroy']);

    # Новости
    Route::get('/news/search',      ['as' => 'admin.news.search',       'uses' => 'NewsController@search']);
    Route::get('/news/visibility',  ['as' => 'admin.news.visibility',   'uses' => 'NewsController@visibility']);
    Route::post('/news/structure', 	['as' => 'admin.news.structure', 	'uses' => 'NewsController@structure']);
    Route::get('/news', 	        ['as' => 'admin.news.index', 	    'uses' => 'NewsController@index']);
    Route::get('/news/{id}/edit', 	['as' => 'admin.news.edit', 	    'uses' => 'NewsController@edit']);
    Route::get('/news/create', 	    ['as' => 'admin.news.create', 	    'uses' => 'NewsController@create']);
    Route::get('/news/{id}', 	    ['as' => 'admin.news.show', 	    'uses' => 'NewsController@show']);
    Route::post('/news/store', 	    ['as' => 'admin.news.store', 	    'uses' => 'NewsController@store']);
    Route::put('/news/{id}', 	    ['as' => 'admin.news.update', 	    'uses' => 'NewsController@update']);
    Route::delete('/news/{id}', 	['as' => 'admin.news.destroy', 	    'uses' => 'NewsController@destroy']);
});