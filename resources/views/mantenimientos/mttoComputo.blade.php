@extends('layouts.app')
@section('content')

<div class="container mt-3">
    <h1 class="mb-4">Mantenimientos Computó</h1> 
    <div class="row justify-content-between">
        <div class="col-auto">
            <a href="{{ route('descargar.formato.mttos') }}" class="btn btn-primary">Formato de Mttos.</a>
        </div>
        <div class="col-auto">
            <form action="{{ route('mantenimiento.notificar') }}" method="POST">
                @csrf
                <!-- Aquí puedes agregar input hidden si necesitas enviar más datos al servidor -->
                <button type="submit" class="btn btn-warning">Notificar</button>
            </form>
        </div>
    </div>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Asignado a</th>
                <th>Correo</th>
                <th>Memoria RAM</th>
                <th>Almacenamiento</th>
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
