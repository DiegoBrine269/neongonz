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

                    <p>Selecione una opción para empezar</p>

                    <a href="/servicios/nuevo" class="btn text-decoration-none d-block text-center p-3 bg-primary text-white mb-3">Nuevo servicio</a>
                    <a href="/servicios" class="btn text-decoration-none d-block text-center p-3 bg-secondary text-white mb-3">Historial de servicios</a>
                    <a href="/agencias" class="btn text-decoration-none d-block text-center p-3 bg-secondary text-white mb-3">Lista de agencias</a>
                    <a href="/cotizaciones/generar" class="btn text-decoration-none d-block text-center p-3 bg-secondary text-white mb-3">Generar cotización</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
