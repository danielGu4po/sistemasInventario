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
        $count = is_array($request->inventarioModelo) ? count($request->inventarioModelo) : 0;

        for ($i = 0; $i < $count; $i++) {
            $registroInventario = new inventario();

            $registroInventario->inventarioMarca = $request->inventarioMarca[$i] ?? '';
            $registroInventario->inventarioModelo = $request->inventarioModelo[$i] ?? '';
            $registroInventario->inventarioSerie = $request->inventarioSerie[$i] ?? '';
            $registroInventario->inventarioEstado = $request->inventarioEstado[$i] ?? '';
            $registroInventario->inventarioObservaciones = $request->inventarioObservaciones[$i] ?? '';
            $registroInventario->inventarioRAM = $request->inventarioRAM[$i] ?? '';
            $registroInventario->inventarioAlmacenamiento = $request->inventarioAlmacenamiento[$i] ?? 'N/A';
            $registroInventario->inventarioContraseña = $request->inventarioContraseña[$i] ?? 'N/A';
            $registroInventario->inventarioNumTel = $request->inventarioNumTel[$i] ?? 'N/A';
            $registroInventario->inventarioLineaTel = $request->inventarioLineaTel[$i] ?? 'N/A';
            $registroInventario->inventarioAsignado = false;
            $registroInventario->inventarioCategoria = $request->inventarioCategoria;

            $registroInventario->save();

        }

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
