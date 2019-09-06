<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', 'PageController@about')->name('about.index');

Route::resource('/articles', 'ArticleController');

// Route::get('/articles', 'ArticleController@index')->name('articles.index');
// Route::post('/articles', 'ArticleController@create')->name('articles.create');

// Route::get('/articles/new', 'ArticleController@new')->name('articles.new');

// Route::get('/articles/{id}/edit', 'ArticleController@edit')->name('articles.edit');
// Route::patch('/articles/{id}/update', 'ArticleController@update')->name('articles.update');
// Route::delete('/articles/{id}', 'ArticleController@delete')->name('articles.delete');

// Route::get('/articles/{id}', 'ArticleController@show')->name('articles.show');