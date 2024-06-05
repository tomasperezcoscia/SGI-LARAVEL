@extends('layouts.app')

@section('template_title')
    Ausencias Personal
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('AusenciasPersonal.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control"
                                    placeholder="Buscar... (Tipo, Descripción)"
                                    value="{{ request('search') }}">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">Buscar</button>
                                </span>
                            </div>
                        </form>
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
                                            <td>{{ $personals->firstWhere('id', $ausenciasPersonal->personal_id)->nombre }}</td>
                                            <td>
                                                <form action="{{ route('AusenciasPersonal.destroy', $ausenciasPersonal->id) }}" method="POST">
                                                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#ModalShow{{ $ausenciasPersonal->id }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Mostrar') }}
                                                    </button>
                                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#ModalEdit{{ $ausenciasPersonal->id }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}
                                                    </button>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Borrar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                        <!-- Modals -->
                                        <div class="modal fade text-left" id="ModalEdit{{ $ausenciasPersonal->id }}" tabindex="-1">
                                            <form id="editForm{{ $ausenciasPersonal->id }}" method="POST" action="{{ route('AusenciasPersonal.update', $ausenciasPersonal->id) }}" role="form" enctype="multipart/form-data">
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
                                                    <div class="modal-header">
                                                        {{ __('Mostrar') }} Ausencias Personal
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
                                                            {{ $personals->firstWhere('id', $ausenciasPersonal->personal_id)->nombre }}
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cerrar') }}</button>
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
            <!-- Formulario de Crear AusenciasPersonal -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">{{ __('Agregar Ausencia') }}</span>
                    </div>
                    <div class="card-body">
                        @include('ausencias-personal.form', ['ausenciasPersonal' => new \App\Models\AusenciasPersonal()])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        function attachEditEventListeners() {
            const editForms = document.querySelectorAll('form[id^="editForm"]');

            editForms.forEach(form => {
                if (!form.editEventListenerAttached) {
                    form.editEventListenerAttached = true;

                    $(form).find('.select2').select2();
                    $(form).find('.datepicker').datepicker({
                        dateFormat: 'yy-mm-dd',
                        onSelect: function(dateText) {
                            $(this).val(dateText);
                        }
                    });

                    form.addEventListener('submit', function(event) {
                        event.preventDefault();

                        const formData = new FormData(form);

                        fetch(form.action, {
                            method: form.method,
                            body: formData,
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            }
                        }).then(response => {
                            return response.json();
                        }).then(data => {
                            if (data.success) {
                                window.location.href = "{{ route('AusenciasPersonal.index') }}";
                            } else {
                                if (data.errors) {
                                    console.error('Validation errors', data.errors);
                                } else {
                                    console.error('Form submission failed', data);
                                }
                            }
                        }).catch(error => {
                            console.error('Form submission error:', error);
                        });
                    });
                }
            });
        }

        attachEditEventListeners();
    });
</script>


