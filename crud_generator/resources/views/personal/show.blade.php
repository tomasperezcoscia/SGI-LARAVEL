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
                            <strong>Legajo:</strong>
                            {{ $personal->legajo }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $personal->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Salario Hora:</strong>
                            {{ $personal->salario_hora }}
                        </div>
                        <div class="form-group">
                            <strong>Estado:</strong>
                            {{ $personal->estado }}
                        </div>
                        <div class="form-group">
                            <strong>Fechadealta:</strong>
                            {{ $personal->fechaDeAlta }}
                        </div>
                        <div class="form-group">
                            <strong>Fechadebaja:</strong>
                            {{ $personal->fechaDeBaja }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
