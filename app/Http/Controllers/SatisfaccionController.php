<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use App\Models\Satisfaccion;
use Carbon\Carbon;

class SatisfaccionController extends Controller
{
    public function showForm()
    {
        // Retorna la vista llamada encuestaSatisfaccion.blade.php
        return view('satisfaccion.encuestaSatisfaccion');
    }

    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'numUsuario' => 'required|string',
            'nombrePrestador' => 'required|string',
            'fechaEvaluacion' => 'required|date',
            'evaluador' => 'required|string',
            'periodo' => 'required|string',
            'numEvaluacion' => 'required|integer',
            'categoriaServicio'=>'required|string',
            'categoriaEvaluador'=>'required|string',
            'check1' => 'nullable|boolean',
            'check2' => 'nullable|boolean',
            'check3' => 'nullable|boolean',
            'check4' => 'nullable|boolean',
            'check5' => 'nullable|boolean',
            'check6' => 'nullable|boolean',
            'accionesMejora1'=>'nullable|string',
            'accionesMejora2'=>'nullable|string',
            'accionesMejora3'=>'nullable|string',
            'accionesMejora4'=>'nullable|string',
            'accionesMejora5'=>'nullable|string',
            'accionesMejora6'=>'nullable|string',
        ]);

        // Crear un nuevo registro en la tabla satisfaccion
        satisfaccion::create($validatedData);

        // Redirigir de nuevo con un mensaje de éxito
        return redirect()->route('satisfaccion.index')->with('success', 'Evaluación guardada correctamente');
    }
    public function index()
{
    $evaluaciones = Satisfaccion::all();

    foreach ($evaluaciones as $evaluacion) {
        // Si la fecha está en formato 'Y-m-d', Carbon::parse puede manejarla sin problemas
        $evaluacion->fechaEvaluacion = Carbon::parse($evaluacion->fechaEvaluacion)->format('Y/m/d');
    }

    return view('satisfaccion.indexSatisfaccion', compact('evaluaciones'));
}
public function show($id)
{
    // Buscar la evaluación en la base de datos
    $evaluacion = Satisfaccion::findOrFail($id);

    // Retornar una vista para mostrar los detalles de la evaluación
    return view('satisfaccion.showSatisfaccion', compact('evaluacion'));
}
}