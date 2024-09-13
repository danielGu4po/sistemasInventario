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
        // Validación básica
        $request->validate([
            'inventarioMarca' => 'required|string',
            'inventarioModelo' => 'required|string',
            'inventarioSerie' => 'required|string',
            'inventarioEstado' => 'required|string',
            'inventarioObservaciones' => 'nullable|string',
            'inventarioRAM' => 'nullable|string',
            'inventarioAlmacenamiento' => 'nullable|string',
            'inventarioContraseña' => 'nullable|string',
            'inventarioNumTel' => 'nullable|string',
            'inventarioLineaTel' => 'nullable|string',
            'inventarioCategoria' => 'nullable|string',
        ]);

        // Crear una nueva instancia del modelo Inventario
        $registroInventario = new Inventario();
        $registroInventario->inventarioMarca = $request->input('inventarioMarca');
        $registroInventario->inventarioModelo = $request->input('inventarioModelo');
        $registroInventario->inventarioSerie = $request->input('inventarioSerie');
        $registroInventario->inventarioRAM = $request->input('inventarioRAM');
        $registroInventario->inventarioAlmacenamiento = $request->input('inventarioAlmacenamiento');
        $registroInventario->inventarioContraseña = $request->input('inventarioContraseña');
        $registroInventario->inventarioEstado = $request->input('inventarioEstado');
        $registroInventario->inventarioNumTel = $request->input('inventarioNumTel');
        $registroInventario->inventarioLineaTel = $request->input('inventarioLineaTel');
        $registroInventario->inventarioObservaciones = $request->input('inventarioObservaciones');
        $registroInventario->inventarioCategoria = $request->input('inventarioCategoria');
        $registroInventario->inventarioAsignado = false; // Valor predeterminado

        // Guardar el registro
        $registroInventario->save();

        // Redirigir al usuario
        return redirect('/indexGeneral')->with('success', 'Inventario registrado exitosamente.');
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
