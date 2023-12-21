@extends('layouts.app')

@section('template_title')
    {{ $obra->name ?? "{{ __('Show') Obra" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Obra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Obra.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $obra->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Legajo:</strong>
                            {{ $obra->legajo }}
                        </div>
                        <div class="form-group">
                            <strong>Id Cliente:</strong>
                            {{ $obra->id_cliente }}
                        </div>
                        <div class="form-group">
                            <strong>Id Insumosparaobra:</strong>
                            {{ $obra->id_insumosParaObra }}
                        </div>
                        <div class="form-group">
                            <strong>Id Horasdepersonal:</strong>
                            {{ $obra->id_horasDePersonal }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
