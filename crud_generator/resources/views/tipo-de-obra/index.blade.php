@extends('layouts.app')

@section('template_title')
    Tipo De Obra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Tipo De Obra') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('TipoDeObra.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Agregar tipo de obra') }}
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
										<th>Tipo</th>
										<th>Descripcion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tipoDeObras as $tipoDeObra)
                                        <tr>
                                            
											<td>{{ $tipoDeObra->nombre }}</td>
											<td>{{ $tipoDeObra->tipo }}</td>
											<td>{{ $tipoDeObra->descripcion }}</td>

                                            <td>
                                                <form action="{{ route('TipoDeObra.destroy',$tipoDeObra->id) }}" method="POST">
                                                    <!-- Modal Trigger Buttons -->
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-toggle="modal" data-target="#ModalShow{{ $tipoDeObra->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm"
                                                        data-toggle="modal" data-target="#ModalEdit{{ $tipoDeObra->id }}">
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
                                        <div class="modal fade text-left" id="ModalEdit{{ $tipoDeObra->id }}" tabindex="-1">
                                            <form method="POST" action="{{ route('TipoDeObra.update', $tipoDeObra->id) }}"
                                                role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                        Tipo De Obra
                                                    @endsection                                                                                                                                                                                                                
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $tipoDeObra->id }}" tabindex="-1">
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <!-- Modal header, body, and footer -->
                                                        <div class="modal-header">
                                                            @section('template_title')
                                                                {{ __('Mostrar') }} Tarea
                                                            @endsection
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <strong>Nombre:</strong>
                                                                {{ $tipoDeObra->nombre }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Tipo:</strong>
                                                                {{ $tipoDeObra->tipo }}
                                                            </div>
                                                            <div class="form-group">
                                                                <strong>Descripcion:</strong>
                                                                {{ $tipoDeObra->descripcion }}
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
                {!! $tipoDeObras->links() !!}
            </div>
        </div>
    </div>
@endsection

