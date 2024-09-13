@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Detalles de la Asignación</h1>

    <style>
        .center-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .card-custom {
            margin: auto;
            margin-bottom: 20px;
            width: 70%;
            border: 1px solid #ccc;
        }

        .table-compact {
            width: 100%;
        }

        .table-compact td,
        .table-compact th {
            padding: 8px;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
            border-collapse: collapse;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }
    </style>

    <div class="row">
        <div class="col-md-6">
            <h2>Datos del solicitante</h2>
            <table class="table">
                <tr>
                    <th>Nombre del Usuario:</th>
                    <td>{{$asignacion->asignarUsuario}}</td>
                </tr>
                <tr>
                    <th>No. De Empleado:</th>
                    <td>{{$asignacion->asignarNoEmpleado}}</td>
                </tr>
                <tr>
                    <th>Puesto:</th>
                    <td>{{$asignacion->asignarPuesto}}</td>
                </tr>
                <tr>
                    <th>Departamento:</th>
                    <td>{{$asignacion->asignarDepartamento}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <h2>Datos del ítem solicitado</h2>
            <table class="table">
                <tr>
                    <th>Nombre del Equipo:</th>
                    <td>{{$asignacion->asignarEquipoNombre}}</td>
                </tr>
                <tr>
                    <th>Nombre de Usuario:</th>
                    <td>{{$asignacion->asignarUsuarioNombre}}</td>
                </tr>
                <tr>
                    <th>Contraseña:</th>
                    <td>{{$asignacion->inventario->inventarioContraseña}}</td>
                </tr>
                <tr>
                    <th>Correo Electrónico:</th>
                    <td>{{$asignacion->asignarEquipoCorreo}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Detalles del Artículo</h2>
            <table class="table table-striped w-100">
                <thead>
                    <tr>
                        <th>Marca y modelo</th>
                        <th>Características</th>
                        <th>No. de serie</th>
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$asignacion->inventario->inventarioMarca}} / {{$asignacion->inventario->inventarioModelo}}</td>
                        <td>{{$asignacion->inventario->inventarioAlmacenamiento}} / {{$asignacion->inventario->inventarioRAM}}</td>
                        <td>{{$asignacion->inventario->inventarioSerie}}</td>
                        <td>{{$asignacion->inventario->inventarioEstado}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="center-buttons">
        <form action="{{ route('asignar.destroy', $asignacion->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Quitar Asignación</button>
        </form>
        <a href="{{ route('asignar.pdf', $asignacion->id) }}" class="btn btn-secondary">Responsiva</a>
    </div>
</div>
</div>

@endsection