<div class="modal fade addcliente" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header" style="background: #4C9DBD; color: white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Agregar Nuevo Cliente</h4>
      </div>
      <div class="modal-body">
        <form role="form" id="addcliente">
          <div class="box-body">
            <div class="form-group">
              <label for="cliente">Nombre del cliente</label>
              <input type="text" class="form-control" name="cliente" placeholder="Nombre del cliente" required>
            </div>
            <div class="form-group">
              <label for="direccion">Direccion</label>
              <input type="text" class="form-control" name="direccion" placeholder="Direccion" required>
            </div>
            <div class="row">
              <div class="form-group col-md-6">
                <label for="telefono">Telefono</label>
                <input type="text" class="form-control" name="telefono" placeholder="Telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
              </div>
              <div class="form-group col-md-6">
                <label for="correo">Correo</label>
                <input type="email" class="form-control" name="correo" placeholder="Correo" required>
              </div>
              <div class="form-group col-md-6">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control" name="rfc" placeholder="RFC" minlength="12" required>
              </div>
              <div class="form-group col-md-6">
                <label for="ucfdi">USO del CFDI</label>
                <select class="form-control select2" style="width: 100%;" name="ucfdi">
                  <?php if (!empty($ucfdis)) {
                    foreach ($ucfdis ->result() as $ucfdi) { ?>
                      <option value="<?= $ucfdi->c_usoCFDI ?>"><?= $ucfdi->c_usoCFDI ?> <?= $ucfdi->uso_cfdi ?> </option>
                  <?php } } ?>
                </select>
              </div>
            </div>
            <input type="hidden" class="form-control" name="ref" value="0">
            <div id="add-cliente"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </div>
        </form>
      </div>

    </div>
  </div>
</div>