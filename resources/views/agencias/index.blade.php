@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @switch($alert)
                @case('0')
                    <div class="alert alert-danger alert-dismissible fade show @if ($alert === '') {{ 'd-none' }}  @endif" role="alert">
                        <strong>Error.</strong> No ha sido posible registrar la agencia.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                        @break
                    @case('1')                    
                        <div class="alert alert-success alert-dismissible fade show @if ($alert === '') {{ 'd-none' }}  @endif" role="alert">
                            Agencia registrada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @break

                    @case('2')                    
                        <div class="alert alert-info alert-dismissible fade show @if ($alert === '') {{ 'd-none' }}  @endif" role="alert">
                            Agencia actualizada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @break

                    @case('3')                    
                        <div class="alert alert-danger alert-dismissible fade show @if ($alert === '') {{ 'd-none' }}  @endif" role="alert">
                            Agencia eliminada.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @break
                @endswitch

            <div class="d-flex justify-content-end">
                <a href="/agencias/nueva" class="btn btn-success mb-3">Agregar nueva agencia</a>
            </div>

            <div class="card">
                <div class="card-header">{{ __('Lista de agencias') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No. de agencia</th>
                                <th scope="col" class="text-center">Nombre</th>
                                <th scope="col" class="text-center">Responsable</th>
                                <th scope="col" class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($agencias as $agencia)
                                <tr>
                                    <td class="text-center">{{ $agencia->id }}</td>
                                    <td class="text-center">{{ $agencia->nombre }}</td>
                                    <td class="text-center">{{ $agencia->responsable }}</td>
                                    <td class="text-center">
                                        <a title="Editar" class="fa-solid fa-pencil text-primary text-decoration-none" href="/agencias/editar?id={{$agencia->id}}"></a>
                                        <a title="Eliminar" class="fa-solid fa-trash-can text-danger text-decoration-none" onclick="return confirm('¿Seguro que desea eliminar la agencia? Se eliminará toda la información relacionada a esta.')" href="/agencias/eliminar?id={{$agencia->id}}"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
