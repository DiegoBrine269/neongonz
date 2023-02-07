@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="d-flex justify-content-end">
            </div>

            <div class="card">
                <div class="card-header">{{ __('Editar agencia') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/agencias/editar" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="nombre">Nombre:</label>
                            <input required placeholder="Nombre de la agencia" type="text" class="form-control" id="nombre" name="nombre" value="{{$agencia->nombre}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="responsable">Responsable:</label>
                            <input required placeholder="Responsable de la agencia" type="text" class="form-control" id="responsable" name="responsable" value="{{$agencia->responsable}}">
                        </div>

                        <input type="hidden" name="id" value="{{ $agencia->id }}">

                        <input type="submit" class="btn btn-primary form-control" value="Guardar cambios">
                        
                    </form> 


                </div>
            </div>
        </div>
    </div>
</div>

@endsection
