<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsignarController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ExcelController;
use App\Http\Controllers\SatisfaccionController;
use App\Http\Controllers\ExcelsatisfaccionController;

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

/**satisfaccion */
Route::get('/satisfaccion', [SatisfaccionController::class, 'showForm'])->name('satisfaccion.form');

Route::get('/index-satisfaccion', [SatisfaccionController::class, 'index'])->name('satisfaccion.index');
Route::get('/satisfaccion/{id}', [SatisfaccionController::class, 'show'])->name('satisfaccion.show');


// Procesar el formulario y guardar los datos en la base de datos (POST)
Route::post('/satisfaccion', [SatisfaccionController::class, 'store'])->name('satisfaccion.store');

/**Excel Satisfaccion */
Route::get('/exportar-excel/{id}', [ExcelsatisfaccionController::class, 'export2'])->name('excel.export2');

/**Excel Satisfaccion */




Route::get('/satisfaccion/formato/{id}', [SatisfaccionController::class, 'showFormato'])->name('satisfaccion.formato');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


