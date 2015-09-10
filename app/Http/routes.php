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

Route::get('article/{name}', ['as' => 'show-article', 'uses' => 'PageController@article']);
Route::get('category/{name}', ['as' => 'show-category-article-list', 'uses' => 'PageController@category']);
Route::get('tag/{name}', ['as' => 'show-tag-article-list', 'uses' => 'PageController@tag']);
Route::get('archive/{year}/{month}', ['as' => 'show-archive-article-list', 'uses' => 'PageController@archive']);
Route::get('{name}', ['as' => 'show-page', 'uses' => 'PageController@page']);

Route::get('search/{searchKeyword}', ['as' => 'site-search', 'uses' => 'SearchController@search']);

Route::get('about', 'PageController@about');