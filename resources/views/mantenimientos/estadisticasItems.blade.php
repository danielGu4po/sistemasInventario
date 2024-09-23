@extends('layouts.app')

@section('content')

<style>
    @import url(https://fonts.googleapis.com/css?family=Merriweather:700);

    h6 {
        border-collapse: separate;
        border-spacing: 16px 0;
        color: #123;
        display: table;
        font-family: arial;
        font-weight: 700;
        font-size: 5em;
        line-height: .25;
        margin: 1em -15px 0.5em;
        table-layout: auto;
        text-align: center;
        text-shadow: .0625em .0625em 0 rgba(0, 0, 0, .2);
        white-space: nowrap;
        width: 100%;
    }

    h6 {
        font-size: 1.25em;
    }

    h6:before {
        border-top: 3px double #123;
        content: '';
        display: table-cell;
        width: 5%;
    }

    h6:after {
        border-top: 3px double #123;
        content: '';
        display: table-cell;
        width: 95%;
    }

    h6:before {
        border-top-color: Crimson;
        border-top-style: ridge;
    }

    h6:after {
        border-top-color: Crimson;
        border-top-style: ridge;
    }

    textarea {
        width: 100%;
        height: 150px;
    }
</style>

<div class="container mt-3">
    <div class="card">
        <div class="card-header">
            <h3>Detalles del Mantenimiento</h3>
        </div>
        <div class="card-body">
            <p><strong>Marca:</strong> {{ $item->inventarioMarca }}</p>
            <p><strong>Modelo:</strong> {{ $item->inventarioModelo }}</p>
            <p><strong>Memoria RAM:</strong> {{ $item->inventarioRAM }}</p>
            <p><strong>Almacenamiento:</strong> {{ $item->inventarioAlmacenamiento }}</p>
            <p><strong>Estado:</strong> {{ $item->inventarioEstado }}</p>
            <p><strong>Observaciones:</strong> {{ $item->inventarioObservaciones }}</p>

            @if($item->asignaciones->isNotEmpty())
            <h4>Información de Asignación:</h4>
            <p><strong>Asignado a:</strong> {{ $item->asignaciones->first()->asignarUsuarioNombre }}</p>
            <p><strong>Correo del usuario:</strong> {{ $item->asignaciones->first()->asignarEquipoCorreo }}</p>
            @else
            <p><strong>Asignado a:</strong> No asignado</p>
            @endif

            <h4>Programar Mantenimiento</h4>
            <form action="{{ route('mantenimiento.store') }}" method="POST">
                @csrf
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <div class="form-group">
                    <label for="mantenimientoFecha">Fecha del Mantenimiento:</label>
                    <input type="date" class="form-control" id="mantenimientoFecha" name="mantenimientoFecha" required>
                </div>
                <div class="form-group">
                    <label for="mantenimientoDetalles">Detalles del Mantenimiento:</label>
                    <textarea class="form-control" id="mantenimientoDetalles" name="mantenimientoDetalles" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Guardar Mantenimiento</button>
            </form>
        </div>
    </div>
</div>
@endsection