@extends('layouts.app')

@section('template_title')
    {{ __('Agregar') }} Horas Personal
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Agregar') }} Horas Personal</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('HorasPersonal.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('horas-personal.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
