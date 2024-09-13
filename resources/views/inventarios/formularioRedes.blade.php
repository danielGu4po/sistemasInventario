@extends('layouts.app')
@section('content')
<div class="container mt-3">
    <h2 class="text-center mb-4">Redes</h2>
    <form action="{{ url('/inventario') }}" method="POST">
        @csrf
        <style>
            @import url(https://fonts.googleapis.com/css?family=Merriweather:700);
            h6 {
                border-collapse: separate;
                border-spacing: 16px 0;
                border-spacing: 1rem 0;
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
        <input type="hidden" name="inventarioCategoria" value="Redes">
        <h6>Datos Generales</h6>
        <div class="row">
            <div class="col-3">
                <div class="form-group">
                    <label for="inventarioModelo" class="col-form-label">Modelo:</label>
                    <input type="text" name="inventarioModelo" id="inventarioModelo" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="inventarioMarca" class="col-form-label">Marca:</label>
                    <input type="text" name="inventarioMarca" id="inventarioMarca" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="inventarioSerie" class="col-form-label">No. Serie:</label>
                    <input type="text" name="inventarioSerie" id="inventarioSerie" class="form-control">
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    <label for="inventarioEstado" class="col-form-label">Estado:</label>
                    <select class="form-select" name="inventarioEstado" id="inventarioEstado">
                        <option value="Funcional">Funcional</option>
                        <option value="No Funcional">No Funcional</option>
                    </select>
                </div>
            </div>
        </div>
        <h6>Observaciones</h6>
        <div class="col-md-12">
            <textarea name="inventarioObservaciones" id="inventarioObservaciones" class="form-control" placeholder=""></textarea>
        </div>
        <div class="row justify-content-start text-center mt-5">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block" id="btnEnviar">
                    Registrar
                </button>
            </div>
        </div>
    </form>
</div>
@endsection