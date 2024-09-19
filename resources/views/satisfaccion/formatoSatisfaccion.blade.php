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
                    <td>{{ $evaluacion->numUsuario }}</td>
                </tr>
                <tr>
                    <th>Nombre del prestador</th>
                    <td>{{ $evaluacion->nombrePrestador }}</td>
                </tr>
                <tr>
                    <th>Fecha de Evaluacion:</th>
                    <td>{{ \Carbon\Carbon::parse($evaluacion->fechaEvaluacion)->format('Y/m/d') }}</td>
                </tr>
                <tr>
                    <th>Evaluador:</th>
                    <td>{{ $evaluacion->evaluador }}</td>
                </tr>
            </table>
        </div>
        <div class="col-md-6">
            <table class="table">
                <tr>
                    <th>Periodo:</th>
                    <td>{{ $evaluacion->periodo }}</td>
                </tr>
                <tr>
                    <th>Numero de Evaluacion:</th>
                    <td>{{ $evaluacion->numEvaluacion }}</td>
                </tr>
                <tr>
                    <th>Categoria de Servicio:</th>
                    <td>{{ $evaluacion->categoriaServicio }}</td>
                </tr>
                <tr>
                    <th>Categoria de Evaluador:</th>
                    <td>{{ $evaluacion->categoriaEvaluador }}</td>
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
                        <th>Consepto</th>
                        <th>Cumple</th>
                        <th>Acciones de mejora</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1.-Analiza las necesidades del cliente ofreciendo así un servicio adecuado.<br>
                            2.-El servicio que se solicita responde a lo que se esperaba y atendido en el tiempo acordado.<br>
                            3.-Demuestra conocimiento técnico para ejecutar las actividades y cumplir con el cliente.<br>
                            4.-Implementar procedimiento de seguimiento y correción de las actividades planeadas.<br>
                            5.-Acato los parámetros establecidos por el cliente para satisfacer las necesidades.<br>
                            6.-El servicio brindado muestra respeto, y actitudes de trato igualitario y/o desinteresado.<br> </td>
                            <td>{{ $evaluacion->check1 }} <br> {{ $evaluacion->check2 }} <br>{{ $evaluacion->check3 }}<br>{{ $evaluacion->check4 }}<br>{{ $evaluacion->check5 }}<br>{{ $evaluacion->check6 }}</td>
                            <td>{{ $evaluacion->accionesMejora1 }} <br>{{ $evaluacion->accionesMejora2 }}<br>{{ $evaluacion->accionesMejora3 }}<br>{{ $evaluacion->accionesMejora4 }}<br>{{ $evaluacion->accionesMejora5 }}<br>{{ $evaluacion->accionesMejora6 }}</td>
                            

                        
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="center-buttons">
        <form action="{{ route('asignar.destroy', $evaluacion->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Borrar</button>
        </form>
        <a href="{{ route('excel.export2', $evaluacion->id) }}" class="btn btn-secondary">Generar Excel</a>

    </div>
</div>
</div>

@endsection