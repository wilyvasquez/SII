<div class="modal fade editarSerieFolio" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #4C9DBD; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Editar Serie y Folio</h4>
      </div>
      <form role="form" id="updateSerie">
        <div class="modal-body">
          <div class="box-body">
	      	<div class="form-group">
	        	<label for="mserie">Serie</label>
	        	<input type="text" class="form-control" name="mserie" id="mserie" placeholder="Serie" required>
	        	<input type="hidden" class="form-control" name="ids" id="ids"  required>
	      	</div>
          	<div class="form-group ">
            	<label for="mtcomprobante">Tipo Comprobante</label>
            	<input type="text" class="form-control" name="mtcomprobante" id="mtcomprobante" placeholder="Tipo comprobante" required>
          	</div>
            <div class="row">
		      <div class="form-group col-md-6">
	            <label for="mfinicial">Folio Inicial</label>
	            <input type="number" class="form-control" name="mfinicial" id="mfinicial" placeholder="Folio Inicial" required>
	          </div>
              <div class="form-group col-md-6">
                <label for="mfsiguiente">Folio Siguiente</label>
                <input type="number" class="form-control" name="mfsiguiente" id="mfsiguiente" placeholder="Folio Siguiente" required>
              </div>
            </div>
            <div id="majax-ntf"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>