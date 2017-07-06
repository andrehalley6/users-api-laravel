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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// mcoin API routes test
Route::post('api/v1/users', 'UserController@create');
Route::get('api/v1/users/{id}', 'UserController@getUser');
Route::put('api/v1/users/{id}', 'UserController@updateUser');
Route::delete('api/v1/users/{id}', 'UserController@deleteUser');
Route::post('api/v1/authenticate', 'UserController@login');