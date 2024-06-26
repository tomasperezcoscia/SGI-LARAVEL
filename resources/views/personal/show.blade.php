@extends('layouts.app')

@section('template_title')
    {{ $personal->name ?? "{{ __('Show') Personal" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Personal</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Personal.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>N° de legajo:</strong>
                            {{ $personal->legajo }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre completo:</strong>
                            {{ $personal->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Salario por hora:</strong>
                            $ {{ $personal->salario_hora }}
                        </div>
                        <div class="form-group">
                            <strong>Estado de empleado:</strong>
                            {{ $personal->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de alta:</strong>
                            {{ $personal->fechaDeAlta }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de baja:</strong>
                            {{ $personal->fechaDeBaja }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
