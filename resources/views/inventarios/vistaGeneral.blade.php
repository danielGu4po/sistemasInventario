@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Lista de Inventario General</h1>
    @if($datosGeneral->isEmpty())
        <p>No hay datos disponibles.</p>
    @else
        <!-- Agregamos un ID a la tabla para DataTables -->
        <table class="table table-striped" id="inventarioTable">
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
                        <td>{{ $item->inventarioAsignado ? 'Si' : 'No' }}</td>
                        <td>{{ $item->inventarioCategoria }}</td>
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
