@extends('layouts.app')

@section('template_title')
    Cliente
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('Cliente.index') }}">
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
                                        <th>N° de legajo</th>
                                        <th>Nombre cliente</th>
                                        <th>Tipo de cliente</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            <td>{{ $cliente->legajo }}</td>
                                            <td>{{ $cliente->nombre }}</td>
                                            <td>{{ $cliente->tipo }}</td>
                                            <td>
                                                <form action="{{ route('Cliente.destroy', $cliente->id) }}" method="POST">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalShow{{ $cliente->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEdit{{ $cliente->id }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modals -->
                                        <div class="modal fade text-left" id="ModalEdit{{ $cliente->id }}" tabindex="-1">
                                            <form id="editForm{{ $cliente->id }}" method="POST" action="{{ route('Cliente.update', $cliente->id) }}" role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                {{ Form::label('legajo', 'N° de legajo') }}
                                                                {{ Form::text('legajo', $cliente->legajo, ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Nro de legajo']) }}
                                                                {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('nombre', 'Nombre cliente') }}
                                                                {{ Form::text('nombre', $cliente->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre de cliente']) }}
                                                                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('tipo', 'Tipo de cliente') }}
                                                                {{ Form::text('tipo', $cliente->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo de cliente']) }}
                                                                {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
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
                                        <div class="modal fade text-left" id="ModalShow{{ $cliente->id }}" tabindex="-1">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        {{ __('Mostrar') }} Cliente
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <strong>Nro de legajo:</strong>
                                                            {{ $cliente->legajo }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Nombre cliente:</strong>
                                                            {{ $cliente->nombre }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Tipo de cliente:</strong>
                                                            {{ $cliente->tipo }}
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
                {!! $clientes->links() !!}
            </div>
            <!-- Formulario de Crear Cliente -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">{{ __('Agregar Cliente') }}</span>
                    </div>
                    <div class="card-body">
                        @include('cliente.form', ['cliente' => new \App\Models\Cliente()])
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
                                window.location.href = "{{ route('Cliente.index') }}";
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
