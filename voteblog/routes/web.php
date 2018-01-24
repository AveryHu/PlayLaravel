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

Route::get('/about/{subpage?}', 'AboutController@index');
Route::post('/about', 'AboutController@create');

Route::get('/login', 'MemberController@index');
Route::post('/login', 'MemberController@login');
Route::get('/logout', 'MemberController@logout');