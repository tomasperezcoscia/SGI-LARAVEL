<div class="box box-info padding-1">
    <form id="horasPersonalForm" method="POST" action="{{ route('HorasPersonal.store') }}">
        @csrf
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('personal_id', 'Personal') }}
                {{ Form::select('personal_id', $personals->pluck('nombre', 'id'), null, ['class' => 'form-control select2', 'placeholder' => 'Personal', 'id' => 'personal_id']) }}
                {!! $errors->first('personal_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('orden_de_compra_id', 'Orden de compra') }}
                <select id="orden_de_compra_id" name="orden_de_compra_id" class="form-control select2" placeholder="Numero de orden interna">
                    <option value="">Numero de orden interna</option>
                    @foreach ($ordenesDeCompras as $orden)
                        <option value="{{ $orden->id }}">
                            Int: {{ $orden->numeroOrdenInterna }} | Ext: {{ $orden->numeroOrden }} | {{ $clientes->firstWhere('id', $orden->cliente_id)->nombre }} | {{ $orden->descripcionTarea }}
                        </option>
                    @endforeach
                </select>
                {!! $errors->first('orden_de_compra_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('cant_horas', 'Cantidad de horas') }}
                <input type="number" id="cant_horas" name="cant_horas" class="form-control" placeholder="Cantidad de horas (e.g., 3.5)" step="0.5" min="0">
                {!! $errors->first('cant_horas', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('horasPersonalForm');

    function initializeForm() {
        console.log('Initializing form');
        form.reset();

        $('#personal_id').val(null).trigger('change');
        $('#orden_de_compra_id').val(null).trigger('change');
    }

    function attachEventListeners() {
        if (!window.eventListenersAttached) {
            window.eventListenersAttached = true;

            $('#orden_de_compra_id').select2();

            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                console.log('Form submitted');

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
                    console.log(response);
                    return response.json();
                }).then(data => {
                    if (data.success) {
                        console.log('Form submission successful');
                        initializeForm(); // Reset form after successful submission
                        window.location.href = "{{ route('HorasPersonal.index') }}";
                    } else {
                        console.error('Form submission failed', data);
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
