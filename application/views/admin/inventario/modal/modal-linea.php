<div class="modal fade addlinea" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Linea</h4>
      </div>
      <form role="form" id="addlinea">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="linea">Linea</label>
                <input type="text" class="form-control" name="linea" placeholder="Nombre de la linea" required>
              </div>
              <div class="form-group col-md-6">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" placeholder="Nombre" required>
              </div>
            </div>
            <div class="form-group">
              <label for="observaciones">Observaciones</label>
              <textarea class="form-control" rows="3" name="observaciones" placeholder="Observaciones ..."></textarea>
            </div>
            <div id="ntf-linea"></div>
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