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

// Route::get('/', 'WelcomeController@index');

// Route::get('home', 'HomeController@index');

// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);

Route::pattern('id', '[0-9]+');

Route::get('/', 'IndexController@index');

Route::get('admin/login', 'Admin\MainController@login');
Route::post('admin/login', 'Admin\MainController@loginProgress');
Route::get('admin/logout', 'Admin\MainController@logout');

Route::group(['middleware' => 'auth', 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
    Route::get('/', 'MainController@index');
    Route::resource('article', 'ArticleController');
    Route::resource('category', 'CategoryController');
    Route::resource('nav', 'NavController');
    Route::resource('upload', 'UploadController');
    Route::resource('tag', 'TagController');
    Route::resource('static', 'ArticleStaticController', ['only' => ['create', 'store']]);
});

Route::get('article/{id}', 'PageController@article');
Route::get('category/{id}', 'PageController@category');
Route::get('tag/{id}', 'PageController@tag');
Route::get('{first}/{second?}', 'PageController@target')->where(['first'  => '[-_A-Za-z0-9]+',
                                                                 'second' => '[-_A-Za-z0-9]+'
]);
Route::get('about', 'PageController@about');