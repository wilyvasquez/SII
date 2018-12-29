<div class="modal fade addmarca" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar una Marca</h4>
      </div>
      <form role="form" id="addmarca">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="fabricante">Marca</label>
                <input type="text" class="form-control" id="fabricante" placeholder="Marca" required>
              </div>
              <div class="form-group col-md-6">
                <label for="direccion">Nombre</label>
                <input type="text" class="form-control" id="direccion" placeholder="Nombre" required="">
              </div>
            </div>
            <div class="form-group">
              <label for="marca">Observaciones</label>
              <textarea class="form-control" rows="3" placeholder="Observaciones ..."></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>