<div class="modal fade mCancelarCFDI" id="mcancelar" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #EC9E2E; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cancelar CFDI</h4>
      </div>
      <form role="form" id="cancelarCFDI">
        <div class="modal-body">
          <div class="box-body">
          	<p style="text-align: center;">¿ Estas seguro de cancelar este CFDI ?</p>
            <div class="form-group">
              <label for="uuid">UUID del CFDI</label>
              <input type="text" class="form-control" name="uuid" id="uuid" placeholder="UUID del CFDI a cancelar" required>
            </div>
            <div class="form-group">
              <label for="serie">SERIE y FOLIO</label>
              <input type="text" class="form-control" name="serie" id="serie" placeholder="Serie y Folio del CFDI">
              <input type="hidden" class="form-control" name="ids" id="ids" required>
            </div>
            <div id="ntf-cancelar"></div>
          </div>
        </div>
        <div class="modal-footer">
          <label class="switch">
	        <input type="checkbox" class="success" id="activo" name="activo">
	        <span class="slider round"></span>
	      </label>
          <!-- <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button> -->
          <button type="submit" class="btn btn-primary" id="btn-aceptar">Aceptar</button>
        </div>
      </form>
    </div>
  </div>
</div>