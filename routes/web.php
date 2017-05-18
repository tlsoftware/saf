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

use App\Detail;

Route::get('carga', 'CargaController@loadExcel')->name('carga');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Auth::routes();

Route::get('/home', [
    'uses' => 'HomeController@index',
    'as'   => 'home'
]);

Route::resource('users', 'UserController');
Route::get('users/{id}/destroy', [
   'uses'  => 'UserController@destroy',
    'as'   => 'users.destroy'
]);

Route::get('/users/migrate/{id}', [
    'uses' => 'UserController@migrate',
    'as'   => 'migrate'
]);

Route::put('users/migrate/{id}', [
    'uses'  => 'UserController@storeMigrate',
    'as'   => 'migrate'
]);


Route::resource('products', 'ProductController');

Route::resource('customers', 'CustomerController');

Route::get('/managements/{id}', [
    'uses' => 'ManagementController@show',
    'as'   => 'managements'
]);

Route::get('/managements/showgestion/{id}', [
    'uses' => 'ManagementController@showGestion',
    'as'   => 'managements.showgestion'
]);
Route::get('/managements/showmuestra/{id}', [
    'uses' => 'ManagementController@showMuestra',
    'as'   => 'managements.showmuestra'
]);
Route::get('/managements/showdatos/{id}', [
    'uses' => 'ManagementController@showDatos',
    'as'   => 'managements.showdatos'
]);
Route::get('/managements/showventa/{id}', [
    'uses' => 'ManagementController@showVenta',
    'as'   => 'managements.showventa'
]);
Route::get('/managements/showrechazo/{id}', [
    'uses' => 'ManagementController@showRechazo',
    'as'   => 'managements.showrechazo'
]);
Route::get('/managements/showbaja/{id}', [
    'uses' => 'ManagementController@showBaja',
    'as'   => 'managements.showbaja'
]);
Route::put('/managements/storeDatos/{id}', [
    'uses' => 'ManagementController@storeDatos',
    'as'   => 'managements.storeDatos'
]);



Route::get('/managements/create/{id}', 'ManagementController@create');

Route::post('managements/store/{management}', [
    'uses' => 'ManagementController@store',
    'as'  => 'managements.store'
]);


Route::get('potenciales/{id}', [
    'uses' => 'PotencialCustomerController@index',
    'as'   => 'potenciales'
])->where('id', '[0-9]+');

Route::get('potenciales/detalle/{id}', [
    'uses' => 'PotencialCustomerController@detalle',
    'as'   => 'potenciales.detalle'
])->where('id', '[0-9]+');

Route::get('potenciales/show', [
    'uses' => 'PotencialCustomerController@show',
    'as'   => 'potenciales.show'
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

Route::get('bajas/show', [
    'uses' => 'BajaCustomerController@show',
    'as'   => 'bajas.show'
]);

Route::get('rechazos/show', [
    'uses' => 'RechazoCustomerController@show',
    'as'   => 'rechazos.show'
]);

Route::get('todos/show', [
    'uses' => 'TodosCustomerController@show',
    'as'   => 'todos.show'
]);

Route::get('form', [
    'uses'  => 'StatusController@index',
    'as'    => 'form'
]);

Route::get('/ajax-call', function(){
    $id = Input::get('status_id');
    $details = Detail::where('status_id', '=', $id)->get();
    return Response::json($details);
});