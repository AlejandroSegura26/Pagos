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
//Rutas para un usuario no autenticado
Route::group(['middleware' => ['guest']], function () {
  Route::get('/', function () {
        return view('Auth\LoginController@showLoginForm');
    }); //Alias de la ruta
    //Ruta para mostrar el formulario para iniciar sesion
    Route::get('/','Auth\LoginController@showLoginForm');
    //Ruta para iniciar sesion
    Route::post('/login','Auth\LoginController@login')->name('login');
});
//Rutas para un usuario autenticado
Route::group(['middleware' => ['auth']], function () {
  //Contenido principal
  Route::get('/principal', function () {
    return view('contenido/contenido');
  })->name('principal');
  
  //Ruta para cerrar sesion
  Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
  Route::get('/usuario/selectProgramadorTarea','UserController@selectProgramadorTarea');
  Route::get('/usuario/selectHito','HitoController@selectHito');
  Route::post('/hito/registrar','HitoController@store');
  Route::put('/hito/actualizar','HitoController@update');
  Route::get('/hito','HitoController@index');
  Route::post('/hito/desactivar','HitoController@desactivar');
  Route::get('/tarea','TareaController@index');
  Route::post('/tarea/registrar','TareaController@store');
  Route::put('/tarea/desactivar','TareaController@desactivar');
  
  Route::post('/alumno/registrar','AlumnoController@store');
  Route::get('/alumno','AlumnoController@index');
  Route::put('/alumno/actualizar','AlumnoController@update');
  Route::post('/alumno/desactivar','AlumnoController@desactivar');
  Route::post('/alumno/alumnoConGrupo','AlumnoController@alumnoConGrupo');
  Route::post('/alumno/alumnoSinGrupo','AlumnoController@alumnoSinGrupo');
  
  Route::post('/provedor/registrar','ProvedorController@store');
  Route::get('/provedor','ProvedorController@index');
  Route::put('/provedor/actualizar','ProvedorController@update');
  Route::post('/provedor/desactivar','ProvedorController@desactivar');
  Route::post('/provedor/activar','ProvedorController@activar');
  Route::post('/provedor/pagar','ProvedorController@pagar');
  
  Route::post('/colegiatura/registrar','ColegiaturaController@store');
  Route::get('/colegiatura','ColegiaturaController@index');
  Route::put('/colegiatura/actualizar','ColegiaturaController@update');
  Route::post('/colegiatura/desactivar','ColegiaturaController@desactivar');
  Route::post('/colegiatura/activar','ColegiaturaController@activar');
  
  Route::get('/pagoColegiatura','PagoColegiaturaController@index');
  Route::post('/pagoColegiatura/pagar','PagoColegiaturaController@pagar');
  
  Route::get('/movimiento','movimientoController@index');
  
  Route::get('/renta','RentaController@index');
  Route::post('/renta/registrar','RentaController@store');
  Route::put('/renta/actualizar','RentaController@update');
  Route::post('/renta/desactivar','RentaController@desactivar');
  Route::post('/renta/activar','RentaController@activar');
  Route::post('/renta/pagar','RentaController@pagar');
  
  Route::get('/compra','CompraController@index');
  Route::post('/compra/registrar','CompraController@store');
  Route::post('/compra/desactivar','CompraController@desactivar');
  
  Route::post('/padre/registrar','PadreController@store');
  Route::get('/padre','PadreController@index');
  Route::put('/padre/actualizar','PadreController@update');
  Route::post('/padre/desactivar','PadreController@desactivar');
  Route::post('/padre/selectPadre','PadreController@selectPadre');
  
  Route::post('/grupo/registrar','GrupoController@store');
  Route::get('/grupo','GrupoController@index');
  Route::put('/grupo/actualizar','GrupoController@update');
  Route::post('/grupo/desactivar','GrupoController@desactivar');
  Route::post('/grupo/selectPadre','GrupoController@selectPadre');
  Route::post('/grupo/agregarAlumno','GrupoController@agregarAlumno');
  Route::post('/grupo/quitarAlumno','GrupoController@quitarAlumno');
});

