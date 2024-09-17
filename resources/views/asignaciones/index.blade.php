@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Asignaciones de Inventario</h1>
    @if($asignaciones->isEmpty())
    <p>No hay asignaciones disponibles.</p>
    @else
    <table class="table table-striped" id="asignacionesTable">
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
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            @foreach($asignaciones as $asignacion)
            <tr>
                <td>{{ $asignacion->asignarUsuario }}</td>
                <td>{{ $asignacion->asignarNoEmpleado }}</td>
                <td>{{ $asignacion->asignarPuesto }}</td>
                <td>{{ $asignacion->asignarDepartamento }}</td>
                <td>{{ $asignacion->inventario->inventarioModelo }}</td>
                <td>{{ $asignacion->inventario->inventarioMarca }}</td>
                <td>{{ $asignacion->inventario->inventarioSerie }}</td>
                <td>{{$asignacion->inventario->inventarioObservaciones}}</td>
                <td>
                    <a href="{{route('asignar.show',$asignacion->id)}}" class="btn btn-info btn-sm">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="text-center mt-4">
        <a href="#" class="btn btn-primary">Matriz de Asignación</a>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#asignacionesTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50, 100],
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "searching": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json"
            }
        });
    });
</script>

@endsection