<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('cliente_id', 'Cliente') }}
            {{ Form::select('cliente_id', $clientes->pluck('nombre', 'id'), $horasPersonal->cliente_id ?? '', ['class' => 'form-control select2' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Cliente']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('personal_id', 'Personal') }}
            {{ Form::select('personal_id', $personals->pluck('nombre', 'id'), $horasPersonal->personal_id ?? '', ['class' => 'form-control select2' . ($errors->has('personal_id') ? ' is-invalid' : ''), 'placeholder' => 'Personal']) }}
            {!! $errors->first('personal_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('orden_de_compra_id', 'Orden de compra') }}
            {{ Form::select('orden_de_compra_id', $ordenesDeCompras->map(function ($item) use ($clientes) {
                $cliente = $clientes->where('id', $item['cliente_id'])->first();
                return ['id' => $item['id'], 'text' => 'Int: ' . $item['numeroOrdenInterna'] . ' | Ext: ' . $item['numeroOrden'] . ' | ' . $cliente['nombre'] . ' | ' . $item['descripcionTarea']];
            })->pluck('text', 'id'), $horasPersonal->orden_de_compra_id ?? '', ['class' => 'form-control select2' . ($errors->has('orden_de_compra_id') ? ' is-invalid' : ''), 'placeholder' => 'Numero de orden interna']) }}
            {!! $errors->first('orden_de_compra_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tarea_id', 'Tarea') }}
            {{ Form::select('tarea_id', $tareas->pluck('nombre', 'id'), $horasPersonal->tarea_id ?? '', ['class' => 'form-control select2' . ($errors->has('tarea_id') ? ' is-invalid' : ''), 'placeholder' => 'Tarea']) }}
            {!! $errors->first('tarea_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('horas', 'Horas Invertidas') }}
            {{ Form::text('horas', $insumo->inventario, ['class' => 'form-control' . ($errors->has('horas') ? ' is-invalid' : ''), 'placeholder' => 'Horas']) }}
            {!! $errors->first('horas', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="modal-footer">
        <!-- Footer content -->
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <!-- Add any additional buttons or functionality you want in the modal footer -->
    </div>
</div>