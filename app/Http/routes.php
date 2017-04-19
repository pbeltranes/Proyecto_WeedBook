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
	Route::get('new-review', 'ReviewController@create'); // Usado para crear
	Route::post('new-review', 'ReviewController@store'); // Usado para mostrar
	Route::get('review/{id_review}/edit', 'ReviewController@edit'); // Usado para editar perfil
	Route::post('update', 'ReviewController@update');
	Route::get('delete/{id}', 'ReviewController@destroy');
  	Route::get('user/{id}/reviews', 'ReviewController@showUserReviews') ->where('id', '[0-9]+');//*****(*) // ver reviews del usuario {id}
	Route::get('comment/add', 'CommentController@create');
	Route::post('comment/save', 'CommentController@save');
	Route::get('comment/delete/{id}', 'CommentController@destroy');
	Route::post('comment/update', 'CommentController@update');
	Route::get('comment/edit/{id}', 'CommentController@edit');
	Route::get('user/{id}/edit', 'UserController@edit')->where('id', '[0-9]+');
	Route::post('user/edit/save', 'UserController@save')->where('id', '[0-9]+');
	Route::get('user/delete/{id}', 'UserController@destroy');
	Route::get('review/{review_id}/new-strain', 'StrainController@create');
	Route::post('review/save-strain', 'StrainController@store');
	Route::get('review/{review_id}/delete-strain/{id}', 'StrainController@delete');
	Route::get('review/{review_id}/update-strain/{id}', 'StrainController@update');

	Route::get('admin/update-api', 'StrainController@updateApi');
}); // Acciones que solo pueden hacer los usuarios logueados

Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+');
Route::get('user/{id}/edit', 'UserController@edit')->where('id', '[0-9]+');
Route::post('user/edit/save', 'UserController@save')->where('id', '[0-9]+');
//Route::get('user/{id}/reviews', 'UserController@user_reviews')->where('id', '[0-9]+'); // revisar (*)
//Route::get('review/{id}', ['as' => 'review', 'uses' => 'ReviewController@show'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('review/{id}', 'ReviewController@show')->where('id', '[0-9]+');
Route::get('user/{id}/edit', 'UserController@edit')->where('id', '[0-9]+'); // -where parametros solo de [0-9]
Route::post('user/edit/save', 'UserController@save')->where('id', '[0-9]+'); // /x?/y  function(x==null) estaremos pasando parametros nulos
//Route::get('user/{id}/reviews', 'UserController@user_reviews')->where('id', '[0-9]+');
// Route::get('/{slug}', ['as' => 'review', 'uses' => 'ReviewController@show'])->where('slug', '[A-Za-z0-9-_]+'); // Parametros solo [A-Z,a-z,0,9]
