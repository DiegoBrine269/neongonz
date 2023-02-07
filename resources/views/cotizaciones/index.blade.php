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
                <div class="card-header">{{ __('Generar cotización') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Ingresa los datos para generar la cotización</p>
                    <form action="" method="POST">
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
                            <label for="fecha" class="form-label" required>Del día</label>
                            <input type="date" class="form-control" value="{{ $today }}" name="fecha1" id="fecha1">
                        </div>

                        <div class="mb-3">
                            <label for="fecha" class="form-label" required>Al día</label>
                            <input type="date" class="form-control" value="{{ $today }}" name="fecha2" id="fecha2">
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
                            <input type="submit" class="btn btn-primary form-control" value="Generar">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
