<div class="modal fade addarticulo" id="editarModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar datos del Articulo</h4>
      </div>
      <form role="form" id="editarArticulo">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="cantidad" style="font-weight: normal;">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" name="cantidad" min="1">
                <input type="hidden" id="articulo" name="articulo" required>
                <input type="hidden" id="costo" name="costo" required>
                <input type="hidden" id="idArticulo" name="idArticulo" required>
              </div>
              <div class="form-group col-md-6">
                <label for="codigo" style="font-weight: normal;">Codigo</label>
                <input type="text" class="form-control" id="codigo" name="codigo" disabled>
              </div>
            </div>
            <div class="form-group">
              <label for="descuento" style="font-weight: normal;">Descuento <strong>(Cantidad en pesos)</strong></label>                
              <div class="row">
                <div class="col-md-12">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-dollar"></i>
                    </div>
                    <input type="number" class="form-control" id="descuento" name="descuento" min="0" step="any">
                  </div>
                </div>          
              </div>
            </div>
            <div class="form-group">
              <label for="descripcion" style="font-weight: normal;">Descripcion</label>
              <textarea class="form-control" rows="3" name="descripcion" id="descripcion" placeholder="Descripcion ..."></textarea>
            </div>
            <div id="editado">
              
            </div>
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