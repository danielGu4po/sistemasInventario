@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2 class="text-center mb-4">Formulario de Evaluación de Servicio</h2>

    <form action="{{ route('satisfaccion.store') }}" method="POST">
    @csrf
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap');

            h6 {
                font-family: 'Merriweather', serif;
                font-size: 1.5em;
                color: #2c3e50;
                text-align: center;
                margin-bottom: 1em;
                position: relative;
            }

            h6:before, h6:after {
                content: '';
                position: absolute;
                height: 2px;
                background-color: crimson;
                top: 50%;
                width: 38%;
            }

            h6:before {
                left: 0;
            }

            h6:after {
                right: 0;
            }

            label {
                font-weight: bold;
                color: #34495e;
            }

            input[type="text"],
            input[type="date"],
            input[type="number"],
            textarea {
                width: 100%;
                height: 40px;
                margin-bottom: 10px;
            }

            .text-center {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .form-check {
                display: flex;
                justify-content: flex-start;
                align-items: center;
                width: 100%;
                max-width: 600px;
                margin-bottom: 10px;
            }

            .form-check-input {
                margin-right: 10px;
            }

            .form-check-label {
                text-align: justify;
            }

            .btn-primary {
                background-color: #3498db;
                border-color: #2980b9;
                padding: 10px 20px;
                font-size: 1.1rem;
                transition: background-color 0.3s;
            }

            .btn-primary:hover {
                background-color: #2980b9;
            }

            textarea {
                width: 100%;
                height: 150px;
            }

            .submit-btn-wrapper {
                text-align: center;
                margin-top: 20px;
            }
        </style>

        <!-- Información del Usuario -->
        <h6>Información del Usuario</h6>
        
        <div class="row">
            <div class="col-md-6">
                <label for="numUsuario" class="form-label">Número de Usuario</label>
                <input type="text" class="form-control" id="numUsuario" name="numUsuario" placeholder="Ingrese el número de usuario"  required>
            </div>
            <div class="col-md-6">
                <label for="nombrePrestador" class="form-label">Nombre del Prestador</label>
                <input type="text" class="form-control" id="nombrePrestador" name="nombrePrestador" placeholder="Ingrese el nombre del prestador"  required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="fechaEvaluacion" class="form-label">Fecha de Evaluación</label>
                <input type="date" class="form-control" id="fechaEvaluacion" name="fechaEvaluacion"  required>
            </div>
            <div class="col-md-6">
                <label for="evaluador" class="form-label">Nombre del Evaluador</label>
                <input type="text" class="form-control" id="evaluador" name="evaluador" placeholder="Ingrese el nombre del evaluador" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="periodo" class="form-label">Periodo</label>
                <input type="text" class="form-control" id="periodo" name="periodo" placeholder="Ingrese el periodo" required>
            </div>
            <div class="col-md-6">
                <label for="numEvaluacion" class="form-label">Número de Evaluación</label>
                <input type="number" class="form-control" id="numEvaluacion" name="numEvaluacion" placeholder="Ingrese el número de evaluación" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="periodo" class="form-label">Categoria de servicio</label>
                <input type="text" class="form-control" id="categoriaServicio" name="categoriaServicio" placeholder="Ingrese la categoria"  required>
            </div>
            <div class="col-md-6">
                <label for="numEvaluacion" class="form-label">Categoria del evaluador</label>
                <input type="text" class="form-control" id="categoriaEvaluador" name="categoriaEvaluador" placeholder="Ingrese la categoria"  required>
            </div>
        </div>

        <!-- Checklist de Evaluación -->
        <div class="text-center">
    <div class="d-flex flex-column align-items-start mb-3">
        <div class="d-flex align-items-start mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="check1" id="check1">
                <label class="form-check-label" for="check1">
                    1. Analiza las necesidades del cliente ofreciendo así un servicio adecuado.
                </label>
            </div>
            <textarea class="form-control ms-3" id="accionesMejora1" name="accionesMejora1" cols="30" rows="5" placeholder="Acciones de mejora"></textarea>
        </div>
        <div class="d-flex align-items-start mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="check2" id="check2">
                <label class="form-check-label" for="check2">
                    2. El servicio que se solicita responde a lo que se esperaba y fue atendido en el tiempo acordado.
                </label>
            </div>
            <textarea class="form-control ms-3" id="accionesMejora2" name="accionesMejora2" cols="30" rows="5" placeholder="Acciones de mejora"></textarea>
        </div>
        <div class="d-flex align-items-start mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="check3" id="check3">
                <label class="form-check-label" for="check3">
                    3. Demuestra conocimiento técnico para ejecutar las actividades y cumplir con el cliente.
                </label>
            </div>
            <textarea class="form-control ms-3" id="accionesMejora3" name="accionesMejora3" cols="30" rows="5" placeholder="Acciones de mejora"></textarea>
        </div>
        <div class="d-flex align-items-start mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="check4" id="check4">
                <label class="form-check-label" for="check4">
                    4. Implementa procedimientos de seguimiento y corrección de las actividades planeadas.
                </label>
            </div>
            <textarea class="form-control ms-3" id="accionesMejora4" name="accionesMejora4" cols="30" rows="5" placeholder="Acciones de mejora"></textarea>
        </div>
        <div class="d-flex align-items-start mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="check5" id="check5">
                <label class="form-check-label" for="check5">
                    5. Acató los parámetros establecidos por el cliente para satisfacer las necesidades.
                </label>
            </div>
            <textarea class="form-control ms-3" id="accionesMejora5" name="accionesMejora5" cols="30" rows="5" placeholder="Acciones de mejora"></textarea>
        </div>
        <div class="d-flex align-items-start mb-2">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="check6" id="check6">
                <label class="form-check-label" for="check6">
                    6. El servicio brindado muestra respeto, y actitudes de trato igualitario y/o desinteresado.
                </label>
            </div>
            <textarea class="form-control ms-3" id="accionesMejora6" name="accionesMejora6" cols="30" rows="5" placeholder="Acciones de mejora"></textarea>
        </div>
    </div>
</div>
    <!-- Botón de Enviar -->
    <div class="submit-btn-wrapper">
    <button type="submit" class="btn btn-primary">Enviar Evaluación</button>
    </div>
</form>
</div>
@endsection
