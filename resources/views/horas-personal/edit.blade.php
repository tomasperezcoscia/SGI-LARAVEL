@extends('layouts.app')

@section('template_title')
    {{ __('Update') }} Horas Personal
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Update') }} Horas Personal</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('HorasPersonal.update', $horasPersonal->id) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('horas-personal.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
