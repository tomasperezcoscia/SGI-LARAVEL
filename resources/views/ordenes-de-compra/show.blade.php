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
                            <strong>Numero de orden interna:</strong>
                            {{ $ordenesDeCompra->numeroOrdenInterna }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente:</strong>
                            {{ $ordenesDeCompra->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>Numero de orden:</strong>
                            {{ $ordenesDeCompra->numeroOrden }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion de tarea:</strong>
                            {{ $ordenesDeCompra->descripcionTarea }}
                        </div>
                        <div class="form-group">
                            <strong>Valor tarea:</strong>
                            {{ $ordenesDeCompra->valorTarea }}
                        </div>
                        <div class="form-group">
                            <strong>Iva:</strong>
                            {{ $ordenesDeCompra->valorTarea * 0.21 }}
                        </div>
                        <div class="form-group">
                            <strong>Valor tarea con iva:</strong>
                            {{ $ordenesDeCompra->valorTarea * 1.21}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
