@extends('layouts.app')

@section('template_title')
    Obras
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <span id="card_title">
                            {{ __('Obras') }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Presupuesto ID</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($obras as $obra)
                                        <tr>
                                            <td>{{ $obra->id }}</td>
                                            <td>{{ $obra->presupuesto_id }}</td>
                                            <td>
                                                <a href="{{ route('obras.show', $obra->id) }}" class="btn btn-info btn-sm">Ver</a>
                                                <a href="{{ route('obras.edit', $obra->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                                <form action="{{ route('obras.destroy', $obra->id) }}" method="POST" style="display:inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $obras->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
