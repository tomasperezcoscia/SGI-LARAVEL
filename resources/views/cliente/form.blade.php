<div class="box box-info padding-1">
    <form id="createClienteForm" method="POST" action="{{ route('Cliente.store') }}">
        @csrf
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('legajo', 'N° de legajo') }}
                {{ Form::text('legajo', '', ['class' => 'form-control', 'placeholder' => 'Nro de legajo']) }}
            </div>
            <div class="form-group">
                {{ Form::label('nombre', 'Nombre cliente') }}
                {{ Form::text('nombre', '', ['class' => 'form-control', 'placeholder' => 'Nombre de cliente']) }}
            </div>
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo de cliente') }}
                {{ Form::text('tipo', '', ['class' => 'form-control', 'placeholder' => 'Tipo de cliente']) }}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const createForm = document.getElementById('createClienteForm');

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

        initializeCreateForm();
        attachCreateEventListeners();
    });
</script>
