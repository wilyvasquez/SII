<div class="box box-primary">
  <!-- <div class="box-header with-border">
    <h3 class="box-title">Precios</h3>
  </div> -->
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" id="timbrar">
    <div id="ajaxprecio">
      <div class="box-body" id="suma">
        <p><strong>SUBTOTAL:</strong> $ <?= number_format($precios[0],2) ?></p>
        <p><strong>IVA (16 %):</strong> $ <?= number_format($precios[1],2) ?></p>
        <p><strong>Descuento:</strong> $ <?= number_format($precios[2],2) ?></p>
        <p><strong>TOTAL:</strong> $ <?= number_format($precios[3],2) ?></p>
      </div>
      <!-- /.box-body -->
      <div class="box-footer" id="resultado">
        <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-timbrar">Timbrar</button>
      </div>      
    </div>
  </form>
</div>