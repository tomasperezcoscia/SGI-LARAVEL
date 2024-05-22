<div class="box box-info padding-1">
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
</div>
