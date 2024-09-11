<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\InventariorController;

Route::get('/', function () {
    return view('welcome');
});

/**Rutas de CRUD para Asignaciones */
Route::resource('/asignar', AsignarController::class);
/**Rutas de CRUD para Asignaciones */


Route::resource('/invetario', InventarioController::class);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

