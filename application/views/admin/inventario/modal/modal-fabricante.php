<div class="modal fade addfabricante" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Fabricante</h4>
      </div>
      <form role="form" id="addfabricante">
        <div class="modal-body">
          <div class="box-body">
            <div class="form-group">
              <label for="fabricante">Fabricante</label>
              <input type="text" class="form-control" name="fabricante" placeholder="Nombre del fabricante" required>
            </div>
            <div class="form-group">
              <label for="direccion">Direccion</label>
              <input type="text" class="form-control" name="direccion" placeholder="Direccion" required>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" name="telefono" placeholder="Telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
              </div>
              <div class="form-group col-md-6">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control" name="rfc" placeholder="RFC" required>
              </div>
            </div>
            <div class="form-group">
              <label for="observaciones">Observaciones</label>
              <textarea class="form-control" rows="3" name="observaciones" placeholder="Observaciones ..."></textarea>
            </div>
            <div id="ntf-fabricante"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>