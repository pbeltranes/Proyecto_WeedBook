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

Route::get('/', 'ReviewController@index');//index
Route::get('/home', ['as' => 'home', 'uses' => 'ReviewController@index']); //index /home
Route::controllers([
 	'auth' => 'Auth\AuthController',
 	'password' => 'Auth\PasswordController',
]); //auth

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::group(['middleware' => ['auth']], function()
{
	Route::get('new-review', 'ReviewController@create');
	Route::post('new-review', 'ReviewController@save');
	Route::get('edit/{slug}', 'ReviewController@edit');
	Route::post('update', 'ReviewController@update');
	Route::get('delete/{id}', 'ReviewController@destroy');
	Route::get('my-all-review', 'ReviewController@user_reviews_draft');
	Route::get('comment/add', 'CommentController@create');
	Route::post('comment/save', 'CommentController@save');
	Route::post('comment/delete/{id}', 'CommentController@destroy');
	Route::post('comment/update', 'CommentController@update');
	Route::get('comment/edit/{id}', 'CommentController@edit');
}); // Acciones que solo pueden hacer los usuarios logueados

Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+');

Route::get('user/{id}/edit', 'UserController@edit')->where('id', '[0-9]+');
Route::post('user/edit/save', 'UserController@save')->where('id', '[0-9]+');

Route::get('user/{id}/reviews', 'UserController@user_reviews')->where('id', '[0-9]+');
Route::get('/{slug}', ['as' => 'review', 'uses' => 'ReviewController@show'])->where('slug', '[A-Za-z0-9-_]+');
