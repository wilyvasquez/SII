<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Agregar Documento - <strong>$ <font id="total">0.00</font></strong></h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" id="agregar_docto">
    <div class="box-body">
      <div class="form-group">
        <label for="uuid" style="font-weight: normal;">Factura (UUID)</label>
        <select class="form-control select2" style="width: 100%;" id="uuid" name="uuid" onchange="valorParcialidad()" data-placeholder="Selecciona" required>
          <option value="">Selecciona</option>
          <?php if (!empty($facturas)) {
          foreach ($facturas ->result() as $articulo) { ?>
            <option value="<?= $articulo->uuid ?>"><?= $articulo->uuid ?></option>
          <?php } } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="parcialidad" style="font-weight: normal;">Parcialidad</label>
        <input type="number" class="form-control" id="parcialidad" name="parcialidad" placeholder="0" min="1" required/>
        <input type="hidden" class="form-control" id="ids" name="ids" value="<?= $id ?>" required>
        <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?= $icliente->id_cliente ?>" required>
      </div>
  	  <div class="form-group">
	      <label for="monto" style="font-weight: normal;">Monto</label>
        <div class="row">
          <div class="col-md-12">
            <div class="input-group">
              <div class="input-group-addon">
                <i class="fa fa-dollar"></i>
              </div>
              <input type="number" class="form-control" id="monto" name="monto" placeholder="0.00" min="1" step="any" required>
            </div>
          </div>          
        </div>  	      
  	  </div> 
      <div id="ntf-rpago"></div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="reset" class="btn btn-default btn-sm" id="btn-limpiar">Nuevo</button>
      <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-articulo">Agregar</button>
    </div>
  </form>
</div>