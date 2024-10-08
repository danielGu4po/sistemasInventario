@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Mantenimientos Misceláneo</h1>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Asignado a</th>
                <th>Estado</th>
                <th>Mantenimiento</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->inventarioMarca }}</td>
                <td>{{ $item->inventarioModelo }}</td>
                <td>
                    @if($item->asignaciones->isNotEmpty())
                    {{ $item->asignaciones->first()->asignarUsuarioNombre }}
                    @else
                    No asignado
                    @endif
                </td>
                <td>
                    @if($item->asignaciones->isNotEmpty())
                    {{ $item->asignaciones->first()->asignarEquipoCorreo }}
                    @else
                    N/A
                    @endif
                </td>
                <td>{{ $item->inventarioRAM }}</td>
                <td>{{ $item->inventarioAlmacenamiento }}</td>
                <td>{{ $item->inventarioEstado }}</td>
                <td>
                    <a href="{{ route('mantenimiento.show', $item->id) }}" class="btn btn-primary">Programar Mantenimiento</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection