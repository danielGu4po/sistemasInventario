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
                    <th>Correo Electronico</th>
                </tr>
            </thead>
            <tbody>
                @foreach($asignaciones as $asignacion)
                    <tr>
                        <td>{{ $asignacion->asignarUsuario }}</td>
                        <td>{{ $asignacion->asignarNoEmpleado }}</td>
                        <td>{{ $asignacion->asignarPuesto }}</td>
                        <td>{{ $asignacion->asignarDepartamento }}</td>
                        <td>{{ $asignacion->asignarEquipoCorreo }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
