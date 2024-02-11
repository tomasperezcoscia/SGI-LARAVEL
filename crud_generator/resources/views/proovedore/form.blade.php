<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('legajo', 'N° de legajo') }}
            {{ Form::text('legajo', $proovedore->legajo, ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Numero de legajo']) }}
            {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre', 'Nombre de proovedor') }}
            {{ Form::text('nombre', $proovedore->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre del proovedor: Cementos Avellanera']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numeroDeTelefono', 'Numero de contacto') }}
            {{ Form::text('numeroDeTelefono', $proovedore->numeroDeTelefono, ['class' => 'form-control' . ($errors->has('numeroDeTelefono') ? ' is-invalid' : ''), 'placeholder' => 'Numero de telefono']) }}
            {!! $errors->first('numeroDeTelefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cuil', 'Cuil de la empresa') }}
            {{ Form::text('cuil', $proovedore->cuil, ['class' => 'form-control' . ($errors->has('cuil') ? ' is-invalid' : ''), 'placeholder' => 'CUIL/CUIT']) }}
            {!! $errors->first('cuil', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo', 'Tipo de proovedor') }}
            {{ Form::text('tipo', $proovedore->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Cementera/Calera/Metalurgica/etc.']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaAlta', 'Fecha de alta en el sistema') }}
            {{ Form::text('fechaAlta', $proovedore->fechaAlta, ['class' => 'form-control datepicker' . ($errors->has('fechaAlta') ? ' is-invalid' : ''), 'placeholder' => 'Que dia se dio de alta']) }}
            {!! $errors->first('fechaAlta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaBaja', 'Fecha de alta del sistema') }}
            {{ Form::text('fechaBaja', $proovedore->fechaBaja, ['class' => 'form-control datepicker' . ($errors->has('fechaBaja') ? ' is-invalid' : ''), 'placeholder' => 'Que dia se dio de baja']) }}
            {!! $errors->first('fechaBaja', '<div class="invalid-feedback">:message</div>') !!}
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
