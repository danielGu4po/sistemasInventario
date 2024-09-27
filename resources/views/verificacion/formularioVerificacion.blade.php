@extends('layouts.app')

@section('content')

<body>
    <div class="container mt-3">
        <h2 class="text-center mb-4">Lista de verificación de funcionalidad a equipos de cómputo.</h2>

        <!-- Inicio del formulario -->
        <form id="verificacionForm" action="{{ route('verificacion.store') }}" method="POST">
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
            
                .form-check {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                }
                .form-check-label {
                    margin-right: 10px;
                }

            </style>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" id="token">
            <h6>Datos Generales</h6>
            <br>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="verificacionCodigo" class="form-label">Código</label>
                        <input type="text" class="form-control" id="verificacionCodigo" name="verificacionCodigo" placeholder="" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="verificacionModelo" class="form-label">Modelo</label>
                        <input type="text" class="form-control" id="verificacionModelo" name="verificacionModelo" placeholder="" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="verificacionNumEmpleado" class="form-label">Número de Empleado</label>
                        <input type="text" class="form-control" id="verificacionNumEmpleado" name="verificacionNumEmpleado" placeholder="" required>
                    </div>
                </div>
            </div>
     
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="verificacionSerie" class="form-label">Serie</label>
                        <input type="text" class="form-control" id="verificacionSerie" name="verificacionSerie" placeholder="" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="verificacionNomUsuario" class="form-label">Nombre del usuario</label>
                        <input type="tel" class="form-control" id="verificacionNomUsuario" name="verificacionNomUsuario" placeholder="" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="verificacionAreaDepartamento" class="col-form-label">Área/Departamento</label>
                        <input type="text" class="form-control" id="verificacionAreaDepartamento" name="verificacionAreaDepartamento" placeholder="" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="verificacionMarca" class="form-label">Marca</label>
                        <input type="text" class="form-control" id="verificacionMarca" name="verificacionMarca" placeholder="" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="verificacionAsignacion" class="form-label">Asignacion</label>
                        <input type="text" class="form-control" id="verificacionAsignacion" name="verificacionAsignacion" placeholder="" required>
                    </div>
                </div>
                <div class="col-4">
    <div class="form-group">
        <label for="verificacionFecha" class="form-label">Fecha</label>
        <input type="date" class="form-control" id="verificacionFecha" name="verificacionFecha" required>
    </div>
</div>

            </div>

<!-- Nuevas listas de checkboxes -->
<div class="row mt-4">
    <div class="col-6">
        <h6>Sistema lógico</h6>
        <br>
        <div class="form-group">
            <div class="form-check">
                <input type="hidden" name="verificacionConcepto1" value="0">
                <label class="form-check-label" for="verificacionConcepto1">1. Respaldo de información.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto1" name="verificacionConcepto1">
                
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto2">2. Clave de acceso para iniciar sesión en el equipo.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto2" name="verificacionConcepto2">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto3">3. Actualización de software de aplicación.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto3" name="verificacionConcepto3">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto4">4. Actualización de sistema operativo (Windows).</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto4" name="verificacionConcepto4">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto5">5.Respaldo de Correos.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto5" name="verificacionConcepto5">
            </div>
        </div>
    </div>

    <div class="col-6">
        <h6>Equipo/herramientas</h6>
        <br>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto20">20.Destornilladores.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto20" name="verificacionConcepto20">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto21">21.Limpiador de pantalla.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto21" name="verificacionConcepto21">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto22">22.Alcohol Isopropilico.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto22" name="verificacionConcepto22">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto23">23.Pinzas de punta fina.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto23" name="verificacionConcepto23">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto24">24.Paños de microfibra.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto24" name="verificacionConcepto24">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto25">25.Hisopos.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto25" name="verificacionConcepto25">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto26">26.Aire comprimido.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto26" name="verificacionConcepto26">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto27">27.Linterna.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto27" name="verificacionConcepto27">
            </div>
        </div>
    </div>

    <div class="col-6">
        <h6>Sistema logístico e identificación</h6>
        <br>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto6">6. Contraseña del equipo.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto6" name="verificacionConcepto6">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto7">7. Número de serie.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto7" name="verificacionConcepto7">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto8">8. Etiqueta de identificación.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto8" name="verificacionConcepto8">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto9">9. Acceso a red Wi-fi.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto9" name="verificacionConcepto9">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto10">10.Acceso en cuenta Outlook.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto10" name="verificacionConcepto10">
            </div>
        </div>
    </div>

    <div class="col-6">
        <h6>Sistema interno</h6>
        <br>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto28">28.Procesador.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto28" name="verificacionConcepto28">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto29">29.Tarjeta madre.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto29" name="verificacionConcepto29">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto30">30.Memoria RAM.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto30" name="verificacionConcepto30">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto31">31.Memoria ROM.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto31" name="verificacionConcepto31">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto32">32.Disco duro.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto32" name="verificacionConcepto32">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto33">33.Tarjeta gráfica.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto33" name="verificacionConcepto33">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto34">34.Tarjeta de sonido.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto34" name="verificacionConcepto34">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto35">35.Bus.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto35" name="verificacionConcepto35">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto36">36.Disipador de calor.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto36" name="verificacionConcepto36">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto37">37.Tarjeta de red.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto37" name="verificacionConcepto37">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto38">38.Memoria caché.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto38" name="verificacionConcepto38">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto39">39.Fuente de poder.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto39" name="verificacionConcepto39">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto40">40.Unidad óptica.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto40" name="verificacionConcepto40">
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-6">
        <h6>Puertos de entrada.</h6>
        <br>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto11">11.Puerto de entrada USB.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto11" name="verificacionConcepto11">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto12">12.Puerto HDMI.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto12" name="verificacionConcepto12">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto13">13.Puerto VGA.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto13" name="verificacionConcepto13">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto14">14.Conexión a corriente.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto14" name="verificacionConcepto14">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto15">15.Lector CD.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto15" name="verificacionConcepto15">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto16">16.Puerto SD.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto16" name="verificacionConcepto16">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto17">17.Puerto de audio.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto17" name="verificacionConcepto17">
            </div>
        </div>
    </div>

    <div class="col-6">
        <h6>Monitor.</h6>
        <br>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto41">41.Limpieza.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto41" name="verificacionConcepto41">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto42">42.Tinta de la pantalla.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto42" name="verificacionConcepto42">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto43">43.Cámara.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto43" name="verificacionConcepto43">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto44">44.Rayones en la superficie de la pantalla.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto44" name="verificacionConcepto44">
            </div>
        </div>
    </div>

    <div class="col-6">
        <h6>Equipo de Protección Personal (EPP).</h6>
        <br>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto18">18.Guantes de látex.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto18" name="verificacionConcepto18">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto19">19.Pulsera antiestática.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto19" name="verificacionConcepto19">
            </div>
            
        </div>
    </div>

    <div class="col-6">
        <h6>Teclado y panel táctil/touchpad</h6>
        <br>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto45">45.Limpieza del panel táctil/TouchPad.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto45" name="verificacionConcepto45">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto46">46.Limpieza de teclado.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto46" name="verificacionConcepto46">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto47">47.Funcionalidad en el panel táctil/TouchPad.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto47" name="verificacionConcepto47">
            </div>
            <div class="form-check">
                <label class="form-check-label" for="verificacionConcepto48">48.Funcionalidad de botones en el teclado.</label>
                <input class="form-check-input" type="checkbox" value="1" id="verificacionConcepto48" name="verificacionConcepto48">
            </div>
        </div>
    </div>
</div>

<h6>Observaciones</h6>
<br>
<div class="row">
    <div class="col-6">
        <div class="form-group">
            <label for="verificacionConceptoObservacion" class="form-label">Concepto</label>
            <textarea class="form-control" id="verificacionConceptoObservacion" name="verificacionConceptoObservacion" rows="1" placeholder="" required></textarea>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="verificacionAccion" class="form-label">Acción correctiva </label>
            <textarea class="form-control" id="verificacionAccion" name="verificacionAccion" rows="1" placeholder="" required></textarea>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="verificacionResponsable" class="form-label">Responsable</label>
            <textarea class="form-control" id="verificacionResponsable" name="verificacionResponsable" rows="1" placeholder="" required></textarea>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <label for="verificacionFechaCumplimiento" class="form-label">Fecha de cumplimiento</label>
            <input type="date" class="form-control" id="verificacionFechaCumplimiento" name="verificacionFechaCumplimiento" required>
        </div>
    </div>
</div>

            <button type="submit" class="btn btn-success">Aceptar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @endsection