@extends('layouts.app')

@section('template_title')
    Presupuestos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>{{ __('Presupuestos') }}</span>
                        <a href="{{ route('presupuestos.create') }}" class="btn btn-primary">Crear Presupuesto</a>
                    </div>
                    <div class="card-body">
                        <div class="form-row mb-4">
                            <div class="col">
                                <input type="text" id="search" class="form-control" placeholder="Buscar...">
                            </div>
                            <div class="col">
                                <select id="estado" class="form-control">
                                    <option value="">Todos los estados</option>
                                    <option value="presupuestado">Presupuestado</option>
                                    <option value="in_progress">En progreso</option>
                                    <option value="en_espera_de_pago">En espera de pago</option>
                                </select>
                            </div>
                        </div>
                        <div id="presupuestos-container">
                            @include('presupuestos.partials.presupuestos-table', ['presupuestos' => $presupuestos])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const estadoSelect = document.getElementById('estado');

            searchInput.addEventListener('input', function () {
                fetchPresupuestos();
            });

            estadoSelect.addEventListener('change', function () {
                fetchPresupuestos();
            });

            function fetchPresupuestos() {
                const query = searchInput.value;
                const estado = estadoSelect.value;

                fetch(`{{ route('presupuestos.index') }}?search=${query}&estado=${estado}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    document.getElementById('presupuestos-container').innerHTML = html;
                })
                .catch(error => console.error('Error:', error));
            }
        });
    </script>
@endsection
