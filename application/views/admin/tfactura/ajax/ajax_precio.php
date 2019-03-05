<div class="box-body" id="suma">
	<p><strong>SUBTOTAL:</strong> $ <?= $precios[0] ?></p>
	<p><strong>IVA (16 %):</strong> $ <?= $precios[1] ?></p>
	<p><strong>Descuento:</strong> $ <?= $precios[2] ?></p>
	<p><strong>TOTAL:</strong> $ <?= $precios[3] ?></p>
</div>
<!-- /.box-body -->
<div class="box-footer" id="resultado">
	<label class="switch">
      <input type="checkbox" class="success" id="activos" name="activos">
      <span class="slider round"></span>
    </label>
	<button type="submit" class="btn btn-primary btn-sm pull-right">Timbrar</button>
</div>