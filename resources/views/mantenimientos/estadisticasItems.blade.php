@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Detalles del Mantenimiento</h1>

    <!-- Información del equipo -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h2>Información del Equipo</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <th>Marca:</th>
                    <td>{{ $item->inventarioMarca }}</td>
                </tr>
                <tr>
                    <th>Modelo:</th>
                    <td>{{ $item->inventarioModelo }}</td>
                </tr>
                <tr>
                    <th>Memoria RAM:</th>
                    <td>{{ $item->inventarioRAM }}</td>
                </tr>
                <tr>
                    <th>Almacenamiento:</th>
                    <td>{{ $item->inventarioAlmacenamiento }}</td>
                </tr>
                <tr>
                    <th>Estado:</th>
                    <td>{{ $item->inventarioEstado }}</td>
                </tr>
                <tr>
                    <th>Observaciones:</th>
                    <td>{{ $item->inventarioObservaciones }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Estadísticas del Mantenimiento -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h2>Estadísticas del Mantenimiento</h2>
        </div>
        <div class="card-body">
            <ul class="list-group">
                <li class="list-group-item"><strong>Total de Mantenimientos:</strong> {{ $totalMttos }}</li>
                <li class="list-group-item"><strong>Mantenimientos Correctivos:</strong> {{ $correctivos }}</li>
                <li class="list-group-item"><strong>Mantenimientos Preventivos:</strong> {{ $preventivos }}</li>
                <li class="list-group-item"><strong>Promedio de Mantenimientos:</strong> {{ number_format($promedioMttos, 2) }}</li>
                <li class="list-group-item"><strong>Porcentaje de Mantenimientos Completados:</strong> {{ number_format($porcentajeCompletos, 2) }}%</li>
                <li class="list-group-item">{{ $sinMtto ? 'Este equipo no ha recibido mantenimiento.' : 'Este equipo ya ha recibido mantenimiento.' }}</li>
            </ul>
        </div>
    </div>

    <!-- Programar mantenimiento -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h2>Programar Mantenimiento</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('mantenimiento.programar', $item->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="mantenimientoFecha">Fecha del Mantenimiento:</label>
                    <input type="date" class="form-control" id="mantenimientoFecha" name="mantenimientoFecha" required>
                </div>

                <div class="form-group">
                    <label for="mantenimientoMtto">Tipo de Mantenimiento:</label>
                    <select class="form-control" id="mantenimientoMtto" name="mantenimientoMtto" required>
                        <option value="Correctivo">Correctivo</option>
                        <option value="Preventivo">Preventivo</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="mantenimientoDetalles">Detalles del Mantenimiento:</label>
                    <textarea class="form-control" id="mantenimientoDetalles" name="mantenimientoDetalles" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Programar Mantenimiento</button>
            </form>
        </div>
    </div>

    <!-- Próximos mantenimientos programados -->
    <!-- Próximos mantenimientos programados -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h2>Próximos Mantenimientos Programados</h2>
        </div>
        <div class="card-body">
            @if($proximosMttos->isNotEmpty())
            <ul class="list-group list-group-flush">
                @foreach($proximosMttos as $mnt)
                @if($mnt)
                <li class="list-group-item">
                    {{ \Carbon\Carbon::parse($mnt['mantenimientoFecha'])->format('d/m/Y') }} - {{ $mnt['mantenimientoMtto'] }}
                    @if(isset($mnt['completado']) && $mnt['completado'])
                    - <a href="{{ Storage::url($mnt['archivo_path']) }}" target="_blank">Ver archivo</a>
                    @else
                    - <span class="text-warning">Pendiente</span>
                    @endif
                </li>
                @endif
                @endforeach
            </ul>
            @else
            <p class="text-muted">No hay mantenimientos programados.</p>
            @endif
        </div>
    </div>


    <!-- Subir archivo de mantenimiento -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h2>Subir Archivo de Mantenimiento y Guardar</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('mantenimiento.uploadFile', $item->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="archivo">Subir archivo de Excel</label>
                    <input type="file" class="form-control" id="archivo" name="archivo" required>
                </div>

                <button type="submit" class="btn btn-success mt-3">Subir Archivo y Guardar Mantenimiento</button>
            </form>
        </div>
    </div>

    <!-- Archivos de mantenimientos completados -->
    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            <h2>Archivos de Mantenimientos Completados</h2>
        </div>
        <div class="card-body">
            @if($archivos->isNotEmpty())
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Tipo de Mantenimiento</th>
                        <th>Archivo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($archivos as $archivo)
                    <tr>
                        <td>{{ $archivo->mantenimientoFecha }}</td>
                        <td>{{ $archivo->mantenimientoMtto }}</td>
                        <td><a href="{{ Storage::url($archivo->archivo_path) }}" target="_blank" class="btn btn-link">Ver archivo</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-muted">No hay archivos subidos.</p>
            @endif
        </div>
    </div>
</div>
@endsection