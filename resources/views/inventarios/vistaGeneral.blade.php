@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Lista de Inventario General</h1>
    @if($datosGeneral->isEmpty())
        <p>No hay datos disponibles.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>No. Serie</th>
                    <th>Estado</th>
                    <th>Observaciones</th>
                    <th>Asignado</th>
                    <th>Categoría</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datosGeneral as $item)
                    <tr>
                        <td>{{ $item->inventarioModelo }}</td>
                        <td>{{ $item->inventarioMarca }}</td>
                        <td>{{ $item->inventarioSerie }}</td>
                        <td>
                            <span class="estado {{ $item->inventarioEstado == 'Funcional' ? 'estado-funcional' : 'estado-no-funcional' }}">
                                {{ $item->inventarioEstado }}
                            </span>
                        </td>
                        <td>{{ $item->inventarioObservaciones }}</td>
                        <td>{{$item->inventarioAsignado ? 'Si' : 'No'}}</td>
                        <td>{{$item->inventarioCategoria}}</td>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<style>
    .estado {
        display: inline-block;
        padding: 2px 10px;
        border-radius: 12px;
        border: 2px solid;
    }

    .estado-funcional {
        border-color: green;
        color: green;
    }

    .estado-no-funcional {
        border-color: red;
        color: red;
    }
</style>

@endsection
