@extends('layouts.app')

@section('template_title')
    Personal
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Buscador y Tabla -->
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">
                        <form method="GET" action="{{ route('Personal.index') }}">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control" placeholder="Buscar... (Legajo, Nombre, Salario, Estado)" value="{{ request('search') }}">
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
                                        <th>N° de legajo</th>
                                        <th>Nombre completo</th>
                                        <th>Salario por hora</th>
                                        <th>Estado de empleado</th>
                                        <th>Fecha de alta</th>

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
                                            <td>{{ $personal->created_at }}</td>

                                            <td>
                                                <form action="{{ route('Personal.destroy', $personal->id) }}" method="POST">
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
                                            <form id="editForm{{ $personal->id }}" method="POST" action="{{ route('Personal.update', $personal->id) }}" role="form" enctype="multipart/form-data">
                                                {{ method_field('PATCH') }}
                                                @csrf
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-body">
                                                            <!-- Include the form fields here -->
                                                            @include('personal.form', ['personal' => $personal])
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal fade text-left" id="ModalShow{{ $personal->id }}" tabindex="-1">
                                            @csrf
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        {{ __('Mostrar') }} Personal
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
                                                            {{ $personal->created_at }}
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
                {!! $personals->links() !!}
            </div>
            <!-- Formulario de Crear Personal -->
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header">
                        <span id="form_title">{{ __('Agregar Personal') }}</span>
                    </div>
                    <div class="card-body">
                        @include('personal.form', ['personal' => new \App\Models\Personal()])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('form[id^="editForm"]');

        function attachEventListeners(form) {
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Prevent the default form submission
                console.log(`Form submitted ${form.id}`);

                const formData = new FormData(form);

                for (const [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }

                fetch(form.action, {
                    method: form.method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                }).then(response => {
                    console.log('Response received:', response); // Verificar la respuesta antes de parsear JSON
                    return response.json();
                }).then(data => {
                    console.log('Parsed JSON data:', data); // Log the parsed JSON data
                    if (data.success) {
                        console.log('Form submission successful');
                        window.location.href = "{{ route('Personal.index') }}"; // Redirect to the index after a successful edit
                    } else {
                        console.error('Form submission failed', data);
                    }
                }).catch(error => {
                    console.error('Form submission error:', error);
                });
            });
        }

        forms.forEach(form => {
            console.log('Attaching event listener to form:', form.id);
            attachEventListeners(form);
        });
    });
</script>
