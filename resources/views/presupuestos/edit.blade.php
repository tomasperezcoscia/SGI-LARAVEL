@extends('layouts.app')

@section('template_title')
    Editar Presupuesto
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Presupuesto') }}</div>
                    <div class="card-body">
                        @if ($presupuesto->estado == 'in_progress')
                            <p>No se puede editar un presupuesto en progreso.</p>
                            <a href="{{ route('presupuestos.index') }}" class="btn btn-primary">Volver</a>
                        @else
                            <form method="POST" action="{{ route('presupuestos.update', $presupuesto->id) }}">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label for="orden_de_compra_id">Orden de Compra</label>
                                    <select name="orden_de_compra_id" id="orden_de_compra_id" class="form-control">
                                        <option value="" disabled>Seleccione una orden de compra</option>
                                        @foreach ($ordenesDeCompra as $ordenDeCompra)
                                            <option value="{{ $ordenDeCompra->id }}" {{ $presupuesto->orden_de_compra_id == $ordenDeCompra->id ? 'selected' : '' }}>
                                                {{ $ordenDeCompra->cliente->nombre }} | {{ $ordenDeCompra->numeroOrdenInterna }} | {{ $ordenDeCompra->descripcionTarea }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select name="estado" id="estado" class="form-control">
                                        <option value="" disabled>Seleccione un estado</option>
                                        <option value="in_progress" {{ $presupuesto->estado == 'in_progress' ? 'selected' : '' }}>En progreso</option>
                                        <option value="presupuestado" {{ $presupuesto->estado == 'presupuestado' ? 'selected' : '' }}>Presupuestado</option>
                                        <option value="en_espera_de_pago" {{ $presupuesto->estado == 'en_espera_de_pago' ? 'selected' : '' }}>En espera de pago</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="numero_legajo">Número de Legajo</label>
                                    <input type="text" name="numero_legajo" id="numero_legajo" class="form-control" value="{{ $presupuesto->numero_legajo }}" required>
                                </div>
                                <div class="form-group">
                                    @include('partials.insumos_presupuesto', ['insumos' => $insumos, 'presupuesto' => $presupuesto])
                                </div>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#insumoModal">Agregar Insumo Nuevo</button>
                            </form>
                        @endif
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

                var newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>
                        <select name="insumos[]" class="form-control">
                            @foreach ($insumos as $insumo)
                                <option value="{{ $insumo->id }}">{{ $insumo->nombre }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input type="number" name="cantidades[]" class="form-control" required>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-insumo">Eliminar</button>
                    </td>
                `;
                document.getElementById('insumos-table-body').appendChild(newRow);
            });

            document.querySelector('#insumos-table-body').addEventListener('click', function (e) {
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
                        var newOption = new Option(insumo.nombre, insumo.id, false, false);
                        document.querySelectorAll('select[name="insumos[]"]').forEach(select => {
                            select.appendChild(newOption.cloneNode(true));
                        });

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
        });
    </script>
@endsection
