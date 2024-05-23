@extends('layouts.app')

@section('template_title')
    Proovedore
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('Proovedore.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Buscar... (Nro de legajo, Nombre, Telefono, Tipo)"
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
                                        <th>Nro de legajo</th>
                                        <th>Nombre</th>
                                        <th>Telefono</th>
                                        <th>Tipo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proovedores as $proovedore)
                                        <tr>
                                            <td>{{ $proovedore->legajo }}</td>
                                            <td>{{ $proovedore->nombre }}</td>
                                            <td>{{ $proovedore->numeroDeTelefono }}</td>
                                            <td>{{ $proovedore->tipo }}</td>
                                            <td>
                                                <form action="{{ route('Proovedore.destroy', $proovedore->id) }}"
                                                    method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $proovedore->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $proovedore->id }}">
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
                                        <div class="modal fade text-left" id="ModalEdit{{ $proovedore->id }}" tabindex="-1">
                                            <form id="editForm{{ $proovedore->id }}" method="POST" action="{{ route('Proovedore.update', $proovedore->id) }}" role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            <div class="form-group">
                                                                {{ Form::label('legajo', 'N° de legajo') }}
                                                                {{ Form::text('legajo', $proovedore->legajo, ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Numero de legajo']) }}
                                                                {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('nombre', 'Nombre de proovedor') }}
                                                                {{ Form::text('nombre', $proovedore->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del proovedor: Cementos Avellanera']) }}
                                                                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('numeroDeTelefono', 'Numero de contacto') }}
                                                                {{ Form::text('numeroDeTelefono', $proovedore->numeroDeTelefono, ['class' => 'form-control' . ($errors->has('numeroDeTelefono') ? ' is-invalid' : ''), 'placeholder' => 'Numero de telefono']) }}
                                                                {!! $errors->first('numeroDeTelefono', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('tipo', 'Tipo de proovedor') }}
                                                                {{ Form::text('tipo', $proovedore->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Cementera/Calera/Metalurgica/etc.']) }}
                                                                {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $proovedore->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">{{ __('Guardar Cambios') }}</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>                                        
                                        <div class="modal fade text-left" id="ModalShow{{ $proovedore->id }}"
                                            tabindex="-1">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal header, body, and footer -->
                                                    <div class="modal-header">
                                                        @section('template_title')
                                                            {{ __('Mostrar') }} Proovedore
                                                        @endsection
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <strong>Nro de legajo:</strong>
                                                            {{ $proovedore->legajo }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Nombre de proovedor:</strong>
                                                            {{ $proovedore->nombre }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Numero de telefono:</strong>
                                                            {{ $proovedore->numeroDeTelefono }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Tipo de proveedor:</strong>
                                                            {{ $proovedore->tipo }}
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
                {!! $proovedores->links() !!}
            </div>
            <!-- Formulario de Crear Proovedore -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">
                            {{ __('Agregar Proovedor') }}
                        </span>
                    </div>
                    <div class="card-body">
                        @include('proovedore.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('form[id^="editForm"]');

        function attachEventListeners(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                console.log(`Form submitted ${form.id}`);

                const formData = new FormData(form);

                for (const [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    console.log('Response received:', response); // Verificar la respuesta antes de parsear JSON
                    return response.json();
                }).then(data => {
                    console.log('Parsed JSON data:', data); // Log the parsed JSON data
                    if (data.success) {
                        console.log('Form submission successful');
                        window.location.href = "{{ route('Proovedore.index') }}"; // Redirect to the index after a successful edit
                    } else {
                        console.error('Form submission failed', data);
                    }
                }).catch(error => {
                    console.error('Form submission error:', error);
                });
            });
        }

        forms.forEach(form => {
            console.log('Estoy entrando al fori')
            
            attachEventListeners(form);
        });
    });
</script>
