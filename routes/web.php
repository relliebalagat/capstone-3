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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile/{id}', 'ProfileController@show')->name('profile');

Route::get('/question/{id}', 'QuestionController@showSingle');

Route::get('/followers/{username}', 'ProfileController@followers');

Route::get('/question/category/{category}', 'CategoryController@show');

Route::group(['middleware' => 'auth'], function() {
	Route::get('/following', 'ProfileController@following');
	Route::post('/follows', 'UserController@follows');
	Route::post('/unfollows', 'UserController@unfollows');
});

Route::get('/followers/{username}', 'ProfileController@followers');

Route::post('/profile/edit_picture', 'ProfileController@update_avatar');

Route::post('/create', 'QuestionController@create');

Route::post('/question/upvote', 'QuestionController@upvote');

Route::post('/question/downvote', 'QuestionController@downvote');

Route::post('/question/{id}/edit', 'QuestionController@edit');

Route::post('/question/{id}/answer', 'AnswerController@create');

Route::delete('/question/{id}/delete', 'QuestionController@delete');
