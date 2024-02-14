@extends('layouts.app')

@section('template_title')
    Ausencias Personal
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Ausencias Personal') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('AusenciasPersonal.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar ausencia') }}
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
                                        
										<th>Tipo de ausencia</th>
										<th>Descripcion</th>
										<th>Fecha de inicio</th>
										<th>Fecha fin</th>
										<th>Personal Ausente</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ausenciasPersonals as $ausenciasPersonal)
                                        <tr>
                                            
											<td>{{ $ausenciasPersonal->tipo }}</td>
											<td>{{ $ausenciasPersonal->descripcion }}</td>
											<td>{{ $ausenciasPersonal->fechaDeInicio }}</td>
											<td>{{ $ausenciasPersonal->fechaDeFin }}</td>
											<td>{{ ($personals->firstWhere('id', $ausenciasPersonal->personal_id)->nombre) }}</td>

                                            <td>
                                                <form action="{{ route('AusenciasPersonal.destroy',$ausenciasPersonal->id) }}" method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $ausenciasPersonal->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $ausenciasPersonal->id }}">
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
                                        <div class="modal fade text-left" id="ModalEdit{{ $ausenciasPersonal->id }}" tabindex="-1">
                                            <form method="POST" action="{{ route('AusenciasPersonal.update', $ausenciasPersonal->id) }}"
                                                role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            @include('ausencias-personal.form')
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $ausenciasPersonal->id }}" tabindex="-1">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal header, body, and footer -->
                                                        <div class="modal-header">
                                                            @section('template_title')
                                                                {{ __('Mostrar') }} Ausencias Personal
                                                            @endsection
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <strong>Tipo de ausencia:</strong>
                                                                {{ $ausenciasPersonal->tipo }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Descripcion:</strong>
                                                                {{ $ausenciasPersonal->descripcion }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Fecha de inicio:</strong>
                                                                {{ $ausenciasPersonal->fechaDeInicio }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Fecha fin:</strong>
                                                                {{ $ausenciasPersonal->fechaDeFin }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Personal ausente:</strong>
                                                                {{ ($personals->firstWhere('id', $ausenciasPersonal->personal_id)->nombre) }}
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
                {!! $ausenciasPersonals->links() !!}
            </div>
        </div>
    </div>
@endsection
