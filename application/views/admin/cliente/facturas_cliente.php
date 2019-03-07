<div class="active tab-pane" id="activity">
  <?php if (!empty($ifacturas)) {
  foreach ($ifacturas ->result() as $facturas) { 
    $cpagos = $this->Modelo_timbrado->get_comprobantesPagoTotal($facturas->id_factura);
  ?>
  <div class="post">
    <div class="user-block">
      <img class="img-circle img-bordered-sm" src="<?= base_url() ?>assets/img/default-50x50.gif" alt="user image">
          <span class="username">
            <a href="#"><?= $facturas->serie ?><?= $facturas->folio ?>.</a>
            <span class="pull-right-container">
              <?php if ($facturas->tipo_comprobante == "I") {
                $tipo = "INGRESO";
                $color = "#29B019";
              }if ($facturas->tipo_comprobante == "E"){
                $tipo = "EGRESO";
                $color = "#BB3C3C";
              }if ($facturas->tipo_comprobante == "P"){
                $tipo = "COMPLEMENTO DE PAGO";
                $color = "#3CACBB";
              }?>
              <small class="label" style="background-color: <?= $color ?>; font-size: 9px "><?= $tipo ?></small>
            </span>
          </span>
      <span class="description">Fecha Timbrado - <?= $facturas->fecha_timbrado ?></span>
    </div>
    <p>
      Folio fiscal: <?= $facturas->uuid ?>, se facturo con metodo de pago <?= $facturas->metodo_pago ?>, forma de pago <?= $facturas->forma_pago ?>, uso de CFDI <?= $facturas->uso_cfdi ?>
    </p>
    <ul class="list-inline">
    <li>
      <a href="<?= base_url() ?>descarga/<?= $facturas->uuid ?>.pdf" target="blank" class="link-black text-sm"><i class="fa fa-download margin-r-5"></i> Factura</a>
    </li>
    <li>
      <a href="<?= base_url() ?>xml/<?= $facturas->uuid ?>.xml" target="blank" class="link-black text-sm">
      <i class="fa fa-file-code-o margin-r-5"></i> XML</a>
    </li><br><br>
    <?php 
    if (!empty($cpagos)) {
    foreach ($cpagos ->result() as $pagos) {
      $tipo = "COMPLEMENTO";
      $color = "#3CACBB";
      if ($pagos->tipo_comprobante == "E") {
        $tipo = "EGRESO";
        $color = "#BB3C3C";
      }
    ?>
      <ul style="margin-left: 20px">
        <li>
          <a href="<?= base_url() ?>descarga/<?= $pagos->uuid ?>.pdf" target="blank" class="link-black text-sm" style="margin-right: 20px"><i class="fa fa-download margin-r-5"></i> Factura </a>
          <a href="<?= base_url() ?>xml/<?= $pagos->uuid ?>.xml" target="blank" class="link-black text-sm">
            <i class="fa fa-file-code-o margin-r-5"></i> XML 
            <small class="label" style="background-color: <?= $color ?>; font-size: 9px "><?= $tipo ?></small>
            - <?= $pagos->uuid ?> <strong>(<?= $pagos->fecha_timbrado ?>)</strong>
          </a>
        </li>
        <br>
      </ul>
    <?php } } ?>
  </div>
  <?php } } ?>
</div>