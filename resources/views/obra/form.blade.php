<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $obra->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('legajo') }}
            {{ Form::text('legajo', $obra->legajo, ['class' => 'form-control' . ($errors->has('legajo') ? ' is-invalid' : ''), 'placeholder' => 'Legajo']) }}
            {!! $errors->first('legajo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_cliente') }}
            {{ Form::text('id_cliente', $obra->id_cliente, ['class' => 'form-control' . ($errors->has('id_cliente') ? ' is-invalid' : ''), 'placeholder' => 'Id Cliente']) }}
            {!! $errors->first('id_cliente', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_insumosParaObra') }}
            {{ Form::text('id_insumosParaObra', $obra->id_insumosParaObra, ['class' => 'form-control' . ($errors->has('id_insumosParaObra') ? ' is-invalid' : ''), 'placeholder' => 'Id Insumosparaobra']) }}
            {!! $errors->first('id_insumosParaObra', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('id_horasDePersonal') }}
            {{ Form::text('id_horasDePersonal', $obra->id_horasDePersonal, ['class' => 'form-control' . ($errors->has('id_horasDePersonal') ? ' is-invalid' : ''), 'placeholder' => 'Id Horasdepersonal']) }}
            {!! $errors->first('id_horasDePersonal', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>