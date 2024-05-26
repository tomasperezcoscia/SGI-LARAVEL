@extends('layouts.app')

@section('template_title')
    Ordenes De Compra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('OrdenesDeCompra.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Buscar... (Nro de orden interna, Cliente, Nro de orden, Tarea)"
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
                                        <th>Nro orden interna</th>
                                        <th>Cliente</th>
                                        <th>Nro orden</th>
                                        <th>Tarea</th>
                                        <th>Valor de la tarea</th>
                                        <th>Iva</th>
                                        <th>Valor de la tarea C/iva</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenesDeCompras as $ordenesDeCompra)
                                        <tr>
                                            <td>{{ $ordenesDeCompra->numeroOrdenInterna }}</td>
                                            <td>{{ $clientes->firstWhere('id', $ordenesDeCompra->cliente_id)->nombre }}</td>
                                            <td>{{ $ordenesDeCompra->numeroOrden }}</td>
                                            <td>{{ $ordenesDeCompra->descripcionTarea }}</td>
                                            <td>{{ $ordenesDeCompra->valorTarea }}</td>
                                            <td>{{ $ordenesDeCompra->valorTarea * 0.21 }}</td>
                                            <td>{{ $ordenesDeCompra->valorTarea * 1.21 }}</td>
                                            <td>
                                                <form action="{{ route('OrdenesDeCompra.destroy', $ordenesDeCompra->id) }}" method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalShow{{ $ordenesDeCompra->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEdit{{ $ordenesDeCompra->id }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modals -->
                                        <div class="modal fade text-left" id="ModalEdit{{ $ordenesDeCompra->id }}" tabindex="-1">
                                            <form id="editForm{{ $ordenesDeCompra->id }}" method="POST" action="{{ route('OrdenesDeCompra.update', $ordenesDeCompra->id) }}" role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                {{ Form::label('numeroOrdenInterna', 'Numero de orden interna') }}
                                                                {{ Form::text('numeroOrdenInterna', $ordenesDeCompra->numeroOrdenInterna ?? '', ['class' => 'form-control' . ($errors->has('numeroOrdenInterna') ? ' is-invalid' : ''), 'placeholder' => 'Numero de orden interna']) }}
                                                                {!! $errors->first('numeroOrdenInterna', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('cliente_id', 'Cliente') }}
                                                                {{ Form::select('cliente_id', $clientes->pluck('nombre', 'id'), $ordenesDeCompra->cliente_id ?? '', ['class' => 'form-control select2' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar cliente', 'data-allow-clear' => 'true', 'id' => 'edit_cliente_id_select_' . $ordenesDeCompra->id]) }}
                                                                {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('numeroOrden', 'Numero de orden') }}
                                                                {{ Form::text('numeroOrden', $ordenesDeCompra->numeroOrden ?? '', ['class' => 'form-control' . ($errors->has('numeroOrden') ? ' is-invalid' : ''), 'placeholder' => 'Numero de orden']) }}
                                                                {!! $errors->first('numeroOrden', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('descripcionTarea', 'Descripcion tarea') }}
                                                                {{ Form::text('descripcionTarea', $ordenesDeCompra->descripcionTarea ?? '', ['class' => 'form-control' . ($errors->has('descripcionTarea') ? ' is-invalid' : ''), 'placeholder' => 'Breve descripcion de tarea']) }}
                                                                {!! $errors->first('descripcionTarea', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('valorTarea', 'Valor de la tarea, sin iva agregado') }}
                                                                {{ Form::text('valorTarea', $ordenesDeCompra->valorTarea ?? '', ['class' => 'form-control' . ($errors->has('valorTarea') ? ' is-invalid' : ''), 'placeholder' => 'Valor sin iva']) }}
                                                                {!! $errors->first('valorTarea', '<div class="invalid-feedback">:message</div>') !!}
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
                                        <div class="modal fade text-left" id="ModalShow{{ $ordenesDeCompra->id }}" tabindex="-1">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        {{ __('Mostrar') }} Orden de compra
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <strong>Numero de orden interna:</strong>
                                                            {{ $ordenesDeCompra->numeroOrdenInterna }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Cliente:</strong>
                                                            {{ $clientes->firstWhere('id', $ordenesDeCompra->cliente_id)->nombre }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Numero de orden:</strong>
                                                            {{ $ordenesDeCompra->numeroOrden }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Descripcion de tarea:</strong>
                                                            {{ $ordenesDeCompra->descripcionTarea }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Valor tarea:</strong>
                                                            {{ $ordenesDeCompra->valorTarea }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Iva:</strong>
                                                            {{ $ordenesDeCompra->valorTarea * 0.21 }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Valor tarea con iva:</strong>
                                                            {{ $ordenesDeCompra->valorTarea * 1.21}}
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
                {!! $ordenesDeCompras->links() !!}
            </div>
            <!-- Formulario de Crear OrdenesDeCompra -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">{{ __('Agregar Orden de Compra') }}</span>
                    </div>
                    <div class="card-body">
                        @include('ordenes-de-compra.form', ['ordenesDeCompra' => new \App\Models\OrdenesDeCompra()])
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
                        window.location.href = "{{ route('OrdenesDeCompra.index') }}";
                    } else {
                        if (data.errors) {
                            console.error('Validation errors', data.errors);
                            // Display validation errors to the user
                        } else {
                            console.error('Form submission failed', data);
                        }
                    }
                }).catch(error => {
                    console.error('Form submission error:', error);
                });
            });
        }

        forms.forEach(form => {
            attachEventListeners(form);
        });

        // Initialize Select2 for edit forms
        forms.forEach(form => {
            const select = form.querySelector('.select2');
            if (select) {
                $(select).select2();
            }
        });
    });
</script>
