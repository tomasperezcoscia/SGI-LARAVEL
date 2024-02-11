@extends('layouts.app')

@section('template_title')
    Personal
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tabla de personal') }}
                            </span>

                            @if ($personals->isEmpty())
                            <div class="float-right">
                                <a href="{{ route('Personal.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar Personal') }}
                                </a>
                              </div>
                            @else
                             <div class="float-right">
                                <a href="#" data-toggle="modal" data-target="#ModalCreate"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Agregar Personal') }}
                                </a>
                              </div>
                            @endif
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
                                        <th>Nombre completo</th>
                                        <th>Salario por hora</th>
                                        <th>Estado de empleado</th>
                                        <th>Fecha de alta</th>
                                        <th>Fecha de baja</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($personals as $personal)
                                        <tr>
                                            <td>{{ $personal->legajo }}</td>
                                            <td>{{ $personal->nombre }}</td>
                                            <td>$ {{ $personal->salario_hora }}</td>
                                            <td>{{ $personal->estado }}</td>
                                            <td>{{ $personal->fechaDeAlta }}</td>
                                            <td>{{ $personal->fechaDeBaja }}</td>

                                            <td>
                                                <form>
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $personal->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $personal->id }}">
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
                                        <div class="modal fade text-left" id="ModalEdit{{ $personal->id }}" tabindex="-1">
                                            <form method="POST" action="{{ route('Personal.update', $personal->id) }}"
                                                role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            @include('personal.form')
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $personal->id }}" tabindex="-1">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal header, body, and footer -->
                                                        <div class="modal-header">
                                                            @section('template_title')
                                                                {{ __('Mostrar') }} Personal
                                                            @endsection
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <strong>N° de legajo:</strong>
                                                                {{ $personal->legajo }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Nombre completo:</strong>
                                                                {{ $personal->nombre }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Salario por hora:</strong>
                                                                $ {{ $personal->salario_hora }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Estado de empleado:</strong>
                                                                {{ $personal->estado }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Fecha de alta:</strong>
                                                                {{ $personal->fechaDeAlta }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Fecha de baja:</strong>
                                                                {{ $personal->fechaDeBaja }}
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
                {!! $personals->links() !!}
            </div>
        </div>
    </div>
    @if(!$personals->isEmpty())
        @include('Personal.modal.create')
    @endif
@endsection
