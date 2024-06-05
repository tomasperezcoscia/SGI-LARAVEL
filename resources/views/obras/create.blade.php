@extends('layouts.app')

@section('template_title')
    Crear Obra
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Crear Obra') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('obras.store', $presupuesto->id) }}">
                            @csrf
                            <div class="form-group">
                                <label for="presupuesto_id">Presupuesto</label>
                                <input type="text" id="presupuesto_id" class="form-control" value="{{ $presupuesto->id }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="estado">Estado</label>
                                <input type="text" name="estado" id="estado" class="form-control" value="En progreso" disabled>
                            </div>
                            <div class="form-group">
                                <label for="insumos">Insumos</label>
                                <table class="table table-bordered" id="insumos-table">
                                    <thead>
                                        <tr>
                                            <th>Insumo</th>
                                            <th>Cantidad</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($presupuesto->insumos as $insumo)
                                            <tr>
                                                <td>{{ $insumo->nombre }}</td>
                                                <td><input type="number" name="cantidades[]" class="form-control" value="0" min="0" required></td>
                                                <input type="hidden" name="insumos[]" value="{{ $insumo->id }}">
                                                <td><button type="button" class="btn btn-danger btn-sm remove-insumo">Eliminar</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="button" id="add-insumo" class="btn btn-secondary">Agregar Insumo</button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insumoModal">Crear Nuevo Insumo</button>
                            </div>
                            <button type="submit" class="btn btn-primary">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.insumo_modal', ['proovedores' => $proovedores])

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            console.log("Script cargado");

            document.getElementById('add-insumo').addEventListener('click', function () {
                console.log("Botón Agregar Insumo clickeado");

                fetch('{{ route("insumos.list") }}')
                    .then(response => response.json())
                    .then(data => {
                        var insumoOptions = '';
                        data.forEach(insumo => {
                            insumoOptions += `<option value="${insumo.id}">${insumo.nombre}</option>`;
                        });

                        var newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>
                                <select name="insumos[]" class="form-control insumo-select">
                                    ${insumoOptions}
                                </select>
                            </td>
                            <td>
                                <input type="number" name="cantidades[]" class="form-control" min="0" required>
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm remove-insumo">Eliminar</button></td>
                        `;
                        document.getElementById('insumos-table').querySelector('tbody').appendChild(newRow);
                    })
                    .catch(error => console.error('Error:', error));
            });

            document.querySelector('#insumos-table').addEventListener('click', function (e) {
                if (e.target.classList.contains('remove-insumo')) {
                    e.target.closest('tr').remove();
                }
            });

            $('#insumoModal').on('show.bs.modal', function () {
                document.getElementById('insumoForm').reset();
                document.getElementById('proovedor_id').selectedIndex = 0;
            });

            document.getElementById('insumoForm').addEventListener('submit', function (e) {
                e.preventDefault();

                var formData = new FormData(this);

                fetch('{{ route("Insumo.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        var insumo = data.insumo;
                        // Actualizar los selects después de agregar un nuevo insumo
                        updateInsumoSelects();
                        // Inicializar el formulario del modal
                        document.getElementById('insumoForm').reset();
                        // Reiniciar el select del proveedor
                        document.getElementById('proovedor_id').selectedIndex = 0;
                        // Ocultar el modal
                        $('#insumoModal').modal('hide');
                        // Mostrar notificación
                        alert('Insumo agregado exitosamente');
                    } else {
                        alert('Error al agregar el insumo');
                    }
                })
                .catch(error => console.error('Error:', error));
            });

            function updateInsumoSelects() {
                fetch('{{ route("insumos.list") }}')
                    .then(response => response.json())
                    .then(data => {
                        var insumoOptions = '';
                        data.forEach(insumo => {
                            insumoOptions += `<option value="${insumo.id}">${insumo.nombre}</option>`;
                        });
                        document.querySelectorAll('.insumo-select').forEach(select => {
                            select.innerHTML = insumoOptions;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
