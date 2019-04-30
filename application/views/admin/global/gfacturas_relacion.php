<div class="row">
	<div class="col-md-12">    
		<div class="box box-primary">
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
				            <a href="<?= base_url() ?>dfactura/<?= $facturas->id_factura ?>">CFDI : <?= $facturas->serie ?> - <?= $facturas->folio ?>.</a>
				            <?php 
				              $precio = $this->funciones->saldoRestanteCliente($facturas->uuid);
				            ?>
				            <font class="pull-right sizeF">$ <?= number_format($precio,2) ?></font>
				            <span class="pull-right-container">
				            <?php 
				            	$datos = $this->funciones->tipo_comprobante2($facturas->tipo_comprobante,$facturas->status_factura);
				            ?>
			              	<small class="label sizeFont" style="background-color: <?= $datos[1] ?>"><?= $datos[0] ?></small>
			              	<small class="label sizeFont" style="background-color: #EC933F"><?= $facturas->condicion_pago ?></small>
			              	<small class="label sizeFont" style="background-color: <?= $datos[2] ?>"><?= $facturas->status_factura ?></small>
				            </span>
				          </span>
				      <span class="description">Fecha Timbrado - <?= $facturas->fecha_timbrado ?></span>
				    </div>
				    <p>
				      Folio fiscal: <strong><?= $facturas->uuid ?></strong>, se facturo con metodo de pago <?= $facturas->metodo_pago ?>, forma de pago <?= $facturas->forma_pago ?>, uso de CFDI <?= $facturas->uso_cfdi ?>
				    </p>
				    <ul class="list-inline" style="margin-left: 5px">
					    <li>
					      <!-- <a href="<?= base_url() ?>descarga/<?= $facturas->uuid ?>.pdf" target="blank" class="link-black text-sm"><i class="fa fa-download margin-r-5"></i> Factura</a> -->
					      <a href="<?= $facturas->pdf ?>" target="blank" class="link-black text-sm">
					      	<i class="fa fa-download margin-r-5"></i> Factura
					      </a>
					    </li>
					    <li>
					      <!-- <a href="<?= base_url() ?>xml/<?= $facturas->uuid ?>.xml" target="blank" class="link-black text-sm">
					      <i class="fa fa-file-code-o margin-r-5"></i> XML</a> -->
					      <a href="<?= $facturas->xml ?>" target="blank" class="link-black text-sm">
					      <i class="fa fa-file-code-o margin-r-5"></i> XML</a>
					    </li>
					</ul>
				    <?php 
				    if (!empty($cpagos)) {
				    foreach ($cpagos ->result() as $pagos) {
				      $datos = $this->funciones->tipo_comprobante2($pagos->tipo_comprobante,$facturas->status_factura);
				    ?>
				      <ol class="sizeFo">
				        <li>
				          <!-- <a href="<?= base_url() ?>descarga/<?= $pagos->uuid ?>.pdf" target="blank" class="link-black text-sm" style="margin-right: 20px"><i class="fa fa-download margin-r-5"></i> Factura </a> -->
				          <a href="<?= $pagos->pdf ?>" target="blank" class="link-black text-sm">
				          	<i class="fa fa-download margin-r-5"></i> Factura 
				          </a>
				          <!-- <a href="<?= base_url() ?>xml/<?= $pagos->uuid ?>.xml" target="blank" class="link-black text-sm">
				            <i class="fa fa-file-code-o margin-r-5"></i> XML 
				            <small class="label" style="background-color: <?= $color ?>; font-size: 9px "><?= $tipo ?></small>
				            - <?= $pagos->uuid ?> <strong>(<?= $pagos->fecha_timbrado ?>)</strong>
				          </a> -->
				          <a href="<?= $pagos->xml ?>" target="blank" class="link-black text-sm" style="margin-left: 10px">
				            <i class="fa fa-file-code-o margin-r-5"></i> XML             
				          </a>
				          <font class="sizeF">
				            <small class="label sizeFont" style="background-color: <?= $datos[1] ?>"><?= $datos[0] ?></small>
				            <small class="label sizeFont" style="background-color: <?= $datos[2] ?>"><?= $pagos->status_factura ?></small>
				            - <?= $pagos->uuid ?> <strong>(<?= $pagos->fecha_timbrado ?>)</strong>
				          </font>
				        </li>
				      </ol>
				    <?php } } ?>
				  </div>
				  <?php } } ?>
				</div>
            </div>
		</div>
	</div>
</div>