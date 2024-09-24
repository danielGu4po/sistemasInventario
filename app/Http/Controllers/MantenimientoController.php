<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\inventario;
use App\Models\asignar;
use App\Models\mantenimiento;
use Carbon\Carbon;


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
        $items = inventario::where('inventarioCategoria', 'Computo')->with('asignaciones')->get();
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
    $request->validate([
        'item_id' => 'required|exists:inventario,id',
        'mantenimientoFecha' => 'required|string',
        'mantenimientoMtto' => 'required|string',
        'mantenimientoDetalles' => 'nullable|string',
    ]);

    $year = now()->year;
    $trimestreInicio = [
        'Q1' => Carbon::createFromDate($year, 1, 1),
        'Q2' => Carbon::createFromDate($year, 4, 1),
        'Q3' => Carbon::createFromDate($year, 7, 1),
        'Q4' => Carbon::createFromDate($year, 10, 1),
    ][$request->mantenimientoFecha] ?? null;

    $mantenimiento = new mantenimiento();
    $mantenimiento->item_id = $request->input('item_id');
    $mantenimiento->mantenimientoFecha = $trimestreInicio;
    $mantenimiento->mantenimientoDetalles = $request->input('mantenimientoDetalles');
    $mantenimiento->mantenimientoMtto = $request->input('mantenimientoMtto');
    $mantenimiento->save();

    return redirect()->route('mantenimiento.show', $request->input('item_id'))
        ->with('success', 'Mantenimiento programado exitosamente');
}


    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        $item = inventario::with('asignaciones')->findOrFail($id);

        $correctivos = mantenimiento::where('item_id', $id)->where('mantenimientoMtto', 'Correctivo')->count();
        $preventivos = mantenimiento::where('item_id', $id)->where('mantenimientoMtto', 'Preventivo')->count();

        $sinMtto = mantenimiento::where('item_id',$id)->doesntExist();

        $promedioMttos = mantenimiento::where('item_id',$id)->avg('id');

        $proximosMttos = mantenimiento::where('item_id',$id)
        ->where('mantenimientoFecha', '>=', now())
        ->orderBy('mantenimientoFecha','asc')
        ->get();

        $totalMttos = mantenimiento::where('item_id',$id)->count();
        $completos = mantenimiento::where('item_id',$id)
        ->whereNotNull('mantenimientoDetalles')
        ->count();

        $porcentajeCompletos = $totalMttos > 0 ? ($completos / $totalMttos) * 100 : 0;

        return view('mantenimientos.estadisticasItems', compact('item','preventivos', 'correctivos', 'sinMtto','promedioMttos','porcentajeCompletos','proximosMttos'));
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
