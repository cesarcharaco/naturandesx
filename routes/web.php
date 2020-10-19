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
Route::get('registerClienteExterno','ClienteExternoController@register')->name('registerc');
Route::get('RegisterClienteExitoso','ClienteExternoController@mensajes')->name('mensajes');
Route::get('buscar_preguntas/{id_pregunta}/seguridad','ClienteExternoController@buscar_preguntas');
Auth::routes();
Route::post('registerCliente', 'Auth\RegisterController@store')->name('registerCliente');
Route::post('password.reset','Auth\ResetPasswordController@resetPassword')->name('password.reset');

Route::get('recuperacion','RecuperacionController@index')->name('recuperacion');
Route::post('recuperacion/seleccion','RecuperacionController@seleccion')->name('seleccion');
Route::post('recuperacion/validar','RecuperacionController@validar')->name('validar');
Route::post('recuperacion/nueva_clave','RecuperacionController@nueva_clave')->name('nueva_clave');

Route::group(['middleware' => ['web', 'auth']], function() {
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('clientes','ClientesController');
	Route::post('clientes/editar','ClientesController@editar')->name('clientes.editar');
	Route::post('clientes/eliminar','ClientesController@eliminar')->name('clientes.eliminar');
	Route::post('clientes/cambiar_clave','ClientesController@cambiar_clave')->name('clientes.cambiar_clave');
	Route::resource('user','UserController',['except' => ['show']]);
	Route::get('user/{id}/perfil', 'UserController@show')->name('perfil');
	Route::get('generar_qr/{id}/qr', 'UserController@generar_qr')->name('generar_qr');
	Route::get('descargar/{id}/qr', 'UserController@descargar_qr_pdf')->name('descargar_qr_pdf');
	Route::get('enviar/{id}/qr', 'UserController@enviar_qr')->name('enviar_qr');
	Route::get('buscar_preguntas_p/{id_pregunta}/seguridad_p','UserController@buscar_preguntas');
	Route::post('user/editar_perfil', 'UserController@editar_perfil')->name('editar_perfil');
	Route::resource('empleados','EmpleadosController');
	Route::post('empleados/editar','EmpleadosController@editar')->name('empleados.editar');
	Route::post('empleados/eliminar','EmpleadosController@eliminar')->name('empleados.eliminar');
	Route::post('empleados/cambiar_clave','EmpleadosController@cambiar_clave')->name('empleados.cambiar_clave');
	Route::get('mitestqr',function(){
		return view('scanner_qr/index');
	})->name('mitestqr');
	
	Route::post('ventas/pendientes/buscar','VentasController@buscar_ventas_pendientes')->name('pendientes.buscar');
	Route::get('ventas/pendientes','VentasController@ventas_pedientes')->name('pendientes');

	Route::post('ventas/pagar_pendientes','VentasController@pagar_venta')->name('pagar_pendientes');
	Route::resource('ventas','VentasController');
	Route::get('ventas/{rut}/clientes','VentasController@ventas')->name('ventas_qr');
	Route::get('clientes/{QR}/buscar','ClientesController@buscarQR');
	Route::get('promociones/{id}/buscar_promocion','PromocionesController@buscar_promocion');
	Route::post('qrLogin', ['uses' => 'QrLoginController@checkUser']);

	Route::name('carnet_qr')->get('carnet_qr', 'ClientesController@carnet_qr');


	Route::get('reportes','ReportesController@buscar_reporte')->name('reportes');
	Route::post('reportes/mostrar','ReportesController@mostrar_reporte')->name('mostrar_reporte');
	Route::post('reportes/enviar_reportes','ReportesController@enviar_reportes')->name('enviar_reportes');
	
	Route::get('historial','VentasController@history')->name('historial');
	Route::get('historial/{desde}/{hasta}/{opcion}/buscar','VentasController@historial');
	Route::get('repartidor/{id_venta}/buscar','VentasController@historial2');


	
});