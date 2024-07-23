@extends('layouts.app')

@section('template_title')
    Insumo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('Insumo.index') }}">
                            <div class="row">
                                <div class="col-md-3">
                                    <input type="date" name="from_date" class="form-control" placeholder="Desde" value="{{ request('from_date') }}">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" name="to_date" class="form-control" placeholder="Hasta" value="{{ request('to_date') }}">
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" placeholder="Buscar... (Nombre, Tipo, Precio, Inventario, Fecha Precio)" value="{{ request('search') }}">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">Buscar</button>
                                        </span>
                                    </div>
                                </div>
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
                                        <th>Fecha</th>
                                        <th>Proovedor</th>
                                        <th>Factura N°</th>
                                        <th>Pedido</th>
                                        <th>Cliente</th>
                                        <th>Orden de compra</th>
                                        <th>Tipo de Obra</th>
                                        <th>Nombre</th>
                                        <th>Tipo de insumo</th>
                                        <th>Precio</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($insumos as $insumo)
                                        <tr>
                                            <td>{{ $insumo->formatted_month_year }}</td>
                                            <td>{{ $insumo->formatted_day_month_year }}</td>
                                            <td>{{ ($proovedores->firstWhere('id', $insumo->proovedor_id)->nombre) }}</td>
                                            <td>{{ $insumo->factura }}</td>
                                            <td>{{ ($ordenesDeCompra->firstWhere('id', $insumo->orden_de_compra_id)->numeroOrdenInterna) }}</td>
                                            <td>{{ ($clientes->firstWhere('id', ($ordenesDeCompra->firstWhere('id', $insumo->orden_de_compra_id)->cliente_id))->nombre) }}</td>
                                            <td>{{ ($ordenesDeCompra->firstWhere('id', $insumo->orden_de_compra_id)->numeroOrden) }}</td>
                                            <td>{{ ($ordenesDeCompra->firstWhere('id', $insumo->orden_de_compra_id)->descripcionTarea) }}</td>
                                            <td>{{ $insumo->nombre }}</td>
                                            <td>{{ $insumo->tipo }}</td>
                                            <td>{{ $insumo->precio }}</td>
                                            <td>
                                                <form action="{{ route('Insumo.destroy', $insumo->id) }}" method="POST">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalShow{{ $insumo->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEdit{{ $insumo->id }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modals -->
                                        <div class="modal fade text-left" id="ModalEdit{{ $insumo->id }}" tabindex="-1">
                                            <form id="editForm{{ $insumo->id }}" method="POST" action="{{ route('Insumo.update', $insumo->id) }}" role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            <div class="form-group">
                                                                {{ Form::label('fecha', 'Fecha') }}
                                                                {{ Form::date('fecha', $insumo->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                                                                {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('proovedor_id', 'Proveedor') }}
                                                                {{ Form::select('proovedor_id', $proovedores->pluck('nombre', 'id'), $insumo->proovedor_id, ['class' => 'form-control select2' . ($errors->has('proovedor_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar proveedor de insumo', 'data-allow-clear' => 'true']) }}
                                                                {!! $errors->first('proovedor_id', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('factura', 'Numero de factura') }}
                                                                {{ Form::text('factura', $insumo->factura, ['class' => 'form-control' . ($errors->has('factura') ? ' is-invalid' : ''), 'placeholder' => 'Numero de factura']) }}
                                                                {!! $errors->first('factura', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('nombre', 'Nombre de insumo') }}
                                                                {{ Form::text('nombre', $insumo->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                                                                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('tipo', 'Tipo de insumo') }}
                                                                {{ Form::text('tipo', $insumo->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
                                                                {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('precio', 'Precio') }}
                                                                {{ Form::text('precio', $insumo->precio, ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                                                                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                {{ Form::label('orden_de_compra_id', 'Orden de compra') }}
                                                                <select id="orden_de_compra_id" name="orden_de_compra_id" class="form-control select2" placeholder="Numero de orden interna">
                                                                    <option value="">Numero de orden interna</option>
                                                                    @foreach ($ordenesDeCompra as $orden)
                                                                        <option value="{{ $orden->id }}">
                                                                            Int: {{ $orden->numeroOrdenInterna }} | Ext: {{ $orden->numeroOrden }} | {{ $clientes->firstWhere('id', $orden->cliente_id)->nombre }} | {{ $orden->descripcionTarea }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                                {!! $errors->first('orden_de_compra_id', '<div class="invalid-feedback">:message</div>') !!}
                                                            </div>
                                                            <input type="hidden" name="id" value="{{ $insumo->id }}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">{{ __('Guardar Cambios') }}</button>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $insumo->id }}" tabindex="-1">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        {{ __('Mostrar') }} Insumo
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <strong>Mes:</strong>
                                                            {{ $insumo->formatted_month_year }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Fecha:</strong>
                                                            {{ $insumo->formatted_day_month_year }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Proovedor:</strong>
                                                            {{ ($proovedores->firstWhere('id', $insumo->proovedor_id)->nombre) }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Factura N°:</strong>
                                                            {{ $insumo->factura }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Pedido:</strong>
                                                            {{ ($ordenesDeCompra->firstWhere('id', $insumo->orden_de_compra_id)->numeroOrdenInterna) }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Cliente:</strong>
                                                            {{ ($clientes->firstWhere('id', ($ordenesDeCompra->firstWhere('id', $insumo->orden_de_compra_id)->cliente_id))->nombre) }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Orden:</strong>
                                                            {{ ($ordenesDeCompra->firstWhere('id', $insumo->orden_de_compra_id)->numeroOrden) }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Tarea:</strong>
                                                            {{ ($ordenesDeCompra->firstWhere('id', $insumo->orden_de_compra_id)->descripcionTarea) }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Nombre:</strong>
                                                            {{ $insumo->nombre }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Tipo:</strong>
                                                            {{ $insumo->tipo }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Precio:</strong>
                                                            {{ $insumo->precio }}
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
                {!! $insumos->links() !!}
            </div>
            <!-- Formulario de Crear Insumo -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">{{ __('Agregar insumo / gasto') }}</span>
                    </div>
                    <div class="card-body">
                        @include('insumo.form', ['insumo' => new \App\Models\Insumo()])
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
                        window.location.href = "{{ route('Insumo.index') }}"; // Redirect to the index after a successful edit
                    } else {
                        console.error('Form submission failed', data);
                    }
                }).catch(error => {
                    console.error('Form submission error:', error);
                });
            });
        }

        forms.forEach(form => {
            console.log('Attaching event listener to form:', form.id);
            attachEventListeners(form);
        });
    });
</script>
