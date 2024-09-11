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
        <form>
            <!-- Campo de Marca -->
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" class="form-control" id="inventarioMarca" name="inventarioMarca" placeholder="" required>
            </div>

            <!-- Campo de Modelo -->
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" class="form-control" id="inventarioModelo" name="inventarioMarca" placeholder="" required>
            </div>

            <!-- Campo de Número de Serie -->
            <div class="mb-3">
                <label for="numSerie" class="form-label">Número de Serie</label>
                <input type="text" class="form-control" id="inventarioSerie" name="inventarioSerie" placeholder="Escribe el número de serie" required>
            </div>

            <!-- Campo de Funcional -->
            <div class="mb-3">
                <label class="form-label">Funcional</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="funcional" id="funcionalSi" value="sí" required>
                    <label class="form-check-label" for="funcionalSi">
                        Sí
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="funcional" id="funcionalNo" value="no">
                    <label class="form-check-label" for="funcionalNo">
                        No
                    </label>
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