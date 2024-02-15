<div class="box box-info padding-1">
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <!-- Add any additional buttons or functionality you want in the modal footer -->
    </div>
</div>

<script>
    $(function() {
        // Initialize datepickers
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd', // Change the date format as needed
            // You can add more options here
        });
    });
</script>