<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\asignar;

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
        return view('asignaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $asignacion = new asignar();
        $asignacion->asignarUsuario = $request->asignarUsuario;
        $asignacion->asignarNoEmpleado = $request->asignarNoEmpleado;
        $asignacion->asignarPuesto = $request->asignarPuesto;
        $asignacion->asignarDepartamento = $request->asignarDepartamento;
        $asignacion->asignarEquipoNombre = $request->asignarEquipoNombre;
        $asignacion->asignarUsuarioNombre = $request->asignarUsuarioNombre;
        $asignacion->asignarEquipoCorreo = $request->asignarEquipoCorreo;
        $asignacion->save();
        return redirect()->route('asignar.index');
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
