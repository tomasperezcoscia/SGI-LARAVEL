@extends('layouts.app')

@section('template_title')
    Insumos Para Obra
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Insumos Para Obra') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('insumos-para-obras.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Id Insumo</th>
										<th>Id Obra</th>
										<th>Cantidad</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($insumosParaObras as $insumosParaObra)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $insumosParaObra->id_insumo }}</td>
											<td>{{ $insumosParaObra->id_obra }}</td>
											<td>{{ $insumosParaObra->cantidad }}</td>

                                            <td>
                                                <form action="{{ route('insumos-para-obras.destroy',$insumosParaObra->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('insumos-para-obras.show',$insumosParaObra->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('insumos-para-obras.edit',$insumosParaObra->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $insumosParaObras->links() !!}
            </div>
        </div>
    </div>
@endsection
