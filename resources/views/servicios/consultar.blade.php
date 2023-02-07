@extends('layouts.app')

@php
    $date = date_create($servicio->fecha);
@endphp


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- Código de alerta
                0 - El económico es de otra agencia
                1 - La longitud del económico no es de 5 dígitos
            --}}
            
                <div class="alert alert-danger alert-dismissible fade show @if ($alert === '') {{ 'd-none' }}  @endif" role="alert">
                    @switch($alert)
                        @case('0')
                            <strong>Error.</strong> El económico ha sido registrado para otra agencia.
                            @break
                        @case('1')
                            <strong>Error.</strong> Por favor, ingresa un económico de 5 dígitos.
                            @break
                        @case('2')
                            <strong>Error.</strong> Ya ha ingresado el económico en este servicio.
                            @break
                        @default
                    @endswitch
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            

            <div class="card">
                <div class="card-header">{{ __($servicio->nombre . ' | ' . $servicio->concepto  . ' | ' . date_format($date, 'd/m/Y')) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/servicios/servicio" method="POST" >
                        @csrf
                        <div class="mb-3">
                            <div class="mb-3">
                                <label for="economico" class="form-label" required>Económico</label>
                                <input required autofocus type="number" class="form-control" name="economico" id="economico" placeholder="00000">
                            </div>

                            <input type="hidden" name="idServicio" value="{{ $servicio->id }}">
                            <input type="hidden" name="idAgencia" value="{{ $servicio->idAgencia }}">


                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary form-control" value="Agregar">
                            </div>
                    </form>

                    
                    <h5>Lista de económicos</h5>
                    <ul class="list-group">
                        @foreach ($economicos as $economico)
                            <li class="list-group-item">{{ $economico->economico }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>



    </div>
</div>

@endsection
