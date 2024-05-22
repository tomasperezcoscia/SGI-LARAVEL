<div class="box box-info padding-1">
    <form id="horasPersonalForm" method="POST" action="{{ route('HorasPersonal.store') }}">
        @csrf
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('cliente_id', 'Cliente') }}
                {{ Form::select('cliente_id', $clientes->pluck('nombre', 'id'), $horasPersonal->cliente_id ?? '', ['class' => 'form-control select2', 'placeholder' => 'Cliente', 'id' => 'cliente_id']) }}
                {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('personal_id', 'Personal') }}
                {{ Form::select('personal_id', $personals->pluck('nombre', 'id'), $horasPersonal->personal_id ?? '', ['class' => 'form-control select2', 'placeholder' => 'Personal', 'id' => 'personal_id']) }}
                {!! $errors->first('personal_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('orden_de_compra_id', 'Orden de compra') }}
                {{ Form::select('orden_de_compra_id', $ordenesDeCompras->map(function ($item) use ($clientes) {
                    $cliente = $clientes->where('id', $item['cliente_id'])->first();
                    return ['id' => $item['id'], 'text' => 'Int: ' . $item['numeroOrdenInterna'] . ' | Ext: ' . $item['numeroOrden'] . ' | ' . $cliente['nombre'] . ' | ' . $item['descripcionTarea']];
                })->pluck('text', 'id'), $horasPersonal->orden_de_compra_id ?? '', ['class' => 'form-control select2', 'placeholder' => 'Numero de orden interna', 'id' => 'orden_de_compra_id']) }}
                {!! $errors->first('orden_de_compra_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('cant_horas_display', 'Cantidad de horas') }}
                <input type="text" id="cant_horas_display" class="form-control" placeholder="Cantidad de horas (e.g., 0:30)" readonly>
                {{ Form::hidden('cant_horas', $horasPersonal->cant_horas ?? '', ['id' => 'cant_horas']) }}
                {!! $errors->first('cant_horas', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <input type="range" id="cant_horas_range" min="0" max="24" step="0.5" value="{{ $horasPersonal->cant_horas ?? '0' }}" class="form-control">
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('horasPersonalForm');
    const rangeInput = document.getElementById('cant_horas_range');
    const displayInput = document.getElementById('cant_horas_display');
    const hiddenInput = document.getElementById('cant_horas');

    function updateDisplay() {
        const value = parseFloat(rangeInput.value);
        const hours = Math.floor(value);
        const minutes = (value - hours) * 60;
        displayInput.value = `${hours}:${minutes === 0 ? '00' : minutes}`;
        hiddenInput.value = value;
    }

    rangeInput.addEventListener('input', updateDisplay);
    updateDisplay(); // Initial display update

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Submit the form via AJAX
        fetch(form.action, {
            method: form.method,
            body: new FormData(form),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }).then(response => response.json()).then(data => {
            if (data.success) {
                // Form submitted successfully, reload the page to update the index
                window.location.href = "{{ route('HorasPersonal.index') }}";
            } else {
                // Handle submission error
                console.error('Form submission failed');
            }
        }).catch(error => {
            console.error('Form submission error:', error);
        });
    });
});
</script>
