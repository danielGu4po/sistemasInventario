@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Evaluaciones de Servicio</h1>
    @if($evaluaciones->isEmpty())
    <p>No hay evaluaciones disponibles.</p>
    @else
    <table class="table table-striped" id="evaluacionesTable">
        <thead>
            <tr>
                <th>Numero de Usuario</th>
                <th>Nombre de Prestador</th>
                <th>Fecha de Evaluacion</th>
                <th>Evaluador</th>
                <th>Periodo</th>
                <th>Numero de Evaluacion</th>
                <th>Categoria Servicio</th>
                <th>Categoria Evaluador</th>
                <th>Ver</th>
            </tr>
        </thead>
        <tbody>
            @foreach($evaluaciones as $evaluacion)
            <tr>
                <td>{{ $evaluacion->numUsuario }}</td>
                <td>{{ $evaluacion->nombrePrestador }}</td>
                <td>{{ \Carbon\Carbon::parse($evaluacion->fechaEvaluacion)->format('Y/m/d') }}</td>
                <td>{{ $evaluacion->evaluador }}</td>
                <td>{{ $evaluacion->periodo }}</td>
                <td>{{ $evaluacion->numEvaluacion }}</td>
                <td>{{ $evaluacion->categoriaServicio }}</td>
                <td>{{ $evaluacion->categoriaEvaluador }}</td>
                <td>
                    <a href="{{ route('satisfaccion.show', $evaluacion->id) }}" class="btn btn-info btn-sm">Ver</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif

    <div class="text-center mt-4">
        <a href="#" class="btn btn-primary">Matriz de Satisfaccion</a>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#evaluacionesTable').DataTable({
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
