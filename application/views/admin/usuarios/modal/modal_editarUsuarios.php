<div class="modal fade editarUsuario" id="editarModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar datos del usuario</h4>
      </div>
      <form role="form" id="upUsuario">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="mnombre" style="font-weight: normal;">Nombre</label>
                <input type="text" class="form-control" id="mnombre" name="mnombre">
                <input type="hidden" id="ids" name="ids">
              </div>
              <div class="form-group col-md-6">
                <label for="mtelefono" style="font-weight: normal;">Telefono</label>
                <input type="text" class="form-control" id="mtelefono" name="mtelefono">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="mcorreo" style="font-weight: normal;">Correo</label>
                <input type="text" class="form-control" id="mcorreo" name="mcorreo">
              </div>
              <div class="form-group col-md-6">
                <label for="mdireccion" style="font-weight: normal;">Direccion</label>
                <input type="text" class="form-control" id="mdireccion" name="mdireccion">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="msucursal" style="font-weight: normal;">Sucursal</label>
                <input type="text" class="form-control" id="msucursal" name="msucursal">
              </div>
              <div class="form-group col-md-6">
                <label for="mestatus" style="font-weight: normal;">Estatus</label>
                <input type="text" class="form-control" id="mestatus" name="mestatus">
              </div>
            </div>
            <div id="ajax-mntf"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" id="btn-actualizar">Actualizar</button>
        </div>
      </form>
    </div>
  </div>
</div>