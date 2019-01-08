<!-- Modal -->
<div class="modal fade timbrar" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar UUID</h4>
      </div>
      <form role="form" id="agregar_uuid">
        <div class="box-body">
          <div class="form-group">
            <label for="uuid" style="font-weight: normal;">UUID</label>
            <input type="hidden" class="form-control" id="ids" name="ids" value="<?= $id ?>" required>
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
              <?php if (!empty($trelacion)) {
              foreach ($trelacion ->result() as $articulo) { ?>
                <option value="<?= $articulo->c_tipoRelacion ?>"><?= $articulo->c_tipoRelacion ?> - <?= $articulo->tipo_relacion ?></option>
              <?php } } ?>
            </select>
          </div>
          <div id="ntf-uuid"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-articulo">Agregar</button>
        </div>
      </form>
    </div>
  </div>
</div>