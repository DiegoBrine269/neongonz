@extends('layouts.app')


@section('content')
<div class="table-container">
    <table id="tableServicios" class="display" >
        <thead>
            <tr>
                <th class="text-center">Agencia</th>
                <th class="text-center">Concepto</th>
                <th class="text-center">Fecha</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($servicios as $servicio)
                <tr data-id="{{$servicio->id}}">
                    <td class="text-center">{{ $servicio->nombre }}</td>
                    <td class="text-center">{{ $servicio->concepto }}</td>
                    <td class="text-center">{{ date("d/m/Y", strtotime($servicio->fecha)) }}</td>
                    <th class="text-center">
                        {{-- <a title="Ver" class="fa-solid fa-eye text-primary text-decoration-none" href="/servicios/servicio?id={{$servicio->id}}"></a> --}}
                        <a title="Eliminar" class="fa-solid fa-trash-can text-danger text-decoration-none" href="/servicios/eliminar?id={{$servicio->id}}" onclick="return confirm('¿Seguro que desea eliminar el registro?')"></a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script src="/js/servicios.js"></script>
@endsection
