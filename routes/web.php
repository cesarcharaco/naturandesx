<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes();
Route::group(['middleware' => ['web', 'auth']], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('clientes','ClientesController');
	Route::post('clientes/editar','ClientesController@editar')->name('clientes.editar');
	Route::post('clientes/eliminar','ClientesController@eliminar')->name('clientes.eliminar');
	Route::resource('user','UserController',['except' => ['show']]);
	Route::get('user/{id}/perfil', 'UserController@show')->name('perfil');
	Route::resource('empleados','EmpleadosController');
	Route::post('empleados/editar','EmpleadosController@editar')->name('empleados.editar');
	Route::post('empleados/eliminar','EmpleadosController@eliminar')->name('empleados.eliminar');
	Route::get('mitestqr',function(){
		return view('scanner_qr/index');
	})->name('mitestqr');


	Route::resource('ventas','VentasController');
	Route::get('ventas/{rut}/clientes','VentasController@ventas')->name('ventas_qr');
	Route::get('clientes/{QR}/buscar','ClientesController@buscarQR');
	Route::get('promociones/{id}/buscar_promocion','PromocionesController@buscar_promocion');
	Route::post('qrLogin', ['uses' => 'QrLoginController@checkUser']);
});