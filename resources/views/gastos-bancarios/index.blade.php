@extends('layouts.app')

@section('template_title')
    Gastos Bancarios
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('GastosBancarios.index') }}">
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
                                    @foreach ($GastosBancarios as $GastoBancario)
                                        <tr>
                                            <td>{{ $GastoBancario->fecha }}</td>
                                            <td>$ {{ $GastoBancario->precio }}</td>
                                            <td>
                                                <form action="{{ route('GastosBancarios.destroy', $GastoBancario->id) }}"
                                                    method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $GastoBancario->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $GastoBancario->id }}">
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
                                        <div class="modal fade text-left" id="ModalEdit{{ $GastoBancario->id }}" tabindex="-1">
                                            <form id="editForm{{ $GastoBancario->id }}" method="POST" action="{{ route('GastosBancarios.update', $GastoBancario->id) }}" role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            <div class="form-group">
                                                                {{ Form::label('fecha', 'Fecha') }}
                                                                {{ Form::date('fecha', $GastoBancario->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                                                {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('precio', 'Precio') }}
                                                                {{ Form::number('precio', $GastoBancario->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                                                                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $GastoBancario->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">{{ __('Guardar Cambios') }}</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>                                        
                                        <div class="modal fade text-left" id="ModalShow{{ $GastoBancario->id }}"
                                            tabindex="-1">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <!-- Modal header, body, and footer -->
                                                    <div class="modal-header">
                                                        @section('template_title')
                                                            {{ __('Mostrar') }} Gasto Bancario
                                                        @endsection
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <strong>Fecha:</strong>
                                                            {{ $GastoBancario->fecha }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Precio:</strong>
                                                            {{ $GastoBancario->precio }}
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
                {!! $GastosBancarios->links() !!}
            </div>
            <!-- Formulario de Crear Gasto bancario -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">
                            {{ __('Agregar Gasto bancario') }}
                        </span>
                    </div>
                    <div class="card-body">
                        @include('gastos-bancarios.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                            window.location.href = "{{ route('GastosBancarios.index') }}"; // Redirect to the index after a successful edit
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
@endsection

