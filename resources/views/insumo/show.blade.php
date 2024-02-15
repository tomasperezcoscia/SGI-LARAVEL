@extends('layouts.app')

@section('template_title')
    {{ $insumo->name ?? "{{ __('Show') Insumo" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Insumo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Insumo.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $insumo->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $insumo->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $insumo->precio }}
                        </div>
                        <div class="form-group">
                            <strong>Inventario:</strong>
                            {{ $insumo->inventario }}
                        </div>
                        <div class="form-group">
                            <strong>Ultimafechaprecio:</strong>
                            {{ $insumo->ultimaFechaPrecio }}
                        </div>
                        <div class="form-group">
                            <strong>Proovedor Id:</strong>
                            {{ $insumo->proovedor_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
