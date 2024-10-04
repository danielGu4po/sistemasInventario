@extends('layouts.app')
@section('content')

<div class="container mt-3">
    <h1 class="mb-4">Mantenimientos</h1> 
    <div class="row justify-content-between">
        <div class="col-auto">
            <a href="{{ route('descargar.formato.mttos') }}" class="btn btn-primary">Formato de Mttos.</a>
        </div>
        <div class="col-auto">
            <form action="{{ route('mantenimiento.notificar') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-secondary">Notificar</button>
            </form>
        </div>
    </div>

    <br>

    <table class="table table-striped mt-4" id="inventarioTable">
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

<!-- Incluir DataTables y jQuery desde el CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar DataTables
        $('#inventarioTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50, 100],
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "searching": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json" // Traducción al español
            }
        });
    });
</script>
@endsection
