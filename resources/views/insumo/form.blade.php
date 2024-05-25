<div class="box box-info padding-1">
    <form id="insumoForm" method="POST" action="{{ route('Insumo.store') }}">
        @csrf
        <div class="box-body">
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
                {{ Form::label('inventario', 'Inventario') }}
                {{ Form::text('inventario', $insumo->inventario, ['class' => 'form-control' . ($errors->has('inventario') ? ' is-invalid' : ''), 'placeholder' => 'Inventario']) }}
                {!! $errors->first('inventario', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('proovedor_id', 'Proveedor de insumo') }}
                {{ Form::select('proovedor_id', $proovedores->pluck('nombre', 'id'), $insumo->proovedor_id, ['class' => 'form-control select2' . ($errors->has('proovedor_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar proveedor de insumo', 'data-allow-clear' => 'true']) }}
                {!! $errors->first('proovedor_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="box-footer mt20">
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('insumoForm');

    function initializeForm() {
        console.log('Initializing form');
        form.reset();
        $('#proovedor_id').val(null).trigger('change');
    }

    function attachEventListeners() {
        if (!window.eventListenersAttached) {
            window.eventListenersAttached = true;

            $('#proovedor_id').select2();

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
                        console.log('Form submission successful');
                        initializeForm(); // Reset form after successful submission
                        window.location.href = "{{ route('Insumo.index') }}";
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
    }

    initializeForm();
    attachEventListeners();
});
</script>
