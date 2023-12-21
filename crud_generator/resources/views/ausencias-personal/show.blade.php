@extends('layouts.app')

@section('template_title')
    {{ $ausenciasPersonal->name ?? "{{ __('Show') Ausencias Personal" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Ausencias Personal</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('AusenciasPersonal.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $ausenciasPersonal->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion:</strong>
                            {{ $ausenciasPersonal->descripcion }}
                        </div>
                        <div class="form-group">
                            <strong>Fechadeinicio:</strong>
                            {{ $ausenciasPersonal->fechaDeInicio }}
                        </div>
                        <div class="form-group">
                            <strong>Fechadefin:</strong>
                            {{ $ausenciasPersonal->fechaDeFin }}
                        </div>
                        <div class="form-group">
                            <strong>Personal Id:</strong>
                            {{ $ausenciasPersonal->personal_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
