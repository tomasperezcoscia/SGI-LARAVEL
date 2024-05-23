<div class="box box-info padding-1">
    <form id="proovedoreForm" method="POST" action="{{ route('Proovedore.store') }}">
        @csrf
        <div class="box-body">

            <div class="form-group">
                {{ Form::label('legajo', 'N° de legajo') }}
                {{ Form::text('legajo', $proovedore->legajo ?? '', ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Numero de legajo']) }}
                {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('nombre', 'Nombre de proovedor') }}
                {{ Form::text('nombre', $proovedore->nombre ?? '', ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del proovedor: Cementos Avellanera']) }}
                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('numeroDeTelefono', 'Numero de contacto') }}
                {{ Form::text('numeroDeTelefono', $proovedore->numeroDeTelefono ?? '', ['class' => 'form-control' . ($errors->has('numeroDeTelefono') ? ' is-invalid' : ''), 'placeholder' => 'Numero de telefono']) }}
                {!! $errors->first('numeroDeTelefono', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo de proovedor') }}
                {{ Form::text('tipo', $proovedore->tipo ?? '', ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Cementera/Calera/Metalurgica/etc.']) }}
                {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
            </div>

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
        </div>
    </form>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('proovedoreForm');
    
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
                            window.location.href = "{{ route('Proovedore.index') }}";
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
    
    
    
