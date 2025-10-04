@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Cotizaciones</h1>
    <a href="{{ route('cotizaciones.create') }}" class="btn btn-primary mb-3">Nueva Cotización</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cliente</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Estatus</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cotizaciones as $cotizacion)
                <tr>
                    <td>{{ $cotizacion->id }}</td>
                    <td>{{ $cotizacion->cliente->nombre ?? 'Sin cliente' }}</td>
                    <td>{{ $cotizacion->fecha }}</td>
                    <td>${{ number_format($cotizacion->total, 2) }}</td>
                    <td>{{ ucfirst($cotizacion->estatus) }}</td>
                    <td>
                        <a href="{{ route('cotizaciones.show', $cotizacion->id) }}" class="btn btn-info btn-sm">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
