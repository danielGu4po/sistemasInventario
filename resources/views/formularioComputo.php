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
        
        
        <form action="{{ route('form.store') }}" method="POST">
        <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">

    
    <div class="mb-3">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" class="form-control" id="marca" name="marca" placeholder="Ej. Dell, HP, Lenovo..." required>
    </div>

    
    <div class="mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Ej. Inspiron 15, MacBook Pro..." required>
    </div>

    
    <div class="mb-3">
        <label for="numSerie" class="form-label">Número de Serie</label>
        <input type="text" class="form-control" id="numSerie" name="numSerie" placeholder="Escribe el número de serie" required>
    </div>

    <!-- Campo de Capacidad de RAM -->
    <div class="mb-3">
        <label for="ram" class="form-label">Capacidad de RAM</label>
        <input type="text" class="form-control" id="ram" name="ram" placeholder="Ej. 8 GB, 16 GB..." required>
    </div>

    <!-- Campo de Capacidad de Almacenamiento -->
    <div class="mb-3">
        <label for="almacenamiento" class="form-label">Capacidad de Almacenamiento</label>
        <input type="text" class="form-control" id="almacenamiento" name="almacenamiento" placeholder="Ej. 256 GB SSD, 1 TB HDD..." required>
    </div>

    <!-- Campo de Contraseña -->
    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Escribe la contraseña" required>
    </div>

    <!-- Campo de Observaciones -->
    <div class="mb-3">
        <label for="observaciones" class="form-label">Observaciones</label>
        <textarea class="form-control" id="observaciones" name="observaciones" rows="3" placeholder="Escribe cualquier observación adicional"></textarea>
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