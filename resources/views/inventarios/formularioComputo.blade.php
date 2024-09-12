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


        <form id="inventarioForm" action="{{ url('/inventario') }}" method="POST">
            @csrf
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">


            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="inventarioMarca" name="inventarioMarca" placeholder="Ej. Dell, HP, Lenovo..." required>
            </div>


            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="inventarioModelo" name="inventarioModelo" placeholder="Ej. Inspiron 15, MacBook Pro..." required>
            </div>


            <div class="mb-3">
                <label for="numSerie" class="form-label">Número de Serie</label>
                <input type="text" class="form-control" id="inventarioSerie" name="inventarioSerie" placeholder="Escribe el número de serie" required>
            </div>

            <div class="mb-3">
                <label for="ram" class="form-label">Capacidad de RAM</label>
                <input type="text" class="form-control" id="inventarioRam" name="inventarioRam" placeholder="Ej. 8 GB, 16 GB..." required>
            </div>

            <div class="mb-3">
                <label for="almacenamiento" class="form-label">Capacidad de Almacenamiento</label>
                <input type="text" class="form-control" id="inventarioAlmacenamiento" name="inventarioAlmacenamiento" placeholder="Ej. 256 GB SSD, 1 TB HDD..." required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="inventarioContraseña" name="inventarioContraseña" placeholder="Escribe la contraseña" required>
            </div>

            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones</label>
                <textarea class="form-control" id="InventarioObservaciones" name="inventarioObservaciones" rows="3" placeholder="Escribe cualquier observación adicional"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Dispositivo</button>
        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
@endsection