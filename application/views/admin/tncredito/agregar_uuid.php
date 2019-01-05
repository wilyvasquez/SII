<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Agregar UUID</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" id="agregar_uuid">
    <div class="box-body">
      <div class="form-group">
        <label for="uuid" style="font-weight: normal;">UUID</label>
        <select class="form-control select2" style="width: 100%;" id="uuid" name="uuid" data-placeholder="Selecciona" required>
            <option value="">Selecciona</option>
          <?php if (!empty($facturas)) {
          foreach ($facturas ->result() as $articulo) { ?>
            <option value="<?= $articulo->uuid ?>"><?= $articulo->uuid ?></option>
          <?php } } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="relacion" style="font-weight: normal;">Tipo relacion</label>
        <select class="form-control select2" style="width: 100%;" id="relacion" name="relacion" data-placeholder="Selecciona" required>
            <option value="">Selecciona</option>
          <?php if (!empty($relacion)) {
          foreach ($relacion ->result() as $articulo) { ?>
            <option value="<?= $articulo->c_tipoRelacion ?>"><?= $articulo->c_tipoRelacion ?> - <?= $articulo->tipo_relacion ?></option>
          <?php } } ?>
        </select>
      </div>
      <div class="form-group">
        <label for="unitario" style="font-weight: normal;">Valor Unitario</label>
        <input type="number" class="form-control" id="unitario" name="unitario" placeholder="0.00" min="1" required step="any">
        <input type="hidden" class="form-control" id="ids" name="ids" value="<?= $id ?>" required>
        <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?= $icliente->id_cliente ?>" required>
      </div>   
      <div class="form-group">
        <label for="descripcion" style="font-weight: normal;">Descripción del producto o servicio</label>
        <textarea class="form-control" rows="3" placeholder="Descripcion ..." id="descripcion" name="descripcion" required></textarea>
      </div> 
      <div id="ntf-cliente">
        
      </div>
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="reset" class="btn btn-default btn-sm" id="btn-limpiar">Nuevo</button>
      <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-articulo">Agregar</button>
    </div>
  </form>
</div>