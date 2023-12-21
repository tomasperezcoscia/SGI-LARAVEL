@extends('layouts.app')

@section('template_title')
    {{ $proovedore->name ?? "{{ __('Show') Proovedore" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Proovedore</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Proovedore.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Legajo:</strong>
                            {{ $proovedore->legajo }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $proovedore->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Numerodetelefono:</strong>
                            {{ $proovedore->numeroDeTelefono }}
                        </div>
                        <div class="form-group">
                            <strong>Cuil:</strong>
                            {{ $proovedore->cuil }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $proovedore->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Fechaalta:</strong>
                            {{ $proovedore->fechaAlta }}
                        </div>
                        <div class="form-group">
                            <strong>Fechabaja:</strong>
                            {{ $proovedore->fechaBaja }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
