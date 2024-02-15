@extends('layouts.app')

@section('template_title')
    {{ $gasto->name ?? "{{ __('Show') Gasto" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Gasto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('Gasto.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $gasto->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo:</strong>
                            {{ $gasto->tipo }}
                        </div>
                        <div class="form-group">
                            <strong>Porcentajeiva:</strong>
                            {{ $gasto->porcentajeIva }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
