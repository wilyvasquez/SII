<div class="modal fade editarSucursal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Sucursal</h4>
      </div>
      <form role="form" id="upSucursal">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="rsocial">Razon Social</label>
                <input type="text" class="form-control" id="rsocial" name="rsocial" placeholder="Razon Social" required>
                <input type="hidden" class="form-control" id="mid" name="mid" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mrfc">RFC</label>
                <input type="text" class="form-control" id="mrfc" name="mrfc" placeholder="RFC" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mcorreo">Correo</label>
                <input type="text" class="form-control" id="mcorreo" name="mcorreo" placeholder="Correo" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mtelefono">Telefono</label>
                <input type="text" class="form-control" id="mtelefono" name="mtelefono" placeholder="Telefono" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mestatus">Estatus</label>
                <input type="text" class="form-control" id="mestatus" name="mestatus" placeholder="Estatus" required>
              </div>
            </div>
            <div id="ajax-ntf"></div>
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