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
  //modulo  review
	Route::get('new-review', 'ReviewController@create'); // Usado para crear
	Route::post('new-review', 'ReviewController@store'); // Usado para mostrar  (?eso no lo entiendo)
    Route::post('review/edit/save','ReviewController@save');
    Route::get('review/{id_review}/edit', 'ReviewController@edit'); // Usado para editar perfil
	Route::post('review/edit/update','ReviewController@update'); // actualizar review editada
	Route::get('delete/{id}', 'ReviewController@destroy');
	Route::get('user/{id}/reviews', 'ReviewController@showUserReviews') ->where('id', '[0-9]+');//*****(*) // ver reviews del usuario {id}
    Route::post('review/vote/{review_id}', 'ReviewController@upvote');

                                // Modulo comentarios
    Route::get('comment/add', 'CommentController@create');
    Route::post('comment/save/{review_id}', 'CommentController@save');
    Route::get('comment/delete/{comment_id}/{review_id}', 'CommentController@destroy');
    Route::post('comment/update/{review_id}/{comment_id}', 'CommentController@update');
    Route::get('comment/edit/{review_id}/{comment_id}/{author_id}', ['uses' => 'CommentController@edit', 'as' => 'edit']);
    Route::post('comment/vote/{comment_id}/{review_id}', 'CommentController@vote');
                                // Fin modulo comentarios

                                //Modulo usuario
    Route::get('user/{id}/edit', 'UserController@edit')->where('id', '[0-9]+');
  	Route::post('user/edit/save', 'UserController@save')->where('id', '[0-9]+');
  	Route::get('user/delete/{id}', 'UserController@destroy');
                                //Fin modulo usuario

                                //Módulo strain-Crops
    Route::post('strain/edit/save','StrainController@save');
    Route::get('strain/{review_id}/edit','StrainController@edit');
    Route::post('review/save-strain', 'StrainController@store');
    Route::get('review/{review_id}/new-strain', 'StrainController@create');
    Route::get('review/{review_id}/delete-strain/{id}', 'StrainController@delete');
    Route::get('review/{review_id}/update-strain/{id}', 'StrainController@update');
                                //Fin módulo strain-crops

    //Modulo productos
    // Route::get('strain/{id}/new-product', 'ProductController@create');
    // Route::post('strain/{id}/save-product', 'ProductController@save');
    Route::get('strain/{id}/add-product', 'ProductController@addProdToStrain');
    Route::post('strain/{id}/save-product', 'ProductController@saveProdToStrain');
    //fin modulo producto

    //Modulo update
    Route::post('review/{id}/add-update', 'ReviewController@updateReview');
    Route::post('strain/{id}/add-update', 'StrainController@updateStrain');
    //fin modulo update


    
}); // Acciones que solo pueden hacer los usuarios logueados

//admin
Route::get('admin/update-api-{startPage}-{endPage}', 'StrainController@updateApi');
Route::get('admin/add-product', 'ProductController@create');
Route::post('admin/save-product', 'ProductController@store');
//fin admin
Route::get('strain/{id}', 'StrainController@show');
Route::get('user/{id}', 'UserController@profile')->where('id', '[0-9]+');
Route::get('user/{id}/edit', 'UserController@edit')->where('id', '[0-9]+');
Route::post('user/edit/save', 'UserController@save')->where('id', '[0-9]+');
//Route::get('user/{id}/reviews', 'UserController@user_reviews')->where('id', '[0-9]+'); // revisar (*)
//Route::get('review/{id}', ['as' => 'review', 'uses' => 'ReviewController@show'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('review/{id}', ['as'=> 'showreview', 'uses'=>'ReviewController@show'])->where('id', '[0-9]+');
Route::get('user/{id}/edit', 'UserController@edit')->where('id', '[0-9]+'); // -where parametros solo de [0-9]
//Route::get('user/{id}/reviews', 'UserController@user_reviews')->where('id', '[0-9]+');
// Route::get('/{slug}', ['as' => 'review', 'uses' => 'ReviewController@show'])->where('slug', '[A-Za-z0-9-_]+'); // Parametros solo [A-Z,a-z,0,9]
