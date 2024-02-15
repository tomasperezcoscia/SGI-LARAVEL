@extends('layouts.app')

@section('template_title')
    {{ $insumosParaObra->name ?? "{{ __('Show') Insumos Para Obra" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Insumos Para Obra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('insumos-para-obras.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Insumo:</strong>
                            {{ $insumosParaObra->id_insumo }}
                        </div>
                        <div class="form-group">
                            <strong>Id Obra:</strong>
                            {{ $insumosParaObra->id_obra }}
                        </div>
                        <div class="form-group">
                            <strong>Cantidad:</strong>
                            {{ $insumosParaObra->cantidad }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
