@extends('layouts.app')

@section('template_title')
    Cargas Sociales
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('CargasSociales.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Buscar... (Nro de legajo, Nombre, Tipo)"
                                    value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Mes</th>
                                        <th>Impuesto F931</th>
                                        <th>Impuesto UOCRA</th>
                                        <th>Impuesto Intereses</th>
                                        <th>Impuesto IERIC</th>
                                        <th>Impuesto Fondo desempleo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cargasSociales as $cargaSocial)
                                        <tr>
                                            <td>{{ $cargaSocial->fecha }}</td>
                                            <td>{{ $cargaSocial->f931 }}</td>
                                            <td>{{ $cargaSocial->uocra }}</td>
                                            <td>{{ $cargaSocial->intereses }}</td>
                                            <td>{{ $cargaSocial->ieric }}</td>
                                            <td>{{ $cargaSocial->fondoDesempleo }}</td>
                                            <td>
                                                <form action="{{ route('CargasSociales.destroy', $cargaSocial->id) }}" method="POST">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalShow{{ $cargaSocial->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEdit{{ $cargaSocial->id }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modals -->
                                        <div class="modal fade text-left" id="ModalEdit{{ $cargaSocial->id }}" tabindex="-1">
                                            <form id="editForm{{ $cargaSocial->id }}" method="POST" action="{{ route('CargasSociales.update', $cargaSocial->id) }}" role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="box-body">
                                                                <div class="form-group">
                                                                    {{ Form::label('fecha', 'fecha') }}
                                                                    {{ Form::date('fecha', '', ['class' => 'form-control', 'placeholder' => 'Fecha Impuestos']) }}
                                                                </div>
                                                                <div class="form-group">
                                                                    {{ Form::label('f931', 'F931') }}
                                                                    {{ Form::number('f931', '', ['class' => 'form-control', 'placeholder' => 'Impuesto F931', 'step' => '0.01']) }}
                                                                </div>
                                                                <div class="form-group">
                                                                    {{ Form::label('uocra', 'UOCRA') }}
                                                                    {{ Form::number('uocra', '', ['class' => 'form-control', 'placeholder' => 'Impuesto UOCRA', 'step' => '0.01']) }}
                                                                </div>
                                                                <div class="form-group">
                                                                    {{ Form::label('intereses', 'Intereses') }}
                                                                    {{ Form::number('intereses', '', ['class' => 'form-control', 'placeholder' => 'Impuesto Intereses', 'step' => '0.01']) }}
                                                                </div>
                                                                <div class="form-group">
                                                                    {{ Form::label('ieric', 'IERIC') }}
                                                                    {{ Form::number('ieric', '', ['class' => 'form-control', 'placeholder' => 'Impuesto IERIC', 'step' => '0.01']) }}
                                                                </div>
                                                                <div class="form-group">
                                                                    {{ Form::label('fondoDesempleo', 'Fondo Desempleo') }}
                                                                    {{ Form::number('fondoDesempleo', '', ['class' => 'form-control', 'placeholder' => 'Impuesto Fondo Desempleo', 'step' => '0.01']) }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">{{ __('Guardar Cambios') }}</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $cargaSocial->id }}" tabindex="-1">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        {{ __('Mostrar') }} Cargas Sociales
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <strong>Impuesto F931:</strong>
                                                            {{ $cargaSocial->f931 }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Impuesto UOCRA:</strong>
                                                            {{ $cargaSocial->uocra }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Impuesto Intereses:</strong>
                                                            {{ $cargaSocial->intereses }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Impuesto IERIC:</strong>
                                                            {{ $cargaSocial->ieric }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Impuesto Fondo Desempleo:</strong>
                                                            {{ $cargaSocial->fondoDesempleo }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $cargasSociales->links() !!}
            </div>
            <!-- Formulario de Crear Cargas Sociales -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">{{ __('Agregar Cargas Sociales') }}</span>
                    </div>
                    <div class="card-body">
                        @include('cargas-sociales.form', ['cargasSociales' => new \App\Models\CargasSociales()])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editForms = document.querySelectorAll('form[id^="editForm"]');

        function attachEditEventListeners() {
            editForms.forEach(form => {
                if (!form.editEventListenerAttached) {
                    form.editEventListenerAttached = true;

                    form.addEventListener('submit', function(event) {
                        event.preventDefault(); // Prevent the default form submission

                        const formData = new FormData(form);

                        fetch(form.action, {
                            method: form.method,
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        }).then(response => {
                            return response.json();
                        }).then(data => {
                            if (data.success) {
                                window.location.href = "{{ route('CargasSociales.index') }}";
                            } else {
                                if (data.errors) {
                                    console.error('Validation errors', data.errors);
                                } else {
                                    console.error('Form submission failed', data);
                                }
                            }
                        }).catch(error => {
                            console.error('Form submission error:', error);
                        });
                    });
                }
            });
        }

        attachEditEventListeners();
    });
</script>
