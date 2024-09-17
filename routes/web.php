<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ExcelController;

Route::get('/', function () {
    return view('welcome');
});

/**Rutas de CRUD para Asignaciones */
Route::resource('/asignar', AsignarController::class);
Route::get('/asignar/{id}/ver', [AsignarController::class, 'show'])->name('asignar.show');
Route::delete('/asignar/{id}',[AsignarController::class,'destroy'])->name('asignar.delete');
/**Rutas de CRUD para Asignaciones */
Route::post('/inventario', [InventarioController::class, 'store']);

/**Rutas de Inventario */
Route::resource('/inventario', InventarioController::class);
Route::get('/inventarioComputo', [InventarioController::class, 'computo']);
Route::get('/indexGeneral',[InventarioController::class, 'showFormularioComputo']);
Route::get('/inventarioRedes', [InventarioController::class, 'redes']);
Route::get('/inventarioMiscellaneo', [InventarioController::class, 'miscellaneo']);
Route::get('/inventarioTelefonia', [InventarioController::class, 'telefonia']);
/**Rutas de Inventario */

/**PDF */
Route::get('/asignar/pdf/{id}', [AsignarController::class, 'generatePdf'])->name('asignar.pdf');
/**PDF */

/**MATRIZ de Asignación */
Route::get('/export',[ExcelController::class,'export'])->name('export.excel');
/**MATRIZ de Asignación */

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


