@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Dispositivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Formulario de Registro de Dispositivo</h2>
        
        <!-- Inicio del formulario -->
        <form id="inventarioForm" action="{{ url('/inventario') }}" method="POST">
        @csrf
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
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
        <h6>Datos Generales</h6>
        <div class="row">
            <!-- Campo de Marca -->
            <div class="col-4">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="inventarioMarca" name="inventarioMarca" placeholder="" required>
            </div>

            <!-- Campo de Modelo -->
            <div class="col-4">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="inventarioModelo" name="inventarioModelo" placeholder="" required>
            </div>

            <!-- Campo de Número de Serie -->
            <div class="col-4">
                <label for="numSerie" class="form-label">Número de Serie</label>
                <input type="text" class="form-control" id="inventarioSerie" name="inventarioSerie" placeholder="Escribe el número de serie" required>
            </div>
            </div>
            <!-- Campo de Funcional -->
            <div class="mb-3 text-center">
                    <label class="form-label">Funcional</label>
                    <div class="d-flex justify-content-center">
                        <div class="form-check me-3">
                            <input class="form-check-input" type="radio" name="inventarioEstado" id="inventarioEstadoSi" value="sí" required>
                            <label class="form-check-label" for="inventarioEstadoSi">
                                Sí
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="inventarioEstado" id="inventarioEstadoNo" value="no">
                            <label class="form-check-label" for="inventarioEstadoNo">
                                No
                            </label>
                        </div>
                    </div>
                </div>

            <!-- Campo de Observaciones -->
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" id="inventarioObservaciones" name="inventarioObservaciones" rows="3" placeholder="Escribe cualquier observación adicional"></textarea>
            </div>

            <!-- Botón de Enviar -->
            <button type="submit" class="btn btn-primary">Registrar Dispositivo</button>
        </form>
        <!-- Fin del formulario -->
    </div>

    <!-- JS de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection