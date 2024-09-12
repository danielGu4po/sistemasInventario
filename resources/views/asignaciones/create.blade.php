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
    <h1 class="mb-4">Asignar Elementos del Inventario</h1>
    <form action="{{ route('asignar.store') }}" method="POST">
        @csrf
        <h6>Datos del Solicitante:</h6>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="asignarUsuario">Nombre del Empleado</label>
                    <input type="text" name="asignarUsuario" id="asignarUsuario" class="form-control" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="asignarNoEmpleado">Número de Empleado</label>
                    <input type="number" name="asignarNoEmpleado" id="asignarNoEmpleado" class="form-control" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="asignarPuesto">Puesto</label>
                    <input type="text" name="asignarPuesto" id="asignarPuesto" class="form-control" required>
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="asignarDepartamento">Departamento</label>
                    <input type="text" name="asignarDepartamento" id="asignarDepartamento" class="form-control" required>
                </div>
            </div>
        </div>
        <h6>Datos del Ítem seleccionado</h6>
        <div class="row">
            <div class="col-4">
                <div class="form-group">
                    <label for="asignarEquipoNombre">Nombre del Equipo</label>
                    <input type="text" name="asignarEquipoNombre" id="asignarEquipoNombre" class="form-control" required>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="asignarUsuarioNombre">Nombre de Usuario</label>
                    <input type="text" name="asignarUsuarioNombre" id="asignarUsuarioNombre" class="form-control" required>
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="asignarEquipoCorreo">Correo del Equipo</label>
                    <input type="text" name="asignarEquipoCorreo" id="asignarEquipoCorreo" class="form-control" required>
                </div>
            </div>
                                    <div class="col-4">
                            <div class="form-group">
                                <label for="inventarioAsignado">Inventario</label>
                                <select name="inventarioAsignado" id="inventarioAsignado" class="form-control" required>
                                    <option value="">Seleccione un ítem</option>
                                    @foreach($inventarios as $inventario)
                                        <option value="{{ $inventario->id }}">
                                            {{ $inventario->inventarioMarca }} - {{ $inventario->inventarioSerie }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
        <button type="submit" class="btn btn-success">Asignar Ítem</button>
    </form>
</div>
@endsection