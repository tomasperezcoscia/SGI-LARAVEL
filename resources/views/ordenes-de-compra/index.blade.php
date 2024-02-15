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
                                  {{ __('Agregar orden de compra') }}
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
                                        
										<th>Nro orden interna</th>
										<th>Cliente</th>
										<th>Nro orden</th>
										<th>Tarea</th>
										<th>Valor de la tarea</th>
                                        <th>Iva</th>
                                        <th>Valor de la tarea C/iva</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenesDeCompras as $ordenesDeCompra)
                                        <tr>
                                            
											<td>{{ $ordenesDeCompra->numeroOrdenInterna }}</td>
											<td>{{ ($clientes->firstWhere('id', $ordenesDeCompra->cliente_id)->nombre) }}</td>
											<td>{{ $ordenesDeCompra->numeroOrden }}</td>
											<td>{{ $ordenesDeCompra->descripcionTarea }}</td>
											<td>{{ $ordenesDeCompra->valorTarea }}</td>
                                            <td>{{ $ordenesDeCompra->valorTarea * 0.21 }}</td>
                                            <td>{{ $ordenesDeCompra->valorTarea * 1.21 }}</td>
                                            

                                            <td>
                                                <form action="{{ route('OrdenesDeCompra.destroy',$ordenesDeCompra->id) }}" method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $ordenesDeCompra->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $ordenesDeCompra->id }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>

                                        <!-- Modals -->
                                        <div class="modal fade text-left" id="ModalEdit{{ $ordenesDeCompra->id }}" tabindex="-1">
                                            <form method="POST" action="{{ route('OrdenesDeCompra.update', $ordenesDeCompra->id) }}"
                                                role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            @include('ordenes-de-compra.form')
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $ordenesDeCompra->id }}" tabindex="-1">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal header, body, and footer -->
                                                        <div class="modal-header">
                                                            @section('template_title')
                                                                {{ __('Mostrar') }} Orden de compra
                                                            @endsection
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <strong>Numero de orden interna:</strong>
                                                                {{ $ordenesDeCompra->numeroOrdenInterna }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Cliente:</strong>
                                                                {{ ($clientes->firstWhere('id', $ordenesDeCompra->cliente_id)->nombre) }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Numero de orden:</strong>
                                                                {{ $ordenesDeCompra->numeroOrden }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Descripcion de tarea:</strong>
                                                                {{ $ordenesDeCompra->descripcionTarea }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Valor tarea:</strong>
                                                                {{ $ordenesDeCompra->valorTarea }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Iva:</strong>
                                                                {{ $ordenesDeCompra->valorTarea * 0.21 }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Valor tarea con iva:</strong>
                                                                {{ $ordenesDeCompra->valorTarea * 1.21}}
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <!-- Footer content -->
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                                                                <!-- Add any additional buttons or functionality you want in the modal footer -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
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
