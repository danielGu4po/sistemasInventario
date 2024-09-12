@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <h1 class="mb-4">Computó</h1>
    <form action="{{ url('/inventario') }}" method="POST">
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
        <input type="hidden" name="_token" value="{{csrf_token()}}" id="token">
        <h6>Datos Generales</h6>
        <div class="row">
            <div class="col-4">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="inventarioMarca" name="inventarioMarca" placeholder="Ej. Dell, HP, Lenovo..." required>
            </div>
            <div class="col-4">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="inventarioModelo" name="inventarioModelo" placeholder="Ej. Inspiron 15, MacBook Pro..." required>
            </div>
            <div class="col-4">
                <label for="numSerie" class="form-label">Número de Serie</label>
                <input type="text" class="form-control" id="inventarioSerie" name="inventarioSerie" placeholder="Escribe el número de serie" required>
            </div>
        </div>
        <h6>Información funcional</h6>
        <div class="row">
            <div class="col-4">
                <label for="ram" class="form-label">Capacidad de RAM</label>
                <input type="text" class="form-control" id="inventarioRam" name="inventarioRam" placeholder="Ej. 8 GB, 16 GB..." required>
            </div>
            <div class="col-4">
                <label for="almacenamiento" class="form-label">Capacidad de Almacenamiento</label>
                <input type="text" class="form-control" id="inventarioAlmacenamiento" name="inventarioAlmacenamiento" placeholder="Ej. 256 GB SSD, 1 TB HDD..." required>
            </div>
            <div class="col-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inventarioContraseña" name="inventarioContraseña" placeholder="Escribe la contraseña" required>
            </div>
        </div>
        <h6>Observaciones</h6>
        <div class="col-md-12">
            <textarea class="form-control" id="InventarioObservaciones" name="inventarioObservaciones" rows="3" placeholder="Escribe cualquier observación adicional"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Registrar Dispositivo</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</div>
@endsection