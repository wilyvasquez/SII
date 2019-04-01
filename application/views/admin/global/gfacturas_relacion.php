<div class="row">
	<div class="col-md-12">    
		<div class="box box-primary">
			<!-- <div class="box-header with-border">
              <h3 class="box-title">Documentos Timbrados</h3>
            </div> -->
            <div class="box-body">
            	<div class="active tab-pane" id="activity">
				  <?php if (!empty($ifacturas)) {
				  foreach ($ifacturas ->result() as $facturas) { 
				    $cpagos = $this->Modelo_timbrado->get_comprobantesPagoTotal($facturas->id_factura);
				  ?>
				  <div class="post">
				    <div class="user-block">
				      <img class="img-circle img-bordered-sm" src="<?= base_url() ?>assets/img/default-50x50.gif" alt="user image">
				          <span class="username">
				            <a href="<?= base_url() ?>dfactura/<?= $facturas->id_factura ?>"><?= $facturas->serie ?> - <?= $facturas->folio ?>.</a>
				            <?php 
				              $precio = $this->funciones->saldoRestanteCliente($facturas->uuid);
				            ?>
				            <a href="#" class="pull-right btn-box-tool">$ <?= number_format($precio,2) ?></a>
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
				              <small class="label" style="background-color: #EC933F; font-size: 9px "><?= $facturas->condicion_pago ?></small>
				            </span>
				          </span>
				      <span class="description">Fecha Timbrado - <?= $facturas->fecha_timbrado ?></span>
				    </div>
				    <p>
				      Folio fiscal: <strong><?= $facturas->uuid ?></strong>, se facturo con metodo de pago <?= $facturas->metodo_pago ?>, forma de pago <?= $facturas->forma_pago ?>, uso de CFDI <?= $facturas->uso_cfdi ?>
				    </p>
				    <ul class="list-inline">
				    <li>
				      <!-- <a href="<?= base_url() ?>descarga/<?= $facturas->uuid ?>.pdf" target="blank" class="link-black text-sm"><i class="fa fa-download margin-r-5"></i> Factura</a> -->
				      <a href="<?= $facturas->pdf ?>" target="blank" class="link-black text-sm"><i class="fa fa-download margin-r-5"></i> Factura</a>
				    </li>
				    <li>
				      <!-- <a href="<?= base_url() ?>xml/<?= $facturas->uuid ?>.xml" target="blank" class="link-black text-sm">
				      <i class="fa fa-file-code-o margin-r-5"></i> XML</a> -->
				      <a href="<?= $facturas->xml ?>" target="blank" class="link-black text-sm">
				      <i class="fa fa-file-code-o margin-r-5"></i> XML</a>
				    </li>
				    <?php 
				    if (!empty($cpagos)) { ?>
				    <br><br>
				    <?php 
				    foreach ($cpagos ->result() as $pagos) {
				      $tipo = "COMPLEMENTO";
				      $color = "#3CACBB";
				      if ($pagos->tipo_comprobante == "E") {
				        $tipo = "EGRESO";
				        $color = "#BB3C3C";
				      }
				      if ($pagos->tipo_comprobante == "I") {
				        $tipo = "INGRESO";
				        $color = "#29B019";
				      }
				    ?>
				      <ul style="margin-left: 20px">
				        <li>
				          <!-- <a href="<?= base_url() ?>descarga/<?= $pagos->uuid ?>.pdf" target="blank" class="link-black text-sm" style="margin-right: 20px"><i class="fa fa-download margin-r-5"></i> Factura </a> -->
				          <a href="<?= $pagos->pdf ?>" target="blank" class="link-black text-sm" style="margin-right: 20px"><i class="fa fa-download margin-r-5"></i> Factura </a>
				          <!-- <a href="<?= base_url() ?>xml/<?= $pagos->uuid ?>.xml" target="blank" class="link-black text-sm">
				            <i class="fa fa-file-code-o margin-r-5"></i> XML 
				            <small class="label" style="background-color: <?= $color ?>; font-size: 9px "><?= $tipo ?></small>
				            - <?= $pagos->uuid ?> <strong>(<?= $pagos->fecha_timbrado ?>)</strong>
				          </a> -->
				          <a href="<?= $pagos->xml ?>" target="blank" class="link-black text-sm">
				            <i class="fa fa-file-code-o margin-r-5"></i> XML             
				          </a>
				          <font style="margin-left: 15px">
				            <small class="label" style="background-color: <?= $color ?>; font-size: 9px "><?= $tipo ?></small>
				            - <?= $pagos->uuid ?> <strong>(<?= $pagos->fecha_timbrado ?>)</strong>
				          </font>
				        </li>
				        <!-- <br> -->
				      </ul>
				    <?php } } ?>
				  </div>
				  <?php } } ?>
				</div>
            </div>
		</div>
	</div>
</div>