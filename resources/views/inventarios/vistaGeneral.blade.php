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
           
        </tbody>
    </table>
</div>

</body>
</html>



@endsection