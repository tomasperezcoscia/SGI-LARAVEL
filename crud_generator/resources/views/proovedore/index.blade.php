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
                                {{ __('Proovedore') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('Proovedore.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Legajo</th>
										<th>Nombre</th>
										<th>Numerodetelefono</th>
										<th>Cuil</th>
										<th>Tipo</th>
										<th>Fechaalta</th>
										<th>Fechabaja</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proovedores as $proovedore)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $proovedore->legajo }}</td>
											<td>{{ $proovedore->nombre }}</td>
											<td>{{ $proovedore->numeroDeTelefono }}</td>
											<td>{{ $proovedore->cuil }}</td>
											<td>{{ $proovedore->tipo }}</td>
											<td>{{ $proovedore->fechaAlta }}</td>
											<td>{{ $proovedore->fechaBaja }}</td>

                                            <td>
                                                <form action="{{ route('Proovedore.destroy',$proovedore->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('Proovedore.show',$proovedore->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('Proovedore.edit',$proovedore->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $proovedores->links() !!}
            </div>
        </div>
    </div>
@endsection
