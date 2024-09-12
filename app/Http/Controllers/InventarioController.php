<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventario;

class InventarioController extends Controller
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

    }

    public function showFormularioComputo(Request $request)
    {
        $datosGeneral = inventario::all();
        return view('inventarios.vistaGeneral',compact('datosGeneral'));
    }

    public function computo()
    {
        $datosComputo = inventario::all();
        return view('inventarios.formularioComputo', compact('datosComputo'));
    }
    public function redes()
    {
        return view('inventarios.formularioRedes');
    }

    public function miscellaneo()
    {
        return view('inventarios.formularioMiscellaneo');
    }
    public function telefonia()
    {
        return view('inventarios.formularioTelefonia');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Crea una nueva instancia de Inventario
        $registroInventario = new Inventario();
    
        // Asigna los datos del formulario a los campos del modelo
        $registroInventario->inventarioMarca = $request->input('inventarioMarca');
        $registroInventario->inventarioModelo = $request->input('inventarioModelo');
        $registroInventario->inventarioSerie = $request->input('inventarioSerie');
        $registroInventario->inventarioRAM = $request->input('inventarioRam');
        $registroInventario->inventarioAlmacenamiento = $request->input('inventarioAlmacenamiento');
        $registroInventario->inventarioContraseña = $request->input('inventarioContraseña');
        $registroInventario->inventarioObservaciones = $request->input('inventarioObservaciones');
    
        // Proporcionar un valor por defecto para inventarioEstado
        $registroInventario->inventarioEstado = 'activo'; // O el valor que desees por defecto
    
        $registroInventario->inventarioAsignado = false; // Por defecto no asignado
    
        // Guarda el registro en la base de datos
        $registroInventario->save();
    
        // Redirige a una página después del guardado
        return redirect('/indexGeneral')->with('success', 'Dispositivo registrado exitosamente');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
