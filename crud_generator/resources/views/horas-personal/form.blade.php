<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('fechaDeCarga') }}
            {{ Form::text('fechaDeCarga', $horasPersonal->fechaDeCarga, ['class' => 'form-control' . ($errors->has('fechaDeCarga') ? ' is-invalid' : ''), 'placeholder' => 'Fechadecarga']) }}
            {!! $errors->first('fechaDeCarga', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cliente_id') }}
            {{ Form::text('cliente_id', $horasPersonal->cliente_id, ['class' => 'form-control' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Cliente Id']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('personal_id') }}
            {{ Form::text('personal_id', $horasPersonal->personal_id, ['class' => 'form-control' . ($errors->has('personal_id') ? ' is-invalid' : ''), 'placeholder' => 'Personal Id']) }}
            {!! $errors->first('personal_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('orden_de_compra_id') }}
            {{ Form::text('orden_de_compra_id', $horasPersonal->orden_de_compra_id, ['class' => 'form-control' . ($errors->has('orden_de_compra_id') ? ' is-invalid' : ''), 'placeholder' => 'Orden De Compra Id']) }}
            {!! $errors->first('orden_de_compra_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tarea_id') }}
            {{ Form::text('tarea_id', $horasPersonal->tarea_id, ['class' => 'form-control' . ($errors->has('tarea_id') ? ' is-invalid' : ''), 'placeholder' => 'Tarea Id']) }}
            {!! $errors->first('tarea_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="modal-footer">
        <!-- Footer content -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <!-- Add any additional buttons or functionality you want in the modal footer -->
    </div>
</div>