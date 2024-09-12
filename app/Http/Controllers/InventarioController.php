<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invetario;

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
        $datosGeneral = invetario::all();
        return view('inventarios.vistaGeneral',compact('datosGeneral'));
    }

    public function computo()
    {
        $datosComputo = invetario::all();
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
        //
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
