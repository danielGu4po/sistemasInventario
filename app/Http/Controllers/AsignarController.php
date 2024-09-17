<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignar;
use App\Models\inventario;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AsignacionesExport;

class AsignarController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaciones = asignar::all();
        return view('asignaciones.index', compact('asignaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
                public function create()
            {
                // Recuperar todas las marcas y series del inventario
                $inventarios = Inventario::select('id', 'inventarioMarca', 'inventarioSerie')->get();

                // Pasar los inventarios a la vista
                return view('asignaciones.create', compact('inventarios'));
            }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        $request->validate([
            'asignarUsuario' => 'required|string|max:255',
            'asignarNoEmpleado' => 'required|integer',
            'asignarPuesto' => 'required|string|max:255',
            'asignarDepartamento' => 'required|string|max:255',
            'asignarEquipoNombre' => 'required|string|max:255',
            'asignarUsuarioNombre' => 'required|string|max:255',
            'asignarEquipoCorreo' => 'required|string|email|max:255',
            'inventarioAsignado' => 'required|exists:inventario,id',
        ]);
    
        // Guardar en la tabla `asignar`
        $asignar = new Asignar();
        $asignar->asignarUsuario = $request->input('asignarUsuario');
        $asignar->asignarNoEmpleado = $request->input('asignarNoEmpleado');
        $asignar->asignarPuesto = $request->input('asignarPuesto');
        $asignar->asignarDepartamento = $request->input('asignarDepartamento');
        $asignar->asignarEquipoNombre = $request->input('asignarEquipoNombre');
        $asignar->asignarUsuarioNombre = $request->input('asignarUsuarioNombre');
        $asignar->asignarEquipoCorreo = $request->input('asignarEquipoCorreo');
        $asignar->id_inventario = $request->input('inventarioAsignado');
        $asignar->save();
    
        // Actualizar la tabla `inventario`
        $inventarioId = $request->input('inventarioAsignado');
        $inventario = Inventario::find($inventarioId);
        if ($inventario) {
            $inventario->inventarioAsignado = true;
            $inventario->save();
        }
    
        // Redirigir o devolver una respuesta
        return redirect()->route('asignar.index')->with('success', 'Ítem asignado correctamente.');
    }
    
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asignacion = asignar::with('inventario')->findOrFail($id);
        return view('asignaciones.responsiva', compact('asignacion'));
    }

    public function generatePdf($id){
        $asignacion = asignar::with('inventario')->findOrFail($id);
        $pdf = PDF::loadView('asignaciones.responsivaPDF',compact('asignacion'));
        return $pdf->download('asignacion-' . $asignacion->id . '.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function exportarExcel(){
        return Excel::download(new AsignacionesExport, 'asignaciones.xlsx');
     }
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $asignacion = asignar::findOrFail($id);
        $inventario = inventario::find($asignacion->id_inventario);
        if ($inventario) {
            $inventario->inventarioAsignado = false;
            $inventario->save();
        }
        $asignacion->delete();

        return redirect()->route('asignar.index');
    }
}
