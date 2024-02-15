@extends('layouts.app')

@section('template_title')
    Cliente
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tabla de clientes') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('Cliente.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar Cliente') }}
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
                                        
										<th>N° de legajo</th>
										<th>Nombre cliente</th>
										<th>Tipo de cliente</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clientes as $cliente)
                                        <tr>
                                            
											<td>{{ $cliente->legajo }}</td>
											<td>{{ $cliente->nombre }}</td>
											<td>{{ $cliente->tipo }}</td>

                                            <td>
                                                <form action="{{ route('Cliente.destroy',$cliente->id) }}" method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $cliente->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $cliente->id }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>

                                            </td>
                                        </tr>
                                        <!-- Modals -->
                                        <div class="modal fade text-left" id="ModalEdit{{ $cliente->id }}" tabindex="-1">
                                            <form method="POST" action="{{ route('Cliente.update', $cliente->id) }}"
                                                role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            @include('cliente.form')
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $cliente->id }}" tabindex="-1">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal header, body, and footer -->
                                                        <div class="modal-header">
                                                            @section('template_title')
                                                                {{ __('Mostrar') }} Cliente
                                                            @endsection
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <strong>Nro de legajo:</strong>
                                                                {{ $cliente->legajo }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Nombre cliente:</strong>
                                                                {{ $cliente->nombre }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Tipo de cliente:</strong>
                                                                {{ $cliente->tipo }}
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
                {!! $clientes->links() !!}
            </div>
        </div>
    </div>
@endsection
