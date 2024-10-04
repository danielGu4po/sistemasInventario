@extends('layouts.app')
@section('content')


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

    .form-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .form-column {
        flex: 1;
        margin-right: 10px;
    }

    .form-column:last-child {
        margin-right: 0;
    }

    .form-column textarea {
        width: 100%;
        height: 150px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>


<div class="container containerLarge justify-content-center">
    <div class="row justify-content-center">
        <div class="col-md-12 text-center">
            <div class="card px-0 ">
                <div id="msform">
                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li class="active" id="solicitante"><strong>Programar</strong></li>
                        <li id="vehiculo"><strong>Archivo Mtto</strong></li>
                        <li id="mantenimiento"><strong>Confirmar</strong></li>
                    </ul>
                    <br>
                    <!-- fieldsets -->
                    <fieldset>
                        <h6>Programar Mantenimiento</h6>
                        <form action="{{ route('mantenimiento.programar', $item->id) }}" method="POST" class="form">
                            @csrf
                            <div class="form-row">
                                <div class="form-column">
                                    <label for="mantenimientoFecha">Fecha del Mantenimiento:</label>
                                    <input type="date" class="form-control" id="mantenimientoFecha" name="mantenimientoFecha" required>
                                </div>
                                <div class="form-column">
                                    <label for="mantenimientoMtto">Tipo de Mantenimiento:</label>
                                    <select class="form-control" id="mantenimientoMtto" name="mantenimientoMtto" required>
                                        <option value="Correctivo">Correctivo</option>
                                        <option value="Preventivo">Preventivo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-column">
                                <label for="mantenimientoDetalles">Detalles del Mantenimiento:</label>
                                <textarea id="mantenimientoDetalles" name="mantenimientoDetalles"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success">Programar Mantenimiento</button>
                        </form>
                        <input type="button" name="next" class="next action-button" value="Siguiente" />
                    </fieldset>
                    <fieldset>
                        <h6>Subir Archivo de Mantenimiento y Guardar</h6>
                        <form action="{{ route('mantenimiento.uploadFile', $item->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="form-column">
                                    <label for="archivo">Subir archivo de Excel</label>
                                    <input type="file" class="form-control" id="archivo" name="archivo" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Subir Archivo y Guardar Mantenimiento</button>
                        </form>
                        <input type="button" name="next" class="next action-button" value="Siguiente" />
                        <input type="button" name="previous" class="previous action-button-previous" value="Atras" />
                    </fieldset>
                    <fieldset>
                        <h6>Confirmar Mantenimiento</h6>
                        <p>Revisa los detalles antes de guardar el mantenimiento.</p>
                        <div class="card-body">
                            @if($archivos->isNotEmpty())
                            <table class="table table-hover" id="inventarioTable">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo de Mantenimiento</th>
                                        <th>Archivo</th>
                                        <th>Encuesta</th>   
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($archivos as $archivo)
                                    <tr>
                                        <td>{{ $archivo->mantenimientoFecha }}</td>
                                        <td>{{ $archivo->mantenimientoMtto }}</td>
                                        <td><a href="{{ Storage::url($archivo->archivo_path) }}" target="_blank" class="btn btn-link">Ver archivo</a></td>
                                        <td> <a href="{{ route('encuesta.satisfaccion') }}" class="btn btn-info">Realizar Encuesta</a></td>

                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @else
                            <p class="text-muted">No hay archivos subidos.</p>
                            @endif
                        </div>
                        <a href="{{url('/mantenimientoComputo')}}" class="action-button" value="Guardar">Guardar</a>
                        <input type="button" name="previous" class="previous action-button-previous" value="Atras" />
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {

            var current_fs, next_fs, previous_fs; //fieldsets
            var opacity;
            var current = 1;
            var steps = $("fieldset").length;

            setProgressBar(current);

            $(".next").click(function() {

                current_fs = $(this).parent();
                next_fs = $(this).parent().next();

                //Add Class Active
                $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

                //show the next fieldset
                next_fs.show();
                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        next_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 500
                });
                setProgressBar(++current);
            });

            $(".previous").click(function() {

                current_fs = $(this).parent();
                previous_fs = $(this).parent().prev();

                //Remove class active
                $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

                //show the previous fieldset
                previous_fs.show();

                //hide the current fieldset with style
                current_fs.animate({
                    opacity: 0
                }, {
                    step: function(now) {
                        // for making fielset appear animation
                        opacity = 1 - now;

                        current_fs.css({
                            'display': 'none',
                            'position': 'relative'
                        });
                        previous_fs.css({
                            'opacity': opacity
                        });
                    },
                    duration: 500
                });
                setProgressBar(--current);
            });

            function setProgressBar(curStep) {
                var percent = parseFloat(100 / steps) * curStep;
                percent = percent.toFixed();
                $(".progress-bar")
                    .css("width", percent + "%")
            }

            $(".submit").click(function() {
                return false;
            })

        });
    </script>

</div>

<!-- Incluir DataTables y jQuery desde el CDN -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Inicializar DataTables
        $('#inventarioTable').DataTable({
            "paging": true,
            "lengthMenu": [5, 10, 25, 50, 100],
            "pageLength": 10,
            "ordering": true,
            "info": true,
            "searching": true,
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/Spanish.json" // Traducción al español
            }
        });
    });
</script>

@endsection