@extends('layouts.app')

@section('content')
<div class="container mt-3">
    <h2 class="text-center mb-4">Formulario de Evaluación de Servicio</h2>

    <form action="{{ route('satisfaccion.formato', ['id' => $evaluacion->id]) }}" method="POST">
        @csrf

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Merriweather:wght@700&display=swap');

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

            label {
                font-weight: bold;
                color: #34495e;
            }

            .form-group {
                margin-bottom: 20px;
            }

            .text-center {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            .form-check {
                display: flex;
                align-items: center;
                margin: 0; /* Eliminar márgenes predeterminados para un mejor ajuste */
            }

            .form-check-input {
                margin-left: 10px; /* Espacio entre el texto y el checkbox */
            }

            textarea {
                width: 100%;
                height: 100px;
                margin-top: 5px;
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

            .submit-btn-wrapper {
                text-align: center;
                margin-top: 20px;
            }

            .form-check-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
            }

            .form-check-container label {
                flex: 1;
                margin-right: 10px; /* Espacio entre el texto y el checkbox */
            }

            .form-check-container .form-check {
                margin-left: auto; /* Empuja el checkbox hacia la derecha */
            }

        </style>

        <!-- Información del Usuario -->    
        <h6>Información del Usuario</h6>
        <br>
        <div class="row">
            <div class="col-md-6">
                <label for="numUsuario" class="form-label">Número de Usuario</label>
                <input type="text" class="form-control" id="numUsuario" name="numUsuario" placeholder="Ingrese el número de usuario" required>
            </div>
            <div class="col-md-6">
                <label for="nombrePrestador" class="form-label">Nombre del Prestador</label>
                <input type="text" class="form-control" id="nombrePrestador" name="nombrePrestador" placeholder="Ingrese el nombre del prestador" required>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="fechaEvaluacion" class="form-label">Fecha de Evaluación</label>
                <input type="date" class="form-control" id="fechaEvaluacion" name="fechaEvaluacion" required>
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
                <label for="categoriaServicio" class="form-label">Categoría de Servicio</label>
                <input type="text" class="form-control" id="categoriaServicio" name="categoriaServicio" placeholder="Ingrese la categoria" required>
            </div>
            <div class="col-md-6">
                <label for="categoriaEvaluador" class="form-label">Categoría del Evaluador</label>
                <input type="text" class="form-control" id="categoriaEvaluador" name="categoriaEvaluador" placeholder="Ingrese la categoria" required>
            </div>
        </div>

        <!-- Checklist de Evaluación en dos columnas -->
        <h6>Checklist de Evaluación</h6>
        <br>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-check-container">
                        <label for="check1">1. Analiza las necesidades del cliente ofreciendo así un servicio adecuado.</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="check1" id="check1">
                        </div>
                    </div>
                    <textarea class="form-control" id="accionesMejora1" name="accionesMejora1" placeholder="Acciones de mejora"></textarea>
                </div>

                <div class="form-group">
                    <div class="form-check-container">
                        <label for="check2">2. El servicio que se solicita responde a lo que se esperaba y fue atendido en el tiempo acordado.</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="check2" id="check2">
                        </div>
                    </div>
                    <textarea class="form-control" id="accionesMejora2" name="accionesMejora2" placeholder="Acciones de mejora"></textarea>
                </div>

                <div class="form-group">
                    <div class="form-check-container">
                        <label for="check3">3. Demuestra conocimiento técnico para ejecutar las actividades y cumplir con el cliente.</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="check3" id="check3">
                        </div>
                    </div>
                    <textarea class="form-control" id="accionesMejora3" name="accionesMejora3" placeholder="Acciones de mejora"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <div class="form-check-container">
                        <label for="check4">4. Implementa procedimientos de seguimiento y corrección de las actividades planeadas.</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="check4" id="check4">
                        </div>
                    </div>
                    <textarea class="form-control" id="accionesMejora4" name="accionesMejora4" placeholder="Acciones de mejora"></textarea>
                </div>

                <div class="form-group">
                    <div class="form-check-container">
                        <label for="check5">5. Acató los parámetros establecidos por el cliente para satisfacer las necesidades.</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="check5" id="check5">
                        </div>
                    </div>
                    <textarea class="form-control" id="accionesMejora5" name="accionesMejora5" placeholder="Acciones de mejora"></textarea>
                </div>

                <div class="form-group">
                    <div class="form-check-container">
                        <label for="check6">6. El servicio brindado muestra respeto, y actitudes de trato igualitario y/o desinteresado.</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="check6" id="check6">
                        </div>
                    </div>
                    <textarea class="form-control" id="accionesMejora6" name="accionesMejora6" placeholder="Acciones de mejora"></textarea>
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
