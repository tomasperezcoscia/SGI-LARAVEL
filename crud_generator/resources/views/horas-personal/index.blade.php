@extends('layouts.app')

@section('template_title')
    Horas Personal
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Horas Personal') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('HorasPersonal.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar horas personal') }}
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
                                        
										<th>Fecha de carga</th>
										<th>Cliente</th>
										<th>Personal</th>
										<th>Orden de compra (Interna)</th>
										<th>Tarea</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($horasPersonals as $horasPersonal)
                                        <tr>
                                            
                                            <td>{{ $horasPersonal->created_at->subHours(3) }}</td>
											<td>{{ ($clientes->firstWhere('id', $horasPersonal->cliente_id)->nombre) }}</td>
											<td>{{ ($personals->firstWhere('id', $horasPersonal->personal_id)->nombre) }}</td>
											<td>{{ ($ordenesDeCompras->firstWhere('id', $horasPersonal->orden_de_compra_id)->numeroOrdenInterna) }}</td>
											<td>{{ ($tareas->firstWhere('id', $horasPersonal->tarea_id)->nombre) }}</td>

                                            <td>
                                                <form action="{{ route('HorasPersonal.destroy',$horasPersonal->id) }}" method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $horasPersonal->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $horasPersonal->id }}">
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
                                        <div class="modal fade text-left" id="ModalEdit{{ $horasPersonal->id }}" tabindex="-1">
                                            <form method="POST" action="{{ route('HorasPersonal.update', $horasPersonal->id) }}"
                                                role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            @include('horas-personal.form')
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $horasPersonal->id }}" tabindex="-1">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal header, body, and footer -->
                                                        <div class="modal-header">
                                                            @section('template_title')
                                                                {{ __('Mostrar') }} Horas Personal
                                                            @endsection
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <strong>Fecha de carga:</strong>
                                                                {{ $horasPersonal->created_at->subHours(3) }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Cliente:</strong>
                                                                {{ ($clientes->firstWhere('id', $horasPersonal->cliente_id)->nombre) }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Personal:</strong>
                                                                {{ ($personals->firstWhere('id', $horasPersonal->personal_id)->nombre) }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Orden de compra:</strong>
                                                                {{ ($ordenesDeCompras->firstWhere('id', $horasPersonal->orden_de_compra_id)->numeroOrdenInterna) }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Tarea:</strong>
                                                                {{ ($tareas->firstWhere('id', $horasPersonal->tarea_id)->nombre) }}
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
                {!! $horasPersonals->links() !!}
            </div>
        </div>
    </div>
@endsection
