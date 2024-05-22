@extends('layouts.app')

@section('template_title')
    Proovedore
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Formulario de Búsqueda -->
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('Proovedore.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" value="{{ request('search') }}" placeholder="Buscar... (Nro de legajo, Nombre, Telefono, Tipo)">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <!-- Tabla de Proveedores -->
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Tabla de Proveedores') }}
                            </span>
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
                                        <th>Tipo</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proovedores as $proovedore)
                                        <tr>                                            
                                            <td>{{ $proovedore->legajo }}</td>
                                            <td>{{ $proovedore->nombre }}</td>
                                            <td>{{ $proovedore->numeroDeTelefono }}</td>
                                            <td>{{ $proovedore->tipo }}</td>
                                            <td>
                                                <form action="{{ route('Proovedore.destroy',$proovedore->id) }}" method="POST">
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
                                                            <strong>Nro de legajo:</strong>
                                                            {{ $proovedore->legajo }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Nombre de proovedor:</strong>
                                                            {{ $proovedore->nombre }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Numero de telefono:</strong>
                                                            {{ $proovedore->numeroDeTelefono }}
                                                        </div>
                                                        <div class="form-group">
                                                            <strong>Tipo de proveedor:</strong>
                                                            {{ $proovedore->tipo }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
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

            <!-- Formulario de Agregar Proveedor -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">
                            {{ __('Agregar Proveedor') }}
                        </span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('Proovedore.store') }}" role="form" enctype="multipart/form-data">
                            @csrf
                            @include('proovedore.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
