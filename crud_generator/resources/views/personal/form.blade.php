<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('legajo', 'N° de legajo') }}
            {{ Form::text('legajo', $personal->legajo, ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Numero segun el legajo']) }}
            {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre', 'Nombre completo') }}
            {{ Form::text('nombre', $personal->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre completo del empleado']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('salario_hora', 'Salario por hora') }}
            {{ Form::text('salario_hora', $personal->salario_hora, ['class' => 'form-control' . ($errors->has('salario_hora') ? ' is-invalid' : ''), 'placeholder' => 'Salario en pesos por hora']) }}
            {!! $errors->first('salario_hora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado', 'Estado de empleado') }}
            {{ Form::text('estado', $personal->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'A: Blanco / B: Negro']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaDeAlta', 'Fecha de alta') }}
            {{ Form::text('fechaDeAlta', $personal->fechaDeAlta, ['class' => 'form-control datepicker' . ($errors->has('fechaDeAlta') ? ' is-invalid' : ''), 'placeholder' => 'AAAA-MM-DD']) }}
            {!! $errors->first('fechaDeAlta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaDeBaja', 'Fecha de baja') }}
            {{ Form::text('fechaDeBaja', $personal->fechaDeBaja, ['class' => 'form-control datepicker' . ($errors->has('fechaDeBaja') ? ' is-invalid' : ''), 'placeholder' => 'AAAA-MM-DD']) }}
            {!! $errors->first('fechaDeBaja', '<div class="invalid-feedback">:message</div>') !!}
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