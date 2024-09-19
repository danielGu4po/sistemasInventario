<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento Combinado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .page {
            page-break-after: always;
            padding: 20px;
        }
        .page:last-of-type {
            page-break-after: auto;
        }
        .header {
            text-align: right;
        }
        .title {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .instructions {
            margin-bottom: 20px;
        }
        .data-section {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #515a5a;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
        }
        h3 {
            text-align: center;
        }
        .content {
            margin: 0 40px;
        }
        .content h2 {
            text-align: center;
            text-transform: uppercase;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .content p {
            font-size: 12px;
            line-height: 1.6;
        }
        .content ul {
            font-size: 12px;
            margin-left: 20px;
        }
        .signatures {
            margin-top: 40px;
            width: 100%;
            text-align: center;
        }
        .signatures-table {
            width: 100%;
            margin-top: 60px;
            border-collapse: collapse;
        }
        .signatures-table, .signatures-table td {
            border: none; /* Elimina todos los bordes de la tabla y las celdas */
        }
        .signatures-table td {
            width: 33%;
            text-align: center;
            font-size: 12px;
            vertical-align: bottom;
        }
        .signature-line {
            margin-top: 50px;
            border-top: 1px solid black;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        .role {
            font-size: 11px;
        }
    </style>
</head>
<body>

    <!-- Página 1: Carta Responsiva -->
    <div class="page">
        <div class="header">
            <img src="img/topo-logo.png" alt="Logo" style="height: 30px; float: left;">
        </div>
        <br>

        <div class="title">
            CARTA RESPONSIVA
        </div>

        <div class="header">
            Fecha de aplicación: {{ now()->format('d/m/Y') }}
        </div>  

        <br>
        <div class="instructions">
            <p>Instrucciones: Favor de llenar el documento con la información física o plasmada en el equipo; además de completar con las firmas de cada departamento correspondiente.</p>
            <p>Acepto como usuario la responsabilidad sobre el equipo que se describe en esta carta y se denominará ACTIVO, el cual me fue asignado por Servicios y Equipos Topo, S.A.de C.V., también denominado la EMPRESA.</p>
            <p>La empresa da un comodato a EL USUARIO quien recibe el carácter de EL ACTIVO; descrito al rubro del presente y se obliga con LA EMPRESA a restituirla cuando esta así lo solicite, en las mismas condiciones que lo recibió, salvo el deterioro normal por el uso de este desde su entrega.</p>
        </div>

        <div class="data-section">
            <h3>Datos del solicitante:</h3>
            <table>
                <tr>
                    <th>Nombre del Usuario:</th>
                    <td>{{ $asignacion->asignarUsuario }}</td>
                </tr>
                <tr>
                    <th>No. De Empleado</th>
                    <td>{{ $asignacion->asignarNoEmpleado }}</td>
                </tr>
                <tr>
                    <th>Puesto:</th>
                    <td>{{ $asignacion->asignarPuesto }}</td>
                </tr>
                <tr>
                    <th>Departamento:</th>
                    <td>{{ $asignacion->asignarDepartamento }}</td>
                </tr>
            </table>
        </div>

        <div class="data-section">
            <h3>Datos del equipo:</h3>
            <table>
                <tr>
                    <th>Artículo</th>
                    <th>Marca y modelo</th>
                    <th>Características</th>
                    <th>No. de serie</th>
                    <th>Observaciones</th>
                </tr>
                <tr>
                    <td>{{ $asignacion->asignarEquipoNombre }}</td>
                    <td>{{ $asignacion->inventario->inventarioMarca }} / {{ $asignacion->inventario->inventarioModelo }}</td>
                    <td>{{ $asignacion->inventario->inventarioAlmacenamiento }} / {{ $asignacion->inventario->inventarioRAM }}</td>
                    <td>{{ $asignacion->inventario->inventarioSerie }}</td>
                    <td>{{ $asignacion->inventario->inventarioObservaciones }}</td>
                </tr>
            </table>
        </div>

        <div class="data-section">
            <h3>Datos del equipo de cómputo:</h3>
            <table>
                <tr>
                    <th>Nombre del equipo:</th>
                    <td>{{ $asignacion->asignarEquipoNombre }}</td>
                </tr>
                <tr>
                    <th>Usuario de Windows:</th>
                    <td>{{ $asignacion->asignarUsuarioNombre }}</td>
                </tr>
                <tr>
                    <th>Contraseña del equipo:</th>
                    <td>{{ $asignacion->inventario->inventarioContraseña }}</td>
                </tr>
                <tr>
                    <th>Correo electrónico asignado:</th>
                    <td>{{ $asignacion->asignarEquipoCorreo }}</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Página 2: Obligaciones del Usuario -->
    <div class="header">
            <img src="img/topo-logo.png" alt="Logo" style="height: 30px; float: left;">
        </div>
    <div class="page">
        <div class="content">
            <h2>Obligaciones del usuario</h2>
            <p>El usuario se compromete en este acto con la empresa a:</p>
            <ul>
                <li>Verificar número de serie, modelo y marca del equipo asignado.</li>
                <li>En caso de robo o extravío se deberá avisar a su jefe inmediato y/o Gerente de Administración de la Compañía.</li>
                <li>Cada percance será consignado como una falta grave; el costo por la renovación o pieza del equipo podrá cobrarse al usuario especialmente si este introduce el equipo de cómputo en espacios consignados donde haya <b>humedad, polvo en exceso, agua, etc.</b></li>
                <li>El usuario está consciente de que el equipo asignado es propiedad de la Empresa y solo de la Empresa y el uso de hardware y software es únicamente para los fines de esta.</li>
                <li>El mal uso del activo se considerará como una falta grave y el usuario será acreedor a una sanción.</li>
                <li>La empresa puede revisar la política, reasignar o quitar los activos sin previo aviso al usuario en cualquier momento.</li>
                <li>El empleado no podrá modificar los usuarios y claves asignadas sin previo aviso y autorización, una vez terminada la relación laboral se compromete a entregar claves de acceso a los dispositivos asignados.</li>
                <li>El empleado no podrá instalar ningún tipo de software ajeno al que requiera para realizar las funciones acordes a su puesto.</li>
            </ul>
        </div>

        <div class="signatures">
            <table class="signatures-table">
                <tr>
                    <td>
                        <div class="signature-line"></div>
                        Entrega:<br>
                        I.S.C. Luis Daniel G. Garcia Herrera<br>
                        <span class="role">Generalista de Tecnologías de la Información</span>
                    </td>
                    <td>
                        <div class="signature-line"></div>
                        Recibe:<br>
                        {{$asignacion->asignarUsuario}}<br>
                        <span class="role">{{$asignacion->asignarPuesto}}</span>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="signature-line"></div>
                        Autoriza:<br>
                        L.C. Emerson Eduardo Andrade Quiñones<br>
                        <span class="role">Encargado de Contabilidad</span>
                    </td>
                    <td>
                        <div class="signature-line"></div>
                        Autoriza:<br>
                        Lic. María Victoria Graciano Domínguez<br>
                        <span class="role">Encargada de RH</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>
