<div class="box box-info padding-1">
    <form id="createCargaSocialForm" method="POST" action="{{ route('CargasSociales.store') }}">
        @csrf
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('fecha', 'fecha') }}
                {{ Form::date('fecha', $cargasSociales->fecha ?? '', ['class' => 'form-control', 'placeholder' => 'Fecha Impuestos']) }}
            </div>
            <div class="form-group">
                {{ Form::label('f931', 'F931') }}
                {{ Form::text('f931', $cargasSociales->f931 ?? '', ['class' => 'form-control', 'placeholder' => 'Impuesto F931']) }}
            </div>
            <div class="form-group">
                {{ Form::label('uocra', 'UOCRA') }}
                {{ Form::text('uocra', $cargasSociales->uocra ?? '', ['class' => 'form-control', 'placeholder' => 'Impuesto UOCRA']) }}
            </div>
            <div class="form-group">
                {{ Form::label('intereses', 'Intereses') }}
                {{ Form::text('intereses', $cargasSociales->intereses ?? '', ['class' => 'form-control', 'placeholder' => 'Impuesto Intereses']) }}
            </div>
            <div class="form-group">
                {{ Form::label('ieric', 'IERIC') }}
                {{ Form::text('ieric', $cargasSociales->ieric ?? '', ['class' => 'form-control', 'placeholder' => 'Impuesto IERIC']) }}
            </div>
            <div class="form-group">
                {{ Form::label('fondoDesempleo', 'Fondo Desempleo') }}
                {{ Form::text('fondoDesempleo', $cargasSociales->fondoDesempleo ?? '', ['class' => 'form-control', 'placeholder' => 'Impuesto Fondo Desempleo']) }}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createForm = document.getElementById('createCargaSocialForm');

        function initializeCreateForm() {
            createForm.reset();
        }

        function attachCreateEventListeners() {
            createForm.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission

                const formData = new FormData(createForm);

                fetch(createForm.action, {
                    method: createForm.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    return response.json();
                }).then(data => {
                    if (data.success) {
                        initializeCreateForm(); // Reset form after successful submission
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
        

        initializeCreateForm();
        attachCreateEventListeners();
    });
</script>
