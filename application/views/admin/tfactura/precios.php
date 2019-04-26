<div class="box box-primary">
  <form role="form" id="timbrar">
    <div id="ajaxprecio">
      <div class="box-body" id="suma">
        <p><strong>SUBTOTAL:</strong> $ <?= number_format($precios[0],2) ?></p>
        <p><strong>Descuento:</strong> $ <?= number_format($precios[2],2) ?></p>
        <p><strong>IVA (16 %):</strong> $ <?= number_format($precios[1],2) ?></p>
        <p><strong>TOTAL:</strong> $ <?= number_format($precios[3],2) ?></p>
        <div id="resultado"></div>
      </div>
      <div class="box-footer">
        <label class="switch">
          <input type="checkbox" class="success" id="activos" name="activos">
          <span class="slider round"></span>
        </label>
        <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-timbrar">Timbrar</button>
      </div>      
    </div>
  </form>
</div>