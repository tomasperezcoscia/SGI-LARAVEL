<div class="box box-info padding-1">
    <form id="createAusenciasPersonalForm" method="POST" action="{{ route('AusenciasPersonal.store') }}">
        @csrf
        <div class="box-body">
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo de ausencia') }}
                {{ Form::text('tipo', $ausenciasPersonal->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Vacaciones, enfermedad, falta']) }}
                {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('descripcion', 'Descripción de ausencia') }}
                {{ Form::text('descripcion', $ausenciasPersonal->descripcion, ['class' => 'form-control' . ($errors->has('descripcion') ? ' is-invalid' : ''), 'placeholder' => 'Presenta licencia']) }}
                {!! $errors->first('descripcion', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('fechaDeInicio', 'Fecha de inicio de ausencia') }}
                {{ Form::text('fechaDeInicio', $ausenciasPersonal->fechaDeInicio, ['class' => 'form-control datepicker' . ($errors->has('fechaDeInicio') ? ' is-invalid' : ''), 'placeholder' => 'Fecha de inicio de ausencia']) }}
                {!! $errors->first('fechaDeInicio', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('fechaDeFin', 'Fecha fin de ausencia') }}
                {{ Form::text('fechaDeFin', $ausenciasPersonal->fechaDeFin, ['class' => 'form-control datepicker' . ($errors->has('fechaDeFin') ? ' is-invalid' : ''), 'placeholder' => 'Fecha fin de ausencia']) }}
                {!! $errors->first('fechaDeFin', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group">
                {{ Form::label('personal_id', 'Personal ausente') }}
                {{ Form::select('personal_id', $personals->pluck('nombre', 'id'), $ausenciasPersonal->personal_id, ['class' => 'form-control select2' . ($errors->has('personal_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar personal ausente', 'data-allow-clear' => 'true']) }}
                {!! $errors->first('personal_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
        </div>
        <div class="modal-footer">
            <!-- Footer content -->
            <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
            <!-- Add any additional buttons or functionality you want in the modal footer -->
        </div>
    </form>
</div>

<script>
    

    document.addEventListener('DOMContentLoaded', function() {
        const createForm = document.getElementById('createAusenciasPersonalForm');

        function initializeCreateForm() {
            createForm.reset();
            $('#personal_id').val(null).trigger('change');
        }

        function attachCreateEventListeners() {
            if (!window.createEventListenersAttached) {
                window.createEventListenersAttached = true;

                $('#personal_id').select2();

                createForm.addEventListener('submit', function(event) {
                    event.preventDefault();

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
                            initializeCreateForm();
                            window.location.href = "{{ route('AusenciasPersonal.index') }}";
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
        }

        initializeCreateForm();
        attachCreateEventListeners();
        $(function() {
        // Initialize datepickers
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(dateText) {
                $(this).val(dateText);
            }
        });
    });
    });

    $(function() {
        // Initialize datepickers
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(dateText) {
                $(this).val(dateText);
            }
        });
    });
</script>
