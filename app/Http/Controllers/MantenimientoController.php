<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventario;
use App\Models\asignar;
use App\Models\mantenimiento;

class MantenimientoController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function mttoComputo()
    {
        $items = inventario::where('inventarioCategoria','Computo')->with('asignaciones')->get();
        return view('mantenimientos.mttoComputo', compact('items'));
    }
    public function mttoRedes()
    {
        $items = inventario::where('inventarioCategoria', 'Redes')->with('asignaciones')->get();
        return view('mantenimientos.mttoRedes', compact('items'));
    }

    public function mttoMiscelaneo()
    {
        $items = inventario::where('inventarioCategoria', 'Miscelaneo')->with('asignaciones')->get();
        return view('mantenimientos.mttoMiscelaneo', compact('items'));
    }
    public function mttoTelefonia()
    {
        $items = inventario::where('inventarioCategoria', 'Telefonia')->with('asignaciones')->get();
        return view('mantenimientos.mttoTelefonia', compact('items'));
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
