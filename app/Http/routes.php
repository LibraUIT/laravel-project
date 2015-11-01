<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [
    'as' => 'home', 'uses' => 'HomeController@index'
]);

Route::match(['get', 'post'] ,'/join', [
	'as' => 'sing_up', 'uses' => 'SignController@up'
]);

Route::match(['get', 'post'] ,'/auth/login', [
    'as' => 'login', 'uses' => 'SignController@in'
]);

Route::get('/logout', [
    'as' => 'logout', 'uses' => 'SignController@out'
]);

Route::match(['get', 'post'],'/forgot', [
	'as' => 'forgot', 'uses' => 'SignController@forgot'
]);

Route::match(['get', 'post'], '/contact', [
	'as' => 'contact', 'uses' => 'PagesController@contact'
]);

Route::get('/about', [
	'as' => 'about','uses' => 'PagesController@about'
]);

Route::get('/404', [
	'as' => '404','uses' => 'PagesController@page_404'
]);

Route::group(['namespace' => 'Api'], function()
{
    // Controllers Within The "App\Http\Controllers\Api" Namespace

    Route::group(['namespace' => 'Layout'], function()
    {
        // Controllers Within The "App\Http\Controllers\Api\Layout" Namespace

        Route::get('/api/layout_options/get_home_page', [
			'as' => 'get_home_page_layout_config','uses' => 'LayoutsController@getHomePageConfig'
		]);
        Route::post('/api/layout_options/set_home_page', [
            'as' => 'set_home_page_layout_config','uses' => 'LayoutsController@setHomePageConfig'
        ]);
    });

    Route::group(['namespace' => 'Filemanager'], function()
    {
        // Controllers Within The "App\Http\Controllers\Api\Filemanager" Namespace
        Route::post('/api/file_manager/upload_single_file', [
            'as' => 'upload_single_file','uses' => 'FilemanagerController@uploadSingleFile'
        ]);
        Route::post('/api/file_manager/get_all', [
            'as' => 'file_manager_get_all','uses' => 'FilemanagerController@getAll'
        ]);
        Route::post('/api/file_manager/delete_single_file', [
            'as' => 'delete_single_file','uses' => 'FilemanagerController@deleteSingleFile'
        ]);
        
    });
    Route::group(['namespace' => 'Widget'], function()
    {
        // Controllers Within The "App\Http\Controllers\Api\Widget" Namespace
        Route::get('/api/widgets/get_main_slider', [
            'as' => 'get_main_slider','uses' => 'WidgetsController@getMainSlider'
        ]);
        Route::post('/api/widgets/set_main_slider', [
            'as' => 'set_main_slider','uses' => 'WidgetsController@setMainSlider'
        ]);
        Route::post('/api/widgets/add_gallery', [
            'as' => 'add_gallery','uses' => 'WidgetsController@addGallery'
        ]);
        Route::post('/api/widgets/delete_gallery_by_id', [
            'as' => 'delete_gallery_by_id','uses' => 'WidgetsController@delGalleryById'
        ]);
        Route::get('/api/widgets/get_all_gallery', [
            'as' => 'get_all_gallery','uses' => 'WidgetsController@getAllGallery'
        ]);
        Route::get('/api/widgets/get_pagination_gallery', [
            'as' => 'get_pagination_gallery','uses' => 'WidgetsController@getPaginationGallery'
        ]);
    });
    Route::group(['namespace' => 'Setting'], function()
    {
        // Controllers Within The "App\Http\Controllers\Api\Setting" Namespace
        Route::get('/api/settings/get_general', [
            'as' => 'get_general','uses' => 'SettingsController@getGeneral'
        ]);
        Route::post('/api/settings/set_general', [
            'as' => 'set_general','uses' => 'SettingsController@setGeneral'
        ]);
    });
});
