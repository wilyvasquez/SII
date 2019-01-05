<div class="form-group">
  	<label for="cfdi_r" class="col-sm-4 control-label" style="font-weight: normal;"><font color="red">*</font> CFDI a relacionar</label>

  	<div class="col-sm-8">
    <select class="form-control select2 input-sm" style="width: 100%;" id="cfdi_r" data-placeholder="Selecciona" required>
	  	<option value="">Selecciona</option>
		<?php if (!empty($factura)) {
		foreach ($factura ->result() as $facturas) { ?>
			<option value="<?= $facturas->uuid ?>"><?= $facturas->uuid ?></option>
		<?php } } ?>
	</select>
  	</div>
</div>
<div class="form-group">
	<label for="trelacion" class="col-sm-4 control-label" style="font-weight: normal;"><font color="red">*</font> Tipo de relacion</label>

	<div class="col-sm-8">
	<select class="form-control select2 input-sm" style="width: 100%;" id="trelacion" data-placeholder="Selecciona" required>
	  <option value="">Selecciona</option>
	  <?php if (!empty($relacion)) {
	  foreach ($relacion ->result() as $trelacion) { ?>
		<option value="<?= $trelacion->c_tipoRelacion ?>"><?= $trelacion->c_tipoRelacion ?> <?= $trelacion->tipo_relacion ?></option>
	  <?php } } ?>
	</select>
	</div>
</div> 
<script type="text/javascript">
	$('.select2').select2()
</script>