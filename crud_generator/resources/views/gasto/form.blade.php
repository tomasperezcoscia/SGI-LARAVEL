<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre', 'Nombre') }}
            {{ Form::text('nombre', $gasto->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre de gasto']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tipo', 'Tipo de gasto') }}
            {{ Form::text('tipo', $gasto->tipo, ['class' => 'form-control' . ($errors->has('tipo') ? ' is-invalid' : ''), 'placeholder' => 'Tipo de gasto']) }}
            {!! $errors->first('tipo', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('porcentajeIva', 'Porcentaje de iva') }}
            {{ Form::text('porcentajeIva', $gasto->porcentajeIva, ['class' => 'form-control' . ($errors->has('porcentajeIva') ? ' is-invalid' : ''), 'placeholder' => 'Porcentaje de iva correspondiente: 21, 10.5, etc']) }}
            {!! $errors->first('porcentajeIva', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="modal-footer">
        <!-- Footer content -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <!-- Add any additional buttons or functionality you want in the modal footer -->
    </div>
</div>