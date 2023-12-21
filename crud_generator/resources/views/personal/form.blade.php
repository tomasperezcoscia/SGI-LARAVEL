<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('legajo') }}
            {{ Form::text('legajo', $personal->legajo, ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Legajo']) }}
            {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $personal->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('salario_hora') }}
            {{ Form::text('salario_hora', $personal->salario_hora, ['class' => 'form-control' . ($errors->has('salario_hora') ? ' is-invalid' : ''), 'placeholder' => 'Salario Hora']) }}
            {!! $errors->first('salario_hora', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('estado') }}
            {{ Form::text('estado', $personal->estado, ['class' => 'form-control' . ($errors->has('estado') ? ' is-invalid' : ''), 'placeholder' => 'Estado']) }}
            {!! $errors->first('estado', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaDeAlta') }}
            {{ Form::text('fechaDeAlta', $personal->fechaDeAlta, ['class' => 'form-control' . ($errors->has('fechaDeAlta') ? ' is-invalid' : ''), 'placeholder' => 'Fechadealta']) }}
            {!! $errors->first('fechaDeAlta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaDeBaja') }}
            {{ Form::text('fechaDeBaja', $personal->fechaDeBaja, ['class' => 'form-control' . ($errors->has('fechaDeBaja') ? ' is-invalid' : ''), 'placeholder' => 'Fechadebaja']) }}
            {!! $errors->first('fechaDeBaja', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>