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
                                        
										<th>Fechadecarga</th>
										<th>Cliente Id</th>
										<th>Personal Id</th>
										<th>Orden De Compra Id</th>
										<th>Tarea Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($horasPersonals as $horasPersonal)
                                        <tr>
                                            
											<td>{{ $horasPersonal->fechaDeCarga }}</td>
											<td>{{ $horasPersonal->cliente_id }}</td>
											<td>{{ $horasPersonal->personal_id }}</td>
											<td>{{ $horasPersonal->orden_de_compra_id }}</td>
											<td>{{ $horasPersonal->tarea_id }}</td>

                                            <td>
                                                <form action="{{ route('HorasPersonal.destroy',$horasPersonal->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('HorasPersonal.show',$horasPersonal->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('HorasPersonal.edit',$horasPersonal->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $horasPersonals->links() !!}
            </div>
        </div>
    </div>
@endsection
