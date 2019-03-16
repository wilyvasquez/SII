<div class="modal fade agregarCotizacion" id="editarModal" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #3C8DBC; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar articulos de la cotizacion</h4>
      </div>
      <form role="form" id="agregarCotizacionF">
        <div class="modal-body">
          <div class="box-body">
            <div class="row">
              <div class="form-group col-md-6">
                <label for="cantidad" style="font-weight: normal;">Cotizacion</label>
                <select class="form-control select2" style="width: 100%;" id="cotizaciones" onchange="viewCotizacion()" data-placeholder="Selecciona" required>
                	<option value="">Selecciona</option>
                	<?php if (!empty($cotizacion)) {
      				foreach ($cotizacion ->result() as $resul) { ?>
                		<option value="<?= $resul->id_dcotizacion ?>"><?= $resul->num_cotizacion ?></option>
                	<?php } } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="cliente" style="font-weight: normal;">Cliente</label>
                <input type="text" class="form-control" id="cliente" name="cliente" required>
                <input type="hidden" name="midc" id="midc">
                <input type="hidden" name="factura" id="factura" value="<?= $id ?>">
              </div>
            </div>
            <div class="row">
	            <div class="form-group col-md-6">
	                <label for="telefono" style="font-weight: normal;">Telefono</label>
	                <input type="text" class="form-control" id="telefono" name="telefono" required>
	            </div>
	            <div class="form-group col-md-6">
	              <label for="fecha" style="font-weight: normal;">Fecha</label>
	              <input type="text" class="form-control" id="fecha" name="fecha" required>
	            </div>            	
            </div>
            <div id="ntf-datos"></div>
          </div>
        </div>
        <div class="modal-footer">
          <label class="switch" style="margin-top: 6px">
	        <input type="checkbox" class="success" id="activo" name="activo">
	        <span class="slider round"></span>
	      </label>
          <button type="submit" class="btn btn-primary" id="btn-actualizar">Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>