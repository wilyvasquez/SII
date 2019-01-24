<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Informacion del Cliente</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <div class="form-horizontal">
    <div class="box-body">
      <div class="form-group">
        <label for="cliente" class="col-md-4 col-sm-4 control-label" style="font-weight: normal;">Nombre del cliente: </label>
        <div class="col-md-8 col-sm-8">
          <div id="ajax-cliente">
            <select class="form-control select2 input-sm" style="width: 100%;" id="cliente" name="cliente" data-placeholder="Selecciona" required>
              <option value="">Selecciona</option>
              <?php if (!empty($clientes)) {
              foreach ($clientes ->result() as $cliente) { ?>
                <option value="<?= $cliente->id_cliente ?>"><?= $cliente->cliente ?></option>
              <?php } } ?>
            </select>
          </div>
          <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".addcliente"><i class="fa fa-plus"></i> Registrar nuevo cliente</button>
        </div>
      </div>
      <div class="form-group">
        <label for="forma" class="col-sm-4 control-label" style="font-weight: normal; ">Forma de pago: </label>
        <div class="col-sm-8">
          <select class="form-control select2 input-sm" style="width: 100%;" id="forma" name="forma" data-placeholder="Selecciona" required>
            <option value="">Selecciona</option>
              <?php if (!empty($fpagos)) {
              foreach ($fpagos ->result() as $fpago) { ?>
                <option value="<?= $fpago->forma ?>"><?= $fpago->forma ?> <?= $fpago->c_formaPago ?> </option>
              <?php } } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="metodo" class="col-sm-4 control-label" style="font-weight: normal; ">Metodo de pago: </label>
        <div class="col-sm-8">
          <select class="form-control select2 input-sm" style="width: 100%;" id="metodo" name="metodo" data-placeholder="Selecciona" required>
            <option value="">Selecciona</option>
              <?php if (!empty($mpagos)) {
              foreach ($mpagos ->result() as $mpago) { ?>
                <option value="<?= $mpago->c_metodoPago ?>"><?= $mpago->c_metodoPago ?> <?= $mpago->metodo ?> </option>
              <?php } } ?>
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="cfdi" class="col-md-4 col-sm-4 control-label" style="font-weight: normal;">Uso del CFDI</label>
        <div class="col-md-8 col-sm-8">
          <select class="form-control select2 input-sm" style="width: 100%;" id="cfdi" name="cfdi" data-placeholder="Selecciona" required>
            <option value="">Selecciona</option>
              <?php if (!empty($ucfdis)) {
              foreach ($ucfdis ->result() as $ucfdi) { ?>
                <option value="<?= $ucfdi->c_usoCFDI ?>"><?= $ucfdi->c_usoCFDI ?> <?= $ucfdi->uso_cfdi ?> </option>
              <?php } } ?>
          </select>
        </div>
      </div>
    </div>
    <div class="box-footer" id="ntf-cliente">
      <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-generar">Generar <?= $title ?></button>
    </div>
  </div>
</div>