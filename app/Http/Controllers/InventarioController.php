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
    $request->validate([
        'inventarioMarca' => 'required|string|max:255',
        'inventarioModelo' => 'required|string|max:255',
        'inventarioSerie' => 'required|string|max:255',
        'inventarioRam' => 'required|string|max:255',
        'inventarioAlmacenamiento' => 'required|string|max:255',
        'inventarioContraseña' => 'required|string|max:255',
        'inventarioObservaciones' => 'nullable|string',
    ]);

    $registroInventario = new Inventario();
    $registroInventario->inventarioMarca = $request->inventarioMarca;
    $registroInventario->inventarioModelo = $request->inventarioModelo;
    $registroInventario->inventarioSerie = $request->inventarioSerie;
    $registroInventario->inventarioRam = $request->inventarioRam;
    $registroInventario->inventarioAlmacenamiento = $request->inventarioAlmacenamiento;
    $registroInventario->inventarioContraseña = $request->inventarioContraseña;
    $registroInventario->inventarioObservaciones = $request->inventarioObservaciones;
    $registroInventario->inventarioEstado = $request->inventarioEstado ?? ''; // Si es necesario
    $registroInventario->inventarioAsignado = false;
    $registroInventario->inventarioCategoria = $request->inventarioCategoria ?? ''; // Si es necesario

    $registroInventario->save();

    return redirect('/indexGeneral');
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
