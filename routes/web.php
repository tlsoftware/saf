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

// Realizar carga de Registros desde Excel
// Route::get('carga', 'CargaController@loadExcel')->name('carga');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
/*
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
*/
// Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::group(['prefix' => 'admin'], function () {

        Route::resource('users', 'UserController');
        Route::get('users/{id}/destroy', [
            'uses'  => 'UserController@destroy',
            'as'   => 'users.destroy'
        ]);
        Route::get('migrate/{id}', [
            'uses' => 'MigrateController@index',
            'as'   => 'migrate'
        ]);
        Route::put('migrate', [
            'uses'  => 'MigrateController@update',
            'as'   => 'migrate'
        ]);

        Route::resource('products', 'ProductController');

        Route::get('mantenedor-estatus', [
            'uses'  => 'StatusController@index',
            'as'    => 'statuses'
        ]);
        Route::get('mantenedor-estatus-create', [
            'uses'   => 'StatusController@create',
            'as'    => 'statuses.create'
        ]);
        Route::post('mantenedor-estatus-create', [
            'uses'   => 'StatusController@store',
            'as'    => 'statuses.store'
        ]);
        Route::get('mantenedor-status-edit/{detail}', [
            'uses'   => 'StatusController@edit',
            'as'    => 'statuses.edit'
        ]);
        Route::put('mantenedor-status-edit/{detail}', [
            'uses'   => 'StatusController@update',
            'as'     => 'statuses.update'
        ]);

        Route::get('upload', 'ImportController@index')->name('carga_masiva');
        Route::post('import', 'ImportController@uploadFile')->name('import');
        Route::get('import', 'ImportController@import')->name('import');

        Route::resource('bstypes', 'BstypeController');

    });
    // Fin vistas de Administracion

    Route::group(['prefix' => 'supervisor'], function () {

        Route::get('gestiones', [
            'uses' => 'ManagementController@dailyManagement',
            'as' => 'gestiones'
        ]);
    });

    Route::resource('customers', 'CustomerController');

    Route::get('/home', [
        'uses' => 'HomeController@index',
        'as'   => 'home'
    ]);

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

    Route::get('managements/modals/add_management', function () {
        return view('managements.modals.add_management');
    });

    Route::get('details-statuses/{status_id}', function ($status_id) {
        if ( ! Request::ajax())
            return response('Forbidden.', 403);

        $status_detail = Detail::where('status_id', $status_id)
            ->select('id as value', 'name as text')
            ->get()->toArray();

        array_unshift($status_detail, ['value' => '', 'text' => '-- Seleccione --']);

        return $status_detail;
    });

    Route::get('cobranzas', [
        'uses' => 'CobranzasController@index',
        'as'   => 'cobranzas'
    ]);

});