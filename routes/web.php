<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsignarController;

Route::get('/', function () {
    return view('welcome');
});

/**Rutas de CRUD para Asignaciones */
Route::resource('/asignar', AsignarController::class);
/**Rutas de CRUD para Asignaciones */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

