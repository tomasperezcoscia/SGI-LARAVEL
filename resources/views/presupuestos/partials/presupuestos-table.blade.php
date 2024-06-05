<table class="table table-bordered">
    <thead>
        <tr>
            <th>Cliente</th>
            <th>Nro Orden</th>
            <th>Tarea</th>
            <th>Estado</th>
            <th>Número de Legajo</th>
            <th>Obra Asociada</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($presupuestos as $presupuesto)
            <tr>
                <td>{{ optional(optional($presupuesto->ordenDeCompra)->cliente)->nombre ?? 'N/A' }}</td>
                <td>{{ optional($presupuesto->ordenDeCompra)->numeroOrdenInterna ?? 'N/A' }}</td>
                <td>{{ optional($presupuesto->ordenDeCompra)->descripcionTarea ?? 'N/A' }}</td>
                <td>{{ ucwords(str_replace('_', ' ', $presupuesto->estado)) }}</td>
                <td>{{ $presupuesto->numero_legajo }}</td>
                <td>
                    @if ($presupuesto->obra)
                        <a href="{{ route('obras.edit', $presupuesto->obra->id) }}" class="btn btn-info btn-sm">Editar Obra</a>
                    @else
                        No asignada
                    @endif
                </td>
                <td>
                    <a href="{{ route('presupuestos.show', $presupuesto->id) }}" class="btn btn-primary btn-sm">Mostrar</a>
                    @if ($presupuesto->estado != 'in_progress')
                        <a href="{{ route('presupuestos.edit', $presupuesto->id) }}" class="btn btn-success btn-sm">Editar</a>
                    @endif
                    <form action="{{ route('presupuestos.destroy', $presupuesto->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                    @if (!$presupuesto->obra && $presupuesto->estado == 'in_progress')
                        <a href="{{ route('obras.create', ['presupuesto_id' => $presupuesto->id]) }}" class="btn btn-secondary btn-sm">Crear Obra</a>
                    @endif
                    @if ($presupuesto->obra)
                        <a href="{{ route('presupuestos.compare', $presupuesto->id) }}" class="btn btn-warning btn-sm">Comparar</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $presupuestos->links() }}
