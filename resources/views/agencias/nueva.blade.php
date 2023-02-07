@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- <div class="alert alert-danger alert-dismissible fade show @if ($alert === '') {{ 'd-none' }}  @endif" role="alert">
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
            </div> --}}

            <div class="d-flex justify-content-end">
            </div>

            <div class="card">
                <div class="card-header">{{ __('Nueva agencia') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/agencias/nueva" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre:</label>
                            <input required placeholder="Nombre de la agencia" type="text" class="form-control" id="nombre" name="nombre">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="responsable">Responsable:</label>
                            <input required placeholder="Responsable de la agencia" type="text" class="form-control" id="responsable" name="responsable">
                        </div>

                        <input type="submit" class="btn btn-primary form-control" value="Crear">
                        
                    </form> 


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
