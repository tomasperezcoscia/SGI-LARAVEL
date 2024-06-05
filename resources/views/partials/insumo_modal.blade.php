<div class="modal fade" id="insumoModal" tabindex="-1" role="dialog" aria-labelledby="insumoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insumoModalLabel">Agregar Insumo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insumoForm">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo">Tipo</label>
                        <input type="text" name="tipo" id="tipo" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="precio">Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="inventario">Inventario</label>
                        <input type="number" name="inventario" id="inventario" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="proovedor_id">Proveedor</label>
                        <select name="proovedor_id" id="proovedor_id" class="form-control" required>
                            <option value="" selected disabled>Seleccione un proveedor</option>
                            @foreach ($proovedores as $proovedore)
                                <option value="{{ $proovedore->id }}">{{ $proovedore->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Agregar Insumo</button>
                </form>
            </div>
        </div>
    </div>
</div>
