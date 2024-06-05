@extends('layouts.app')

@section('template_title')
    Comparar Presupuesto y Obra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <span id="card_title">
                            {{ __('Comparar Presupuesto y Obra') }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Insumo</th>
                                        <th>Cantidad Presupuestada</th>
                                        <th>Cantidad Consumida</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($presupuesto->insumos as $insumo)
                                        <tr>
                                            <td>{{ $insumo->nombre }}</td>
                                            <td>{{ $insumo->pivot->cantidad }}</td>
                                            <td>{{ $obra->insumos->firstWhere('id', $insumo->id)->pivot->cantidad ?? 0 }}</td>
                                        </tr>
                                    @endforeach
                                    @foreach ($obra->insumos->whereNotIn('id', $presupuesto->insumos->pluck('id')) as $insumo)
                                        <tr>
                                            <td>{{ $insumo->nombre }} (No presupuestado)</td>
                                            <td>0</td>
                                            <td>{{ $insumo->pivot->cantidad }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ route('presupuestos.show', $presupuesto->id) }}" class="btn btn-primary">Volver a Presupuesto</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
