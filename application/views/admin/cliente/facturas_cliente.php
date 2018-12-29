<div class="active tab-pane" id="activity">
  <!-- Post -->
  <?php if (!empty($ifacturas)) {
  foreach ($ifacturas ->result() as $facturas) { ?>
  <div class="post">
    <div class="user-block">
      <img class="img-circle img-bordered-sm" src="<?= base_url() ?>assets/img/default-50x50.gif" alt="user image">
          <span class="username">
            <a href="#">A - 1548.</a>
            <span class="pull-right-container">
              <small class="label" style="background-color: #29B019; font-size: 9px "><?= $facturas->condicion_pago ?></small>
            </span>
            <a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>
          </span>
      <span class="description">Fecha Timbrado - <?= $facturas->fecha_compra ?></span>
    </div>
    <!-- /.user-block -->
    <p>
      Folio fiscal: <?= $facturas->uuid ?>, se facturo con metodo de pago <?= $facturas->metodo_pago ?>, forma de pago <?= $facturas->forma_pago ?>, uso de CFDI <?= $facturas->uso_cfdi ?>
    </p>
    <ul class="list-inline">
    <li>
      <a href="<?= base_url() ?>descarga/<?= $facturas->uuid ?>.pdf" target="blank" class="link-black text-sm"><i class="fa fa-download margin-r-5"></i> Factura</a>
    </li>
    <li>
      <a href="<?= base_url() ?>xml/<?= $facturas->uuid ?>.xml" target="blank" class="link-black text-sm">
      <i class="fa fa-file-code-o margin-r-5"></i> XML</li></a>
  </div>
  <?php } } ?>
  <!-- /.post -->
</div>