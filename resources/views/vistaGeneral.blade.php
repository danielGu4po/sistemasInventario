@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container mt-4">
    <!-- Tabla Computo -->
    <h3>Computo</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Número de Serie</th>
                <th>RAM</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($computo as $item)
                <tr>
                    <td>{{ $item->marca }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->num_serie }}</td>
                    <td>{{ $item->ram }}</td>
                    <td>{{ $item->observaciones }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabla Miscellaneo -->
    <h3>Miscellaneo</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Número de Serie</th>
                <th>Funcional</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($miscellaneo as $item)
                <tr>
                    <td>{{ $item->marca }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->num_serie }}</td>
                    <td>{{ $item->funcional ? 'Sí' : 'No' }}</td>
                    <td>{{ $item->observaciones }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabla Telefonía -->
    <h3>Telefonía</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Número de Serie</th>
                <th>Número Teléfono</th>
                <th>Funcional</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($telefonia as $item)
                <tr>
                    <td>{{ $item->marca }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->num_serie }}</td>
                    <td>{{ $item->num_telefono }}</td>
                    <td>{{ $item->funcional ? 'Sí' : 'No' }}</td>
                    <td>{{ $item->observaciones }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tabla Redes -->
    <h3>Redes</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Número de Serie</th>
                <th>Funcional</th>
                <th>Observaciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($redes as $item)
                <tr>
                    <td>{{ $item->marca }}</td>
                    <td>{{ $item->modelo }}</td>
                    <td>{{ $item->num_serie }}</td>
                    <td>{{ $item->funcional ? 'Sí' : 'No' }}</td>
                    <td>{{ $item->observaciones }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>



@endsection