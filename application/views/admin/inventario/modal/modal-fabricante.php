<div class="modal fade addfabricante" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Fabricante</h4>
      </div>
      <div class="modal-body">
        <form role="form">
          <div class="box-body">
            <div class="form-group">
              <label for="fabricante">Fabricante</label>
              <input type="text" class="form-control" id="fabricante" placeholder="Nombre del fabricante">
            </div>
            <div class="form-group">
              <label for="direccion">Direccion</label>
              <input type="text" class="form-control" id="direccion" placeholder="Direccion">
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="marca">Telefono</label>
                <input type="text" class="form-control" id="descripcion" placeholder="Telefono">
              </div>
              <div class="form-group col-md-6">
                <label for="marca">RFC</label>
                <input type="text" class="form-control" id="descripcion" placeholder="RFC">
              </div>
            </div>
            <div class="form-group">
              <label for="marca">Observaciones</label>
              <textarea class="form-control" rows="3" placeholder="Observaciones ..."></textarea>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Actualizar</button>
      </div>

    </div>
  </div>
</div>