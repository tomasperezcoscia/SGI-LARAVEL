<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('numeroOrdenInterna', 'Numero de orden interna') }}
            {{ Form::text('numeroOrdenInterna', $ordenesDeCompra->numeroOrdenInterna ?? '', ['class' => 'form-control' . ($errors->has('numeroOrdenInterna') ? ' is-invalid' : ''), 'placeholder' => 'Numero de orden interna']) }}
            {!! $errors->first('numeroOrdenInterna', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cliente_id', 'Cliente') }}
            {{ Form::select('cliente_id', $clientes->pluck('nombre', 'id'), $ordenesDeCompra->cliente_id ?? '', ['class' => 'form-control select2' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar cliente', 'data-allow-clear' => 'true', 'id' => 'cliente_id_select']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numeroOrden','Numero de orden') }}
            {{ Form::text('numeroOrden', $ordenesDeCompra->numeroOrden ?? '', ['class' => 'form-control' . ($errors->has('numeroOrden') ? ' is-invalid' : ''), 'placeholder' => 'Numero de orden']) }}
            {!! $errors->first('numeroOrden', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcionTarea', 'Descripcion tarea') }}
            {{ Form::text('descripcionTarea', $ordenesDeCompra->descripcionTarea ?? '', ['class' => 'form-control' . ($errors->has('descripcionTarea') ? ' is-invalid' : ''), 'placeholder' => 'Breve descripcion de tarea']) }}
            {!! $errors->first('descripcionTarea', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('valorTarea', 'Valor de la tarea, sin iva agregado') }}
            {{ Form::text('valorTarea', $ordenesDeCompra->valorTarea ?? '', ['class' => 'form-control' . ($errors->has('valorTarea') ? ' is-invalid' : ''), 'placeholder' => 'Valor sin iva']) }}
            {!! $errors->first('valorTarea', '<div class="invalid-feedback">:message</div>') !!}
        </div>


    </div>
    <div class="modal-footer">
        <!-- Footer content -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <!-- Add any additional buttons or functionality you want in the modal footer -->
    </div>
</div>
