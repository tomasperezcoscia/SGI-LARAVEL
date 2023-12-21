<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('numeroOrdenInterna') }}
            {{ Form::text('numeroOrdenInterna', $ordenesDeCompra->numeroOrdenInterna, ['class' => 'form-control' . ($errors->has('numeroOrdenInterna') ? ' is-invalid' : ''), 'placeholder' => 'Numeroordeninterna']) }}
            {!! $errors->first('numeroOrdenInterna', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cliente_id') }}
            {{ Form::text('cliente_id', $ordenesDeCompra->cliente_id, ['class' => 'form-control' . ($errors->has('cliente_id') ? ' is-invalid' : ''), 'placeholder' => 'Cliente Id']) }}
            {!! $errors->first('cliente_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('numeroOrden') }}
            {{ Form::text('numeroOrden', $ordenesDeCompra->numeroOrden, ['class' => 'form-control' . ($errors->has('numeroOrden') ? ' is-invalid' : ''), 'placeholder' => 'Numeroorden']) }}
            {!! $errors->first('numeroOrden', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcionTarea') }}
            {{ Form::text('descripcionTarea', $ordenesDeCompra->descripcionTarea, ['class' => 'form-control' . ($errors->has('descripcionTarea') ? ' is-invalid' : ''), 'placeholder' => 'Descripciontarea']) }}
            {!! $errors->first('descripcionTarea', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('cuit_cuil') }}
            {{ Form::text('cuit_cuil', $ordenesDeCompra->cuit_cuil, ['class' => 'form-control' . ($errors->has('cuit_cuil') ? ' is-invalid' : ''), 'placeholder' => 'Cuit Cuil']) }}
            {!! $errors->first('cuit_cuil', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('fechaDeIngreso') }}
            {{ Form::text('fechaDeIngreso', $ordenesDeCompra->fechaDeIngreso, ['class' => 'form-control' . ($errors->has('fechaDeIngreso') ? ' is-invalid' : ''), 'placeholder' => 'Fechadeingreso']) }}
            {!! $errors->first('fechaDeIngreso', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('caracter') }}
            {{ Form::text('caracter', $ordenesDeCompra->caracter, ['class' => 'form-control' . ($errors->has('caracter') ? ' is-invalid' : ''), 'placeholder' => 'Caracter']) }}
            {!! $errors->first('caracter', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('polizaArt') }}
            {{ Form::text('polizaArt', $ordenesDeCompra->polizaArt, ['class' => 'form-control' . ($errors->has('polizaArt') ? ' is-invalid' : ''), 'placeholder' => 'Polizaart']) }}
            {!! $errors->first('polizaArt', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('vencimientoPolizaArt') }}
            {{ Form::text('vencimientoPolizaArt', $ordenesDeCompra->vencimientoPolizaArt, ['class' => 'form-control' . ($errors->has('vencimientoPolizaArt') ? ' is-invalid' : ''), 'placeholder' => 'Vencimientopolizaart']) }}
            {!! $errors->first('vencimientoPolizaArt', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('polizaDeAccPer') }}
            {{ Form::text('polizaDeAccPer', $ordenesDeCompra->polizaDeAccPer, ['class' => 'form-control' . ($errors->has('polizaDeAccPer') ? ' is-invalid' : ''), 'placeholder' => 'Polizadeaccper']) }}
            {!! $errors->first('polizaDeAccPer', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('vencimientoPolizaDeAccPer') }}
            {{ Form::text('vencimientoPolizaDeAccPer', $ordenesDeCompra->vencimientoPolizaDeAccPer, ['class' => 'form-control' . ($errors->has('vencimientoPolizaDeAccPer') ? ' is-invalid' : ''), 'placeholder' => 'Vencimientopolizadeaccper']) }}
            {!! $errors->first('vencimientoPolizaDeAccPer', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>