@extends('layouts.app')


@section('content')
@php
    $month = date('m');
    $day = date('d');
    $year = date('Y');
    $today = $year . '-' . $month . '-' . $day;
@endphp
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">{{ __('Nuevo servicio') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/servicios/nuevo" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nombreAgencia" class="form-label">Agencia:</label>
                            <select class="form-control" name="idAgencia" id="nombreAgencia" required>
                                <option value="" disabled selected>Seleccione una agencia</option>
                                @foreach ($agencias as $agencia) 
                                    <option value="{{ $agencia->id }}">{{ $agencia->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="concepto" class="form-label">Concepto</label>
                            <input type="text" class="form-control" id="concepto" name="concepto" placeholder="Instalación de cámara para reversa" required>
                        </div>

                        <div class="mb-3">
                            <label for="tipo" class="form-label">Tipo</label>
                            <select class="form-control" name="tipo" id="tipo" required>
                                <option value="-" disabled selected>Seleccione un tipo de servicio</option>
                                <option value="rotulacion">Rotulación</option>
                                <option value="electrico">Eléctrico</option>
                                <option value="lavado">Lavado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="costoUnitario" class="form-label" required>Costo unitario</label>
                            <input type="number" class="form-control" name="costoUnitario" id="costoUnitario" placeholder="0.00">
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="form-label" required>Fecha</label>
                            <input type="date" class="form-control" value="{{ $today }}" name="fecha" id="fecha">
                        </div>

                        
                        <input type="submit" class="btn btn-primary form-control" value="Crear">
                        
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
