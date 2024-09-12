@extends('layouts.app')

@section('content')

<body>
    <div class="container mt-3">
        <h2 class="text-center mb-4">Telefonía</h2>

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
                <div class="col-4">
                    <div class="form-group">
                        <label for="marca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="inventarioMarca" name="inventarioMarca" placeholder="Ej. Dell, HP, Lenovo" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="modelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="inventarioModelo" name="inventarioModelo" placeholder="Ej. Inspiron 15, MacBook Pro" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="numSerie" class="form-label">Número de Serie</label>
                        <input type="text" class="form-control" id="inventarioSerie" name="inventarioSerie" placeholder="Escribe el número de serie" required>
                    </div>
                </div>
            </div>
            <h6>Funcionalidad</h6>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="telefono" class="form-label">Número de Teléfono</label>
                        <input type="tel" class="form-control" id="inventarioNumTel" name="inventarioNumTel" placeholder="Ej. +1234567890" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="linea" class="form-label">Linea</label>
                        <input type="tel" class="form-control" id="inventarioNumTel" name="inventarioNumTel" placeholder="Ej. +1234567890" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="Estado" class="col-form-label">Estado</label>
                        <select class="form-select" name="inventarioEstado" id="inventarioEstado">
                            <option value="Funcional">Funcional</option>
                            <option value="No Funcional">No Funcional</option>
                        </select>
                    </div>
                </div>
            </div>
            <h6>Observaciones</h6>
            <div class="col-md-12">
                <textarea class="form-control" id="inventarioObservaciones" name="inventarioObservaciones" rows="3" placeholder="Escribe cualquier observación adicional"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Registrar</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection