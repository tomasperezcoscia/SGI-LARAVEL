@extends('layouts.app')

@section('template_title')
    {{ $ordenesDeCompra->name ?? "{{ __('Show') Ordenes De Compra" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Ordenes De Compra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('OrdenesDeCompra.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Numeroordeninterna:</strong>
                            {{ $ordenesDeCompra->numeroOrdenInterna }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $ordenesDeCompra->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>Numeroorden:</strong>
                            {{ $ordenesDeCompra->numeroOrden }}
                        </div>
                        <div class="form-group">
                            <strong>Descripciontarea:</strong>
                            {{ $ordenesDeCompra->descripcionTarea }}
                        </div>
                        <div class="form-group">
                            <strong>Cuit Cuil:</strong>
                            {{ $ordenesDeCompra->cuit_cuil }}
                        </div>
                        <div class="form-group">
                            <strong>Fechadeingreso:</strong>
                            {{ $ordenesDeCompra->fechaDeIngreso }}
                        </div>
                        <div class="form-group">
                            <strong>Caracter:</strong>
                            {{ $ordenesDeCompra->caracter }}
                        </div>
                        <div class="form-group">
                            <strong>Polizaart:</strong>
                            {{ $ordenesDeCompra->polizaArt }}
                        </div>
                        <div class="form-group">
                            <strong>Vencimientopolizaart:</strong>
                            {{ $ordenesDeCompra->vencimientoPolizaArt }}
                        </div>
                        <div class="form-group">
                            <strong>Polizadeaccper:</strong>
                            {{ $ordenesDeCompra->polizaDeAccPer }}
                        </div>
                        <div class="form-group">
                            <strong>Vencimientopolizadeaccper:</strong>
                            {{ $ordenesDeCompra->vencimientoPolizaDeAccPer }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
