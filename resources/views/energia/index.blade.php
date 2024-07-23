@extends('layouts.app')

@section('template_title')
    Energia
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('Energia.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Buscar... (Fecha, Factura Nro, Precio)"
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
                                        <th>Fecha</th>
                                        <th>Precio</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Energias as $energia)
                                        <tr>
                                            <td>{{ $energia->fecha }}</td>
                                            <td>$ {{ $energia->precio }}</td>
                                            <td>
                                                <form action="{{ route('Energia.destroy', $energia->id) }}"
                                                    method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $energia->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $energia->id }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modals -->
                                        <div class="modal fade text-left" id="ModalEdit{{ $energia->id }}" tabindex="-1">
                                            <form id="editForm{{ $energia->id }}" method="POST" action="{{ route('Energia.update', $energia->id) }}" role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            <div class="form-group">
                                                                {{ Form::label('fecha', 'Fecha') }}
                                                                {{ Form::date('fecha', $energia->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                                                {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('precio', 'Precio') }}
                                                                {{ Form::number('precio', $energia->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                                                                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
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
                                        <div class="modal fade text-left" id="ModalShow{{ $energia->id }}"
                                            tabindex="-1">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal header, body, and footer -->
                                                    <div class="modal-header">
                                                        @section('template_title')
                                                            {{ __('Mostrar') }} Energia
                                                        @endsection
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <strong>Fecha:</strong>
                                                            {{ $energia->fecha }}
                                                        </div>

                                                        <div class="form-group">
                                                            <strong>Precio:</strong>
                                                            {{ $energia->precio }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('Cerrar') }}</button>
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
                {!! $Energias->links() !!}
            </div>
            <!-- Formulario de Crear Energia -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">
                            {{ __('Agregar Energia') }}
                        </span>
                    </div>
                    <div class="card-body">
                        @include('Energia.form')
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
                                window.location.href = "{{ route('Energia.index') }}";
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