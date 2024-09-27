<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Storage;
use App\Models\Verificacion;
use Carbon\Carbon;

class VerificacionController extends Controller
{
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validatedData = $request->validate([
            'verificacionCodigo' => 'required|string|max:255',
            'verificacionModelo' => 'required|string|max:255',
            'verificacionNumEmpleado' => 'required|string|max:255',
            'verificacionSerie' => 'required|string|max:255',
            'verificacionNomUsuario' => 'required|string|max:255',
            'verificacionAreaDepartamento' => 'required|string|max:255',
            'verificacionMarca' => 'required|string|max:255',
            'verificacionAsignacion' => 'required|string|max:255',
            'verificacionFecha' => 'required|date',
            'verificacionConcepto1' => 'nullable|boolean',
            'verificacionConcepto2' => 'nullable|boolean',
            'verificacionConcepto3' => 'nullable|boolean',
            'verificacionConcepto4' => 'nullable|boolean',
            'verificacionConcepto5' => 'nullable|boolean',
            'verificacionConcepto6' => 'nullable|boolean',
            'verificacionConcepto7' => 'nullable|boolean',
            'verificacionConcepto8' => 'nullable|boolean',
            'verificacionConcepto9' => 'nullable|boolean',
            'verificacionConcepto10' => 'nullable|boolean',
            'verificacionConcepto11' => 'nullable|boolean',
            'verificacionConcepto12' => 'nullable|boolean',
            'verificacionConcepto13' => 'nullable|boolean',
            'verificacionConcepto14' => 'nullable|boolean',
            'verificacionConcepto15' => 'nullable|boolean',
            'verificacionConcepto16' => 'nullable|boolean',
            'verificacionConcepto17' => 'nullable|boolean',
            'verificacionConcepto18' => 'nullable|boolean',
            'verificacionConcepto19' => 'nullable|boolean',
            'verificacionConcepto20' => 'nullable|boolean',
            'verificacionConcepto21' => 'nullable|boolean',
            'verificacionConcepto22' => 'nullable|boolean',
            'verificacionConcepto23' => 'nullable|boolean',
            'verificacionConcepto24' => 'nullable|boolean',
            'verificacionConcepto25' => 'nullable|boolean',
            'verificacionConcepto26' => 'nullable|boolean',
            'verificacionConcepto27' => 'nullable|boolean',
            'verificacionConcepto28' => 'nullable|boolean',
            'verificacionConcepto29' => 'nullable|boolean',
            'verificacionConcepto30' => 'nullable|boolean',
            'verificacionConcepto31' => 'nullable|boolean',
            'verificacionConcepto32' => 'nullable|boolean',
            'verificacionConcepto33' => 'nullable|boolean',
            'verificacionConcepto34' => 'nullable|boolean',
            'verificacionConcepto35' => 'nullable|boolean',
            'verificacionConcepto36' => 'nullable|boolean',
            'verificacionConcepto37' => 'nullable|boolean',
            'verificacionConcepto38' => 'nullable|boolean',
            'verificacionConcepto39' => 'nullable|boolean',
            'verificacionConcepto40' => 'nullable|boolean',
            'verificacionConcepto41' => 'nullable|boolean',
            'verificacionConcepto42' => 'nullable|boolean',
            'verificacionConcepto43' => 'nullable|boolean',
            'verificacionConcepto44' => 'nullable|boolean',
            'verificacionConcepto45' => 'nullable|boolean',
            'verificacionConcepto46' => 'nullable|boolean',
            'verificacionConcepto47' => 'nullable|boolean',
            'verificacionConcepto48' => 'nullable|boolean',
            'verificacionConceptoObservacion' => 'nullable|string|max:255',
            'verificacionAccion' => 'nullable|string|max:255',
            'verificacionResponsable' => 'nullable|string|max:255',
            'verificacionFechaCumplimiento' => 'nullable|date',
            
        ]);

        // Crear una nueva instancia de Verificacion y guardar los datos
        Verificacion::create($validatedData);



       // Obtener el último registro creado
$verificacion = Verificacion::latest()->first(); // O usa `latest('created_at')` si necesitas un orden específico por columna


        if (!$verificacion) {
            return response()->json(['error' => 'No se encontraron datos'], 404);
        }

        // Cargar la plantilla de Excel
        $templatePath = storage_path('app/templates/Lista_de_Verificacion.xlsx');
        if (!file_exists($templatePath)) {
            return response()->json(['error' => 'La plantilla no se encuentra en la ubicación especificada'], 404);
        }
        $spreadsheet = IOFactory::load($templatePath);
        $sheet = $spreadsheet->getActiveSheet();





        
        $fecha = $verificacion->verificacionFecha instanceof Carbon ? $verificacion->verificacionFecha : new Carbon($verificacion->verificacionFecha);
        // Llenar celdas específicas con datos
        $sheet->setCellValue('F6', $verificacion->verificacionCodigo);
        $sheet->setCellValue('K6', $verificacion->verificacionModelo);
        $sheet->setCellValue('O6', $verificacion->verificacionNumEmpleado);
        $sheet->setCellValue('F8', $verificacion->verificacionSerie);
        $sheet->setCellValue('K8', $verificacion->verificacionNomUsuario);
        $sheet->setCellValue('H55', $verificacion->verificacionNomUsuario);
        $sheet->setCellValue('O8', $verificacion->verificacionAreaDepartamento);
        $sheet->setCellValue('F10', $verificacion->verificacionMarca);
        $sheet->setCellValue('K10', $verificacion->verificacionAsignacion);
        $sheet->setCellValue('O10', $fecha->format('Y-m-d')); // Celda O10

        if ($verificacion->verificacionConcepto1 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I14', '1');
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('J14', '');
        }
    
        if ($verificacion->verificacionConcepto2 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I15', '1');
            $sheet->setCellValue('J15', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I15', '');
            $sheet->setCellValue('J15', '1');
        }
    
        if ($verificacion->verificacionConcepto3 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I16', '1');
            $sheet->setCellValue('J16', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I16', '');
            $sheet->setCellValue('J16', '1');
        }
    
        if ($verificacion->verificacionConcepto4 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I17', '1');
            $sheet->setCellValue('J17', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I17', '');
            $sheet->setCellValue('J17', '1');
        }
    
        if ($verificacion->verificacionConcepto5 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I18', '1');
            $sheet->setCellValue('J18', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I18', '');
            $sheet->setCellValue('J18', '1');
        }
    
        if ($verificacion->verificacionConcepto6 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I21', '1');
            $sheet->setCellValue('J21', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I21', '');
            $sheet->setCellValue('J21', '1');
        }
    
        if ($verificacion->verificacionConcepto7 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I22', '1');
            $sheet->setCellValue('J22', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I22', '');
            $sheet->setCellValue('J22', '1');
        }
    
        if ($verificacion->verificacionConcepto8 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I23', '1');
            $sheet->setCellValue('J23', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I23', '');
            $sheet->setCellValue('J23', '1');
        }
    
        if ($verificacion->verificacionConcepto9 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I24', '1');
            $sheet->setCellValue('J24', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I24', '');
            $sheet->setCellValue('J24', '1');
        }
    
        if ($verificacion->verificacionConcepto10 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I25', '1');
            $sheet->setCellValue('J25', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I25', '');
            $sheet->setCellValue('J25', '1');
        }
    
        if ($verificacion->verificacionConcepto11 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I28', '1');
            $sheet->setCellValue('J28', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I28', '');
            $sheet->setCellValue('J28', '1');
        }
    
        if ($verificacion->verificacionConcepto12 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I29', '1');
            $sheet->setCellValue('J29', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I29', '');
            $sheet->setCellValue('J29', '1');
        }
    
        if ($verificacion->verificacionConcepto13 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I30', '1');
            $sheet->setCellValue('J30', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I30', '');
            $sheet->setCellValue('J30', '1');
        }
    
        if ($verificacion->verificacionConcepto14 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I31', '1');
            $sheet->setCellValue('J31', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I31', '');
            $sheet->setCellValue('J31', '1');
        }
    
        if ($verificacion->verificacionConcepto15 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I32', '1');
            $sheet->setCellValue('J32', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I32', '');
            $sheet->setCellValue('J32', '1');
        }
    
        if ($verificacion->verificacionConcepto16 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I33', '1');
            $sheet->setCellValue('J33', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I33', '');
            $sheet->setCellValue('J33', '1');
        }
    
        if ($verificacion->verificacionConcepto17 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I34', '1');
            $sheet->setCellValue('J34', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I34', '');
            $sheet->setCellValue('J34', '1');
        }
    
        if ($verificacion->verificacionConcepto18 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I37', '1');
            $sheet->setCellValue('J37', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I37', '');
            $sheet->setCellValue('J37', '1');
        }
    
        if ($verificacion->verificacionConcepto19 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I38', '1');
            $sheet->setCellValue('J38', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I38', '');
            $sheet->setCellValue('J38', '1');
        }
    
        if ($verificacion->verificacionConcepto20 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I41', '1');
            $sheet->setCellValue('J41', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I41', '');
            $sheet->setCellValue('J41', '1');
        }
    
        if ($verificacion->verificacionConcepto21 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I42', '1');
            $sheet->setCellValue('J42', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I42', '');
            $sheet->setCellValue('J42', '1');
        }
    
        if ($verificacion->verificacionConcepto22 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I43', '1');
            $sheet->setCellValue('J43', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I43', '');
            $sheet->setCellValue('J43', '1');
        }
    
        if ($verificacion->verificacionConcepto23 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I44', '1');
            $sheet->setCellValue('J44', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I44', '');
            $sheet->setCellValue('J44', '1');
        }
    
        if ($verificacion->verificacionConcepto24 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I45', '1');
            $sheet->setCellValue('J45', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I45', '');
            $sheet->setCellValue('J45', '1');
        }
    
        if ($verificacion->verificacionConcepto25 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I46', '1');
            $sheet->setCellValue('J46', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I46', '');
            $sheet->setCellValue('J46', '1');
        }
    
        if ($verificacion->verificacionConcepto26 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I47', '1');
            $sheet->setCellValue('J47', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I47', '');
            $sheet->setCellValue('J47', '1');
        }
    
        if ($verificacion->verificacionConcepto27 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('I48', '1');
            $sheet->setCellValue('J48', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('I48', '');
            $sheet->setCellValue('J48', '1');
        }
        if ($verificacion->verificacionConcepto28 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O24', '1');
            $sheet->setCellValue('P24', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O24', '');
            $sheet->setCellValue('P24', '1');
        }
    
        if ($verificacion->verificacionConcepto29 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O25', '1');
            $sheet->setCellValue('P25', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O25', '');
            $sheet->setCellValue('P25', '1');
        }
    
        if ($verificacion->verificacionConcepto30 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O26', '1');
            $sheet->setCellValue('P26', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O26', '');
            $sheet->setCellValue('P26', '1');
        }
    
        if ($verificacion->verificacionConcepto31 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O27', '1');
            $sheet->setCellValue('P27', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O27', '');
            $sheet->setCellValue('P27', '1');
        }
    
        if ($verificacion->verificacionConcepto32 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O28', '1');
            $sheet->setCellValue('P28', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O28', '');
            $sheet->setCellValue('P28', '1');
        }
    
        if ($verificacion->verificacionConcepto33 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O29', '1');
            $sheet->setCellValue('P29', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O29', '');
            $sheet->setCellValue('P29', '1');
        }
    
        if ($verificacion->verificacionConcepto34 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O30', '1');
            $sheet->setCellValue('P30', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O30', '');
            $sheet->setCellValue('P30', '1');
        }
    
        if ($verificacion->verificacionConcepto35 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O31', '1');
            $sheet->setCellValue('P31', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O31', '');
            $sheet->setCellValue('P31', '1');
        }
    
        if ($verificacion->verificacionConcepto36 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O32', '1');
            $sheet->setCellValue('P32', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O32', '');
            $sheet->setCellValue('P32', '1');
        }
    
        if ($verificacion->verificacionConcepto37 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O33', '1');
            $sheet->setCellValue('P33', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O33', '');
            $sheet->setCellValue('P33', '1');
        }
    
        if ($verificacion->verificacionConcepto38 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O34', '1');
            $sheet->setCellValue('P34', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O34', '');
            $sheet->setCellValue('P34', '1');
        }
    
        if ($verificacion->verificacionConcepto39 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O35', '1');
            $sheet->setCellValue('P35', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O35', '');
            $sheet->setCellValue('P35', '1');
        }
    
        if ($verificacion->verificacionConcepto40 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O36','1');
            $sheet->setCellValue('P36', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O36', '');
            $sheet->setCellValue('P36', '1');
        }
    
        if ($verificacion->verificacionConcepto41 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O39', '1');
            $sheet->setCellValue('P39', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O39', '');
            $sheet->setCellValue('P39', '1');
        }
    
        if ($verificacion->verificacionConcepto42 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O40','1');
            $sheet->setCellValue('P40', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O40', '');
            $sheet->setCellValue('P40', '1');
        }
    
        if ($verificacion->verificacionConcepto43 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O41', '1');
            $sheet->setCellValue('P41', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O41', '');
            $sheet->setCellValue('P41', '1');
        }
    
        if ($verificacion->verificacionConcepto44 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O42', '1');
            $sheet->setCellValue('P42', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O42', '');
            $sheet->setCellValue('P42', '1');
        }
    
        if ($verificacion->verificacionConcepto45 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O45', '1');
            $sheet->setCellValue('P45', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O45', '');
            $sheet->setCellValue('P45', '1');
        }
    
        if ($verificacion->verificacionConcepto46 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O46', '1');
            $sheet->setCellValue('P46', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O46', '');
            $sheet->setCellValue('P46', '1');
        }
    
        if ($verificacion->verificacionConcepto47 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O47', '1');
            $sheet->setCellValue('P47', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O47', '');
            $sheet->setCellValue('P47', '1');
        }
    
        if ($verificacion->verificacionConcepto48 == 1) {
            // Si es igual a 1, poner el valor en I14
            $sheet->setCellValue('O48', '1');
            $sheet->setCellValue('P48', ''); // Dejar la celda J14 vacía o como desees
        } else {
            // Si es 0 o cualquier otro valor, poner 1 en J14
            $sheet->setCellValue('O48', '');
            $sheet->setCellValue('P48', '1');
        }
        
        $sheet->setCellValue('E52', $verificacion->verificacionConceptoObservacion); 
        $sheet->setCellValue('G52', $verificacion->verificacionAccion); 
        $sheet->setCellValue('K52', $verificacion->verificacionResponsable); 
        $sheet->setCellValue('O52', $verificacion->verificacionFechaCumplimiento); 



         // Crear el archivo Excel en memoria
    $writer = new Xlsx($spreadsheet);
    $fileName = 'verificacion.xlsx';

    // Enviar el archivo directamente como respuesta al navegador
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="'. urlencode($fileName) .'"');
    $writer->save('php://output');
    exit;
    }
}