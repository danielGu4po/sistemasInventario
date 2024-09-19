@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Detalles de Encuesta de Satisfaccion</h1>

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
            <table class="table">
                <tr>
                    <th>Numero de Usuario:</th>
                    <td>{{$asignacion->asignarUsuario}}</td>
                </tr>
                <tr>
                    <th>Nombre del prestador</th>
                    <td>{{$asignacion->asignarNoEmpleado}}</td>
                </tr>
                <tr>
                    <th>Fecha de Evaluacion:</th>
                    <td>{{$asignacion->asignarPuesto}}</td>
                </tr>
                <tr>
                    <th>Evaluador:</th>
                    <td>{{$asignacion->asignarDepartamento}}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <th>Periodo:</th>
                    <td>{{$asignacion->asignarEquipoNombre}}</td>
                </tr>
                <tr>
                    <th>Numero de Evaluacion:</th>
                    <td>{{$asignacion->asignarUsuarioNombre}}</td>
                </tr>
                <tr>
                    <th>Categoria de Servicio:</th>
                    <td>{{$asignacion->inventario->inventarioContraseña}}</td>
                </tr>
                <tr>
                    <th>Categoria de Evaluador:</th>
                    <td>{{$asignacion->asignarEquipoCorreo}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h2>Encuesta Checkbox</h2>
            <table class="table table-striped w-100">
                <thead>
                    <tr>
                        <th>Marca y modelo</th>
                        <th>Características</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$asignacion->inventario->inventarioMarca}} / {{$asignacion->inventario->inventarioModelo}}</td>
                        <td>{{$asignacion->inventario->inventarioAlmacenamiento}} / {{$asignacion->inventario->inventarioRAM}}</td>
                        
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