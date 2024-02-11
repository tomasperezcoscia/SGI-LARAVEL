@extends('layouts.app')

@section('template_title')
    Proovedore
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tabla de proovedores') }}
                            </span>

                             <div class="float-right">
                                <a href="#" data-toggle="modal" data-target="#ModalCreate"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Agregar Proovedor') }}
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
										<th>Nro de legajo</th>
										<th>Nombre</th>
										<th>Telefono</th>
										<th>Cuil</th>
										<th>Tipo</th>
										<th>Fecha de alta</th>
										<th>Fecha de baja</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proovedores as $proovedore)
                                        <tr>                                            
											<td>{{ $proovedore->legajo }}</td>
											<td>{{ $proovedore->nombre }}</td>
											<td>{{ $proovedore->numeroDeTelefono }}</td>
											<td>{{ $proovedore->cuil }}</td>
											<td>{{ $proovedore->tipo }}</td>
											<td>{{ $proovedore->fechaAlta }}</td>
											<td>{{ $proovedore->fechaBaja }}</td>

                                            <td>
                                                <form>
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $proovedore->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $proovedore->id }}">
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
                                        <div class="modal fade text-left" id="ModalEdit{{ $proovedore->id }}" tabindex="-1">
                                            <form method="POST" action="{{ route('Proovedore.update', $proovedore->id) }}"
                                                role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            @include('proovedore.form')
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $proovedore->id }}" tabindex="-1">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal header, body, and footer -->
                                                        <div class="modal-header">
                                                            @section('template_title')
                                                                {{ __('Mostrar') }} Proovedore
                                                            @endsection
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <strong>Legajo:</strong>
                                                                {{ $proovedore->legajo }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Nombre:</strong>
                                                                {{ $proovedore->nombre }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Numerodetelefono:</strong>
                                                                {{ $proovedore->numeroDeTelefono }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Cuil:</strong>
                                                                {{ $proovedore->cuil }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Tipo:</strong>
                                                                {{ $proovedore->tipo }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Fechaalta:</strong>
                                                                {{ $proovedore->fechaAlta }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Fechabaja:</strong>
                                                                {{ $proovedore->fechaBaja }}
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
                {!! $proovedores->links() !!}
            </div>
        </div>
    </div>
    @include('Proovedore.modal.create')
@endsection
