<select class="form-control select2" style="width: 100%;" name="linea" data-placeholder="Selecciona" required>
	<option value="">Selecciona</option>
	<?php if (!empty($lineas)) {
	  foreach ($lineas ->result() as $linea) { ?>
	  <option value="<?= $linea->id_linea ?>"><?= $linea->linea ?> - <?= $linea->nombre ?></option>
	<?php } } ?>
</select>
<script type="text/javascript">
	$('.select2').select2()
</script>