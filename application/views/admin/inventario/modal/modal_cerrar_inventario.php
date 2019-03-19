<!-- Modal -->
<div class="modal fade" id="cerrarInventario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cerrar Inventario</h4>
      </div>
      <form role="form" id="cerrarInventarioDatos">
        <div class="modal-body">
          <div class="box-body">
          	<div class="form-group">
            	<label for="mproveedor" style="font-weight: normal;">Proveedor</label>
            	<input type="text" class="form-control" id="mproveedor" name="mproveedor" required>
          	</div>
          	<div class="form-group">
            	<label for="mfactura" style="font-weight: normal;">Factura</label>
            	<input type="text" class="form-control" id="mfactura" name="mfactura" required>
          	</div>
            <div id="ntf-cIventario"></div>
          </div>
        </div>
        <div class="modal-footer">
            <label class="switch">
		      <input type="checkbox" class="success" id="activo" name="activo">
		      <span class="slider round"></span>
		    </label>
            <button type="submit" class="btn btn-primary" id="btn-gcotizacion">Generar</button>
        </div>
      </form>
    </div>
  </div>
</div>