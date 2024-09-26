@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Detalles del Mantenimiento</h1>

    <style>
        .form-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .form-group {
            margin-bottom: 1rem;
        }

        .form-group label {
            display: block;
        }

        .form-group .form-control,
        .form-group .form-control-plaintext {
            width: 100%;
        }

        .tipo-mantenimiento {
            text-align: center;
            margin-top: 20px;
        }

        .tipo-mantenimiento label.main {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .options {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        [type="radio"] {
            margin-right: 5px;
        }
    </style>

    <div class="row">
        <div class="col-md-6">
            <h2>Equipo</h2>
            <table class="table">
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
        <div class="col-md-6">
            <h2>Estadísticas</h2>
            <ul>
                <li>Mantenimientos correctivos: {{ $correctivos }}</li>
                <li>Mantenimientos preventivos: {{ $preventivos }}</li>
                <li>{{ $sinMtto ? 'Este equipo no ha recibido mantenimiento.' : 'Este equipo ya ha recibido mantenimiento.' }}</li>
                <li>Promedio de mantenimientos: {{ number_format($promedioMttos, 2) }}</li>
                <li>Porcentaje de mantenimientos completados: {{ number_format($porcentajeCompletos, 2) }}%</li>
            </ul>
            @if($proximosMttos->isNotEmpty())
            <h3>Próximos mantenimientos programados:</h3>
            <ul>
                @foreach($proximosMttos as $mantenimiento)
                <li>{{ $mantenimiento->mantenimientoFecha }} - {{ $mantenimiento->mantenimientoMtto }}</li>
                @endforeach
            </ul>
            @else
            <p>No hay mantenimientos programados.</p>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h2>Programar Mantenimiento</h2>
            <form action="{{ route('mantenimiento.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="mantenimientoFecha">Trimestre del Mantenimiento:</label>
                        <select class="form-control" id="mantenimientoFecha" name="mantenimientoFecha">
                            <option value="Q1">Primer Trimestre (Enero - Marzo)</option>
                            <option value="Q2">Segundo Trimestre (Abril - Junio)</option>
                            <option value="Q3">Tercer Trimestre (Julio - Septiembre)</option>
                            <option value="Q4">Cuarto Trimestre (Octubre - Diciembre)</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="tipo-mantenimiento">
                            <label class="main">Tipo de Mantenimiento:</label>
                            <div class="options">
                                <label>
                                    <input type="radio" name="mantenimientoMtto" value="Correctivo" checked> Correctivo
                                </label>
                                <label>
                                    <input type="radio" name="mantenimientoMtto" value="Preventivo"> Preventivo
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="mantenimientoDetalles">Detalles del Mantenimiento:</label>
                    <textarea class="form-control" id="mantenimientoDetalles" name="mantenimientoDetalles" rows="3"></textarea>
                </div>

                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <button type="submit" class="btn btn-success">Guardar Mantenimiento</button>
            </form>
        </div>
    </div>
</div>

@endsection