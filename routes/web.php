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
/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

//Rutas usuarios
Route::get('/usuario', 'Backend\userController@index')->name('user.index');
Route::post('/usuario', 'Backend\userController@store')->name('user.store');
Route::get('/usuario/{user}', 'Backend\userController@edit')->name('user.edit');
Route::put('/usuario/{user}', 'Backend\userController@update')->name('user.update');
Route::delete('/usuario/{user}', 'Backend\userController@destroy')->name('user.destroy');

//Rutas de projectos
Route::get('/projecto', 'Backend\projectoController@create')->name('project.create');
Route::post('/projecto', 'Backend\projectoController@store')->name('project.store');
Route::put('/projectos/{projecto}', 'HomeController@update')->name('estado.update');
Route::get('/projecto/{projecto}', 'Backend\projectoController@edit')->name('project.edit');
Route::put('/projecto/{projecto}', 'Backend\projectoController@update')->name('project.update');
Route::delete('/projecto/{projecto}', 'Backend\projectoController@destroy')->name('project.destroy');

//Rutas de tareas
Route::get('/tarea/{projecto}', 'Backend\tareaController@create')->name('tarea.create');
Route::get('/tareas/{projecto}', 'Backend\tareaController@index')->name('tarea.index');
Route::put('/tareas/{tarea}', 'HomeController@store')->name('estado.store');
Route::post('/tarea/{projecto}', 'Backend\tareaController@store')->name('tarea.store');
Route::get('/edit-tarea/{tarea}', 'Backend\tareaController@edit')->name('tarea.edit');
Route::put('/tarea/{tarea}', 'Backend\tareaController@update')->name('tarea.update');
Route::delete('/tarea/{tarea}', 'Backend\tareaController@destroy')->name('tarea.destroy');

//Rutas de roles
Route::get('/role', 'Backend\roleController@index')->name('role.index');
Route::post('/role', 'Backend\roleController@store')->name('role.store');
Route::get('/role/{role}', 'Backend\roleController@edit')->name('role.edit');
Route::put('/role/{role}', 'Backend\roleController@update')->name('role.update');
Route::delete('/role/{role}', 'Backend\roleController@destroy')->name('role.destroy');

//Rutas de permisos
Route::get('/permiso', 'HomeController@permiso')->middleware('permiso')->name('permiso.index');

