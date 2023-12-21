@extends('layouts.app')

@section('template_title')
    {{ $horasPersonal->name ?? "{{ __('Show') Horas Personal" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Horas Personal</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('horas-personals.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Fechadecarga:</strong>
                            {{ $horasPersonal->fechaDeCarga }}
                        </div>
                        <div class="form-group">
                            <strong>Cliente Id:</strong>
                            {{ $horasPersonal->cliente_id }}
                        </div>
                        <div class="form-group">
                            <strong>Personal Id:</strong>
                            {{ $horasPersonal->personal_id }}
                        </div>
                        <div class="form-group">
                            <strong>Orden De Compra Id:</strong>
                            {{ $horasPersonal->orden_de_compra_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tarea Id:</strong>
                            {{ $horasPersonal->tarea_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
