@extends('layouts.app')

@section('template_title')
    Insumo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Insumo') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('Insumo.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar insumos') }}
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
                                        
										<th>Nombre</th>
										<th>Tipo de insumo</th>
										<th>Precio</th>
										<th>Inventario</th>
										<th>Ultima fecha precio</th>
										<th>Proovedor</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <div class="row">
                                    <div class="col-md-6">
                                        <form class="form-inline" method="GET" action="{{ route('Insumo.index') }}">
                                            <div class="input-group">
                                                <input type="text" class="form-control" name="search" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Buscar</button>
                                                    <button class="btn btn-secondary" type="button" onclick="window.location.href='{{ route('Insumo.index') }}'"><i class="fa fa-refresh"></i> Resetear búsqueda</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <tbody>
                                    @foreach ($insumos as $insumo)
                                        <tr>
                                            
											<td>{{ $insumo->nombre }}</td>
											<td>{{ $insumo->tipo }}</td>
											<td>{{ $insumo->precio }}</td>
											<td>{{ $insumo->inventario }}</td>
											<td>{{ $insumo->ultimaFechaPrecio }}</td>
											<td>{{ ($proovedores->firstWhere('id', $insumo->proovedor_id)->nombre) }}</td>

                                            <td>
                                                <form action="{{ route('Insumo.destroy',$insumo->id) }}" method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $insumo->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $insumo->id }}">
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
                                        <div class="modal fade text-left" id="ModalEdit{{ $insumo->id }}" tabindex="-1">
                                            <form method="POST" action="{{ route('Insumo.update', $insumo->id) }}"
                                                role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            @include('insumo.form')
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $insumo->id }}" tabindex="-1">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal header, body, and footer -->
                                                        <div class="modal-header">
                                                            @section('template_title')
                                                                {{ __('Mostrar') }} insumo
                                                            @endsection
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <strong>Nombre de insumo:</strong>
                                                                {{ $insumo->nombre }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Tipo de insumo:</strong>
                                                                {{ $insumo->tipo }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Precio:</strong>
                                                                {{ $insumo->precio }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Inventario:</strong>
                                                                {{ $insumo->inventario }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Ultima fecha precio:</strong>
                                                                {{ $insumo->ultimaFechaPrecio }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Proovedor Id:</strong>
                                                                {{ ($proovedores->firstWhere('id', $insumo->proovedor_id)->nombre) }}
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
                {!! $insumos->links() !!}
            </div>
        </div>
    </div>
@endsection
