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

// Page after login
//Route::group(['before'=>'auth'], function(){

//});

Route::get('/about/{subpage?}', 'AboutController@get_about');
Route::post('/about', 'AboutController@post_about');

Route::get('/login', 'MemberController@getLogin');
Route::post('/login', 'MemberController@postLogin');
Route::get('/logout', 'MemberController@getLogout');
Route::get('/register', 'MemberController@getRegister');
Route::post('/register', 'MemberController@postRegister');

Route::resource('/votes', 'VoteController');
Route::get('/results', 'VoteResultController@index')->name('results');

/* This is for social login */
Route::get('login/facebook', 'Auth\LoginController@redirectToProvider');
Route::get('login/facebook/callback', 'Auth\LoginController@handleProviderCallback');