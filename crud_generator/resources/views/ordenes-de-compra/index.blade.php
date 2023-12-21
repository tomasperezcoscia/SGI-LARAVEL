@extends('layouts.app')

@section('template_title')
    Ordenes De Compra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ordenes De Compra') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('OrdenesDeCompra.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Numeroordeninterna</th>
										<th>Cliente Id</th>
										<th>Numeroorden</th>
										<th>Descripciontarea</th>
										<th>Cuit Cuil</th>
										<th>Fechadeingreso</th>
										<th>Caracter</th>
										<th>Polizaart</th>
										<th>Vencimientopolizaart</th>
										<th>Polizadeaccper</th>
										<th>Vencimientopolizadeaccper</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenesDeCompras as $ordenesDeCompra)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ordenesDeCompra->numeroOrdenInterna }}</td>
											<td>{{ $ordenesDeCompra->cliente_id }}</td>
											<td>{{ $ordenesDeCompra->numeroOrden }}</td>
											<td>{{ $ordenesDeCompra->descripcionTarea }}</td>
											<td>{{ $ordenesDeCompra->cuit_cuil }}</td>
											<td>{{ $ordenesDeCompra->fechaDeIngreso }}</td>
											<td>{{ $ordenesDeCompra->caracter }}</td>
											<td>{{ $ordenesDeCompra->polizaArt }}</td>
											<td>{{ $ordenesDeCompra->vencimientoPolizaArt }}</td>
											<td>{{ $ordenesDeCompra->polizaDeAccPer }}</td>
											<td>{{ $ordenesDeCompra->vencimientoPolizaDeAccPer }}</td>

                                            <td>
                                                <form action="{{ route('OrdenesDeCompra.destroy',$ordenesDeCompra->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('OrdenesDeCompra.show',$ordenesDeCompra->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('OrdenesDeCompra.edit',$ordenesDeCompra->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $ordenesDeCompras->links() !!}
            </div>
        </div>
    </div>
@endsection
