@extends('layouts.app')

@section('template_title')
    Mostrar Presupuesto
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Mostrar Presupuesto') }}</div>
                    <div class="card-body">
                        <div class="form-group">
                            <strong>Cliente:</strong>
                            {{ optional($presupuesto->ordenDeCompra->cliente)->nombre ?? 'N/A' }}
                        </div>
                        <div class="form-group">
                            <strong>Nro Orden:</strong>
                            {{ optional($presupuesto->ordenDeCompra)->numeroOrdenInterna ?? 'N/A' }}
                        </div>
                        <div class="form-group">
                            <strong>Tarea:</strong>
                            {{ optional($presupuesto->ordenDeCompra)->descripcionTarea ?? 'N/A' }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ ucwords(str_replace('_', ' ', $presupuesto->estado)) }}
                        </div>
                        <div class="form-group">
                            <strong>Número de Legajo:</strong>
                            {{ $presupuesto->numero_legajo }}
                        </div>
                        <div class="form-group">
                            <strong>Obra Asociada:</strong>
                            {{ $presupuesto->obra ? 'Asignada' : 'No asignada' }}
                        </div>
                        <div class="form-group">
                            <strong>Insumos Presupuestados:</strong>
                            <ul>
                                @foreach ($presupuesto->insumos as $insumo)
                                    <li>
                                        {{ $insumo->nombre }} - Cantidad: {{ $insumo->pivot->cantidad }} - Precio: ${{ number_format($insumo->precio, 2) }} - Total: ${{ number_format($insumo->pivot->cantidad * $insumo->precio, 2) }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="form-group">
                            <strong>Total del Presupuesto:</strong> ${{ number_format($totalPresupuesto, 2) }}
                        </div>
                        <a href="{{ route('presupuestos.index') }}" class="btn btn-primary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
