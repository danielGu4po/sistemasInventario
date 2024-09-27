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

    // Método para programar un mantenimiento temporalmente
    public function programarMantenimiento(Request $request, $id)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'mantenimientoFecha' => 'required|date',
            'mantenimientoMtto' => 'required|string',
            'mantenimientoDetalles' => 'nullable|string',
        ]);

        // Obtener los mantenimientos programados desde la sesión
        $mantenimientosProgramados = session()->get('mantenimientos_programados', []);

        // Verificar si ya existe un mantenimiento programado para este item (computadora)
        $existeProgramado = collect($mantenimientosProgramados)->firstWhere('item_id', $id);

        if ($existeProgramado) {
            return redirect()->route('mantenimiento.show', $id)->with('error', 'Ya existe un mantenimiento programado para esta computadora.');
        }

        // Si no existe, programamos el mantenimiento temporalmente
        $programado = [
            'item_id' => $id,
            'mantenimientoFecha' => $request->input('mantenimientoFecha'),
            'mantenimientoMtto' => $request->input('mantenimientoMtto'),
            'mantenimientoDetalles' => $request->input('mantenimientoDetalles'),
            'completado' => false,
        ];

        // Guardar el mantenimiento programado en la sesión (sin guardarlo en la base de datos)
        $mantenimientosProgramados[] = $programado;
        session()->put('mantenimientos_programados', $mantenimientosProgramados);

        return redirect()->route('mantenimiento.show', $id)->with('success', 'Mantenimiento programado temporalmente.');
    }



    public function show($id)
    {
        $item = inventario::with('asignaciones')->findOrFail($id);
        $mantenimientos = mantenimiento::where('item_id', $id)->get();

        // Obtener mantenimientos programados desde la sesión
        $mantenimientosProgramados = session()->get('mantenimientos_programados', []);

        // Filtrar solo el mantenimiento programado para esta computadora
        $mantenimientoProgramado = collect($mantenimientosProgramados)->firstWhere('item_id', $id);

        // Estadísticas
        $totalMttos = $mantenimientos->count();
        $correctivos = $mantenimientos->where('mantenimientoMtto', 'Correctivo')->count();
        $preventivos = $mantenimientos->where('mantenimientoMtto', 'Preventivo')->count();
        $sinMtto = $mantenimientos->isEmpty();
        $promedioMttos = $mantenimientos->avg('id');

        // Verifica si hay mantenimientos programados o si es null
        $proximosMttos = collect([$mantenimientoProgramado])->filter()->merge($mantenimientos->where('mantenimientoFecha', '>=', now())->sortBy('mantenimientoFecha'));

        $completos = $mantenimientos->whereNotNull('archivo_path')->count();
        $porcentajeCompletos = $totalMttos > 0 ? ($completos / $totalMttos) * 100 : 0;

        $archivos = $mantenimientos->whereNotNull('archivo_path');

        return view('mantenimientos.estadisticasItems', compact(
            'item',
            'mantenimientos',
            'correctivos',
            'preventivos',
            'sinMtto',
            'promedioMttos',
            'porcentajeCompletos',
            'proximosMttos',
            'archivos',
            'totalMttos'
        ));
    }




    public function uploadFile(Request $request, $id)
    {
        $request->validate([
            'archivo' => 'required|file|mimes:xls,xlsx',
        ]);

        // Obtener el mantenimiento programado desde la sesión
        $mantenimientosProgramados = session()->get('mantenimientos_programados', []);
        $mantenimientoProgramado = collect($mantenimientosProgramados)->firstWhere('item_id', $id);

        if (!$mantenimientoProgramado) {
            return back()->with('error', 'No hay un mantenimiento programado para esta computadora.');
        }

        if ($request->hasFile('archivo')) {
            $path = $request->file('archivo')->store('mantenimientos', 'public');

            // Crear el mantenimiento solo cuando se sube el archivo
            $mantenimiento = new mantenimiento();
            $mantenimiento->item_id = $id;
            $mantenimiento->mantenimientoFecha = $mantenimientoProgramado['mantenimientoFecha'];
            $mantenimiento->mantenimientoMtto = $mantenimientoProgramado['mantenimientoMtto'];
            $mantenimiento->mantenimientoDetalles = $mantenimientoProgramado['mantenimientoDetalles'];
            $mantenimiento->archivo_path = $path;
            $mantenimiento->completado = true; // Se marca como completado
            $mantenimiento->save();

            // Eliminar el mantenimiento programado de la sesión
            session()->put('mantenimientos_programados', collect($mantenimientosProgramados)->reject(function ($mnt) use ($id) {
                return $mnt['item_id'] === $id;
            })->toArray());

            return redirect()->route('mantenimiento.show', $id)
                ->with('success', 'Archivo subido y mantenimiento marcado como completado');
        }

        return back()->with('error', 'Error al subir el archivo.');
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
