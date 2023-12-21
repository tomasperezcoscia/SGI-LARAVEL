<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('legajo') }}
            {{ Form::text('legajo', $proovedore->legajo, ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Legajo']) }}
            {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $proovedore->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numeroDeTelefono') }}
            {{ Form::text('numeroDeTelefono', $proovedore->numeroDeTelefono, ['class' => 'form-control' . ($errors->has('numeroDeTelefono') ? ' is-invalid' : ''), 'placeholder' => 'Numerodetelefono']) }}
            {!! $errors->first('numeroDeTelefono', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cuil') }}
            {{ Form::text('cuil', $proovedore->cuil, ['class' => 'form-control' . ($errors->has('cuil') ? ' is-invalid' : ''), 'placeholder' => 'Cuil']) }}
            {!! $errors->first('cuil', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo') }}
            {{ Form::text('tipo', $proovedore->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaAlta') }}
            {{ Form::text('fechaAlta', $proovedore->fechaAlta, ['class' => 'form-control' . ($errors->has('fechaAlta') ? ' is-invalid' : ''), 'placeholder' => 'Fechaalta']) }}
            {!! $errors->first('fechaAlta', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaBaja') }}
            {{ Form::text('fechaBaja', $proovedore->fechaBaja, ['class' => 'form-control' . ($errors->has('fechaBaja') ? ' is-invalid' : ''), 'placeholder' => 'Fechabaja']) }}
            {!! $errors->first('fechaBaja', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>