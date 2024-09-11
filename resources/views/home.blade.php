@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>

    <!-- Agregar menú con imágenes debajo del dashboard -->
    <div class="container py-5">
        <h2 class="text-center mb-4">Selecciona una opción</h2>
        <div class="row justify-content-center">
        
            <!-- Opción 1 -->
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="{{ url('/inventarioComputo') }}">
                        <img src="/images/ordenador.png" class="card-img-top" alt="Vista 1">
                    </a>
                </div>
            </div>

            <!-- Opción 2 -->
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="">
                        <img src="" class="card-img-top" alt="Vista 2">
                    </a>
                </div>
            </div>

            <!-- Opción 3 -->
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="">
                        <img src="" class="card-img-top" alt="Vista 3">
                    </a>
                </div>
            </div>

            <!-- Opción 4 -->
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="">
                        <img src="" class="card-img-top" alt="Vista 4">
                    </a>
                </div>
            </div>

            <!-- Opción 5 -->
            <div class="col-12 col-sm-6 col-md-4 mb-4">
                <div class="card h-100">
                    <a href="/vista5">
                        <img src="" class="card-img-top" alt="Vista 5">
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
