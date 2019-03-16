<div class="modal fade crearCotizacion" id="editarModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Generar Cotizacion</h4>
      </div>
      <form role="form" id="generarCotizacion">
        <div class="modal-body">
          <div class="box-body">
          	<div class="form-group">
            	<label for="cliente" style="font-weight: normal;">Nombre Cliente</label>
            	<input type="text" class="form-control" id="cliente" name="cliente" required>
          	</div>
          	<div class="form-group ">
            	<label for="telefono" style="font-weight: normal;">Telefono</label>
            	<input type="text" class="form-control" id="telefono" name="telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
          	</div>
            <div id="ntf-dcotizaciones"></div>
          </div>
        </div>
        <div class="modal-footer">
          <label class="switch">
		      <input type="checkbox" class="success" id="activo" name="activo">
		      <span class="slider round"></span>
		    </label>
          <button type="submit" class="btn btn-primary" id="btn-actualizar">Generar</button>
        </div>
      </form>
    </div>
  </div>
</div>