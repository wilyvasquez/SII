<select class="form-control select2" style="width: 100%;" name="linea" data-placeholder="Selecciona" required>
	<option value="">Selecciona</option>
	<?php if (!empty($fabricantes)) {
	  foreach ($fabricantes ->result() as $fabricante) { ?>
	  <option value="<?= $fabricante->id_fabricante ?>"><?= $fabricante->fabricante ?> - <?= $fabricante->rfc ?></option>
	<?php } } ?>
</select>
<script type="text/javascript">
	$('.select2').select2()
</script>