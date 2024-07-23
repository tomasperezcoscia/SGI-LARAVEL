<div class="box box-info padding-1">
    <form id="energiaForm" method="POST" action="{{ route('Energia.store') }}">
        @csrf
        <div class="box-body">

            <div class="form-group">
                {{ Form::label('fecha', 'Fecha') }}
                {{ Form::date('fecha', $energia->fecha ?? '', ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                {!! $errors->first('fecha', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('precio', 'Precio') }}
                {{ Form::number('precio', $energia->precio ?? '', ['class' => 'form-control' . ($errors->has('precio') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
                {!! $errors->first('precio', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('energiaForm');
    
        function initializeForm() {
            console.log('Initializing form');
            form.reset();
            form.querySelectorAll('.form-control').forEach(input => input.value = '');
        }
    
        function attachEventListeners() {
            if (!window.eventListenersAttached) {
                window.eventListenersAttached = true;
    
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
                        if (response.ok) {
                            return response.json();
                        } else {
                            throw new Error('Network response was not ok');
                        }
                    }).then(data => {
                        if (data.success) {
                            console.log('Form submission successful');
                            initializeForm(); // Reset form after successful submission
                            window.location.href = "{{ route('Energia.index') }}";
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
