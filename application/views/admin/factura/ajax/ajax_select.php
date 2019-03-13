<select class="form-control select2 input-sm" style="width: 100%;" id="cliente" onchange="datosCliente()" name="cliente" data-placeholder="Selecciona" required>
	<option value="">Selecciona</option>
	<?php if (!empty($clientes)) {
	foreach ($clientes ->result() as $cliente) { ?>
	<option value="<?= $cliente->id_cliente ?>"><?= $cliente->cliente ?></option>
	<?php } } ?>
</select>
<script type="text/javascript">
	$('.select2').select2()
</script>