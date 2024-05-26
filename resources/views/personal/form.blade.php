<div class="box box-info padding-1">
    <form id="personalForm" method="POST" action="{{ isset($personal->id) ? route('Personal.update', $personal->id) : route('Personal.store') }}">
        @csrf
        @if(isset($personal->id))
            {{ method_field('PATCH') }}
        @endif
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('legajo', 'N° de legajo') }}
                {{ Form::text('legajo', $personal->legajo ?? '', ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Numero segun el legajo']) }}
                {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('nombre', 'Nombre completo') }}
                {{ Form::text('nombre', $personal->nombre ?? '', ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre completo del empleado']) }}
                {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('salario_hora', 'Salario por hora') }}
                {{ Form::text('salario_hora', $personal->salario_hora ?? '', ['class' => 'form-control' . ($errors->has('salario_hora') ? ' is-invalid' : ''), 'placeholder' => 'Salario en pesos por hora']) }}
                {!! $errors->first('salario_hora', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('estado', 'Estado de empleado') }}
                {{ Form::text('estado', $personal->estado ?? '', ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'A: Blanco / B: Negro']) }}
                {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('personalForm');

        function initializeForm() {
            console.log('Initializing form');
            form.reset();
        }

        function attachEventListeners() {
            if (!window.eventListenersAttached) {
                window.eventListenersAttached = true;

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
                            window.location.href = "{{ route('Personal.index') }}";
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
