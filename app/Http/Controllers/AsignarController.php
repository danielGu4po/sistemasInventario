<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignar;
use App\Models\inventario;

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
        // Validar los datos que llegan del formulario
        $validatedData = $request->validate([
            'asignarUsuario' => 'required|string|max:255',
            'asignarNoEmpleado' => 'required|integer',
            'asignarPuesto' => 'required|string|max:255',
            'asignarDepartamento' => 'required|string|max:255',
            'asignarEquipoNombre' => 'required|string|max:255',
            'asignarUsuarioNombre' => 'required|string|max:255',
            'asignarEquipoCorreo' => 'required|email',
            'idinventario' => 'required|integer|exists:inventario,id', // Validar que exista en la tabla inventario

            
        ]);
    
        // Crear una nueva instancia de asignar
        $asignacion = new Asignar();
        $asignacion->asignarUsuario = $request->asignarUsuario;
        $asignacion->asignarNoEmpleado = $request->asignarNoEmpleado;
        $asignacion->asignarPuesto = $request->asignarPuesto;
        $asignacion->asignarDepartamento = $request->asignarDepartamento;
        $asignacion->asignarEquipoNombre = $request->asignarEquipoNombre;
        $asignacion->asignarUsuarioNombre = $request->asignarUsuarioNombre;
        $asignacion->asignarEquipoCorreo = $request->asignarEquipoCorreo;
        $asignacion->id_inventario = $request->id_inventario; // Asignar el ID del inventario seleccionado
        $asignacion->save();
    
        // Redirigir después de guardar la asignación
        return redirect()->route('asignaciones.index')->with('success', 'Ítem asignado correctamente.');
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $asignacion = asignar::with('inventario')->findOrFail($id);
        return view('asignaciones.responsiva', compact('asignacion'));
    }

    /**
     * Show the form for editing the specified resource.
     */
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
        //
    }
}
