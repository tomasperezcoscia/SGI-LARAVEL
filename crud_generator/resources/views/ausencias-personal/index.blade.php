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
                                        
										<th>Tipo</th>
										<th>Descripcion</th>
										<th>Fechadeinicio</th>
										<th>Fechadefin</th>
										<th>Personal Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ausenciasPersonals as $ausenciasPersonal)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $ausenciasPersonal->tipo }}</td>
											<td>{{ $ausenciasPersonal->descripcion }}</td>
											<td>{{ $ausenciasPersonal->fechaDeInicio }}</td>
											<td>{{ $ausenciasPersonal->fechaDeFin }}</td>
											<td>{{ $ausenciasPersonal->personal_id }}</td>

                                            <td>
                                                <form action="{{ route('AusenciasPersonal.destroy',$ausenciasPersonal->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('AusenciasPersonal.show',$ausenciasPersonal->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('AusenciasPersonal.edit',$ausenciasPersonal->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $ausenciasPersonals->links() !!}
            </div>
        </div>
    </div>
@endsection
