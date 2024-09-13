@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Asignaciones de Inventario</h1>
    @if($asignaciones->isEmpty())
        <p>No hay asignaciones disponibles.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Empleado</th>
                    <th>Número de Empleado</th>
                    <th>Puesto</th>
                    <th>Departamento</th>
                    <th>Modelo</th>
                    <th>Marca</th>
                    <th>No. Serie</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asignacion as $asignaciones)
                    <tr>
                        <td>{{ $asignaciones->asignarUsuario }}</td>
                        <td>{{ $asignaciones->asignarNoEmpleado }}</td>
                        <td>{{ $asignaciones->asignarPuesto }}</td>
                        <td>{{ $asignaciones->asignarDepartamento }}</td>
                        <td>{{ $asignaciones->inventario->inventarioModelo }}</td>
                        <td>{{ $asignaciones->inventario->inventarioMarca }}</td>
                        <td>{{ $asignaciones->inventario->inventarioSerie }}</td>
                        <td>{{$asignaciones->inventario->inventarioObservaciones}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
