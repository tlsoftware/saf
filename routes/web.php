<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Auth::routes();

Route::get('/home', 'HomeController@index');

Route::resource('users', 'UserController');

Route::resource('customers', 'CustomerController');

Route::get('/managements/create/{id}', 'ManagementController@create');

Route::post('managements/store/{management}', [
    'uses' => 'ManagementController@store',
    'as'  => 'managements.store'
]);


Route::get('potencials/{id}', [
    'uses' => 'PotencialCustomerController@index',
    'as'   => 'potencials'
])->where('id', '[0-9]+');

Route::get('potencials/show', [
    'uses' => 'PotencialCustomerController@show',
    'as'   => 'potencials.show'
]);

Route::get('muestras/{id}', [
    'uses' => 'MuestraCustomerController@index',
    'as'   => 'muestras'
])->where('id', '[0-9]+');

Route::get('muestras/show', [
    'uses' => 'MuestraCustomerController@show',
    'as'   => 'muestras.show'
]);

Route::get('activos/{id}', [
    'uses' => 'ActivoCustomerController@index',
    'as'   => 'activos'
])->where('id', '[0-9]+');

Route::get('activos/show', [
    'uses' => 'ActivoCustomerController@show',
    'as'   => 'activos.show'
]);