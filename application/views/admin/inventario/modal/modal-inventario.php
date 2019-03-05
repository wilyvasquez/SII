<div class="modal fade editarInventario" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Articulo</h4>
      </div>
      <form role="form" id="upInventario">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="marticulo">Articulo</label>
                <input type="text" class="form-control" id="marticulo" name="marticulo" placeholder="Articulo" required>
                <input type="hidden" class="form-control" id="mid" name="mid" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mcodigo">Codigo</label>
                <input type="text" class="form-control" id="mcodigo" name="mcodigo" placeholder="Codigo" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mcantidad">Cantidad</label>
                <input type="text" class="form-control" id="mcantidad" name="mcantidad" placeholder="Cantidad" required>
              </div>
              <div class="form-group col-md-6">
                <label for="mcosto">Costo</label>
                <input type="text" class="form-control" id="mcosto" name="mcosto" placeholder="Costo" required>
              </div>
              <div class="form-group col-md-6">
                <label for="msat">Clave SAT</label>
                <input type="text" class="form-control" id="msat" name="msat" placeholder="Clave SAT" required>
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