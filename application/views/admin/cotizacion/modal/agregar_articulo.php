<div class="modal fade agregarArticulo" id="editarModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Articulo</h4>
      </div>
      <form role="form" id="addCotizacion">
        <div class="modal-body">
          <div class="box-body">
          	<div class="form-group">
            	<label for="marticulo" style="font-weight: normal;">Articulo</label>
            	<input type="text" class="form-control" id="marticulo" name="marticulo" onfocus = 'this.blur()'>
            	<input type="hidden" id="mid" name="mid" required>
          	</div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="mcodigo" style="font-weight: normal;">Codigo</label>
                <input type="text" class="form-control" id="mcodigo" name="mcodigo" onfocus = 'this.blur()'>
              </div>
	          <div class="form-group col-md-6">
	            <label for="mcantidad" style="font-weight: normal;">Cantidad</label>                
	            <input type="text" class="form-control" id="mcantidad" name="mcantidad">
	          </div>
            </div>
            <div class="form-group">
              <label for="mcosto" style="font-weight: normal;">Costo</label>
              <input type="text" class="form-control" id="mcosto" name="mcosto" onfocus = 'this.blur()'>
            </div>
            <div id="ntf-cotizacion"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary" id="btn-actualizar">Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>