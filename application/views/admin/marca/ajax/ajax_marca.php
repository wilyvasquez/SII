<select class="form-control select2" style="width: 100%;" name="marca" data-placeholder="Selecciona" required>
	<option value="">Selecciona</option>
	<?php if (!empty($marcas)) {
	  foreach ($marcas ->result() as $marca) { ?>
	  <option value="<?= $marca->id_marca ?>"><?= $marca->marca ?> - <?= $marca->nombre ?></option>
	<?php } } ?>
</select>
<script type="text/javascript">
	$('.select2').select2()
</script>