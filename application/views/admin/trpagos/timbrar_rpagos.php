<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Totales</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" id="timbrarpagos">
    <div id="ajaxprecio">
      <div class="box-body" id="suma">
        <p><strong>SUBTOTAL:</strong> $ <?= $precios[0] ?></p>
        <p><strong>IVA (16 %):</strong> $ <?= $precios[1] ?></p>
        <p><strong>Descuento:</strong> $ <?= $precios[2] ?></p>
        <p><strong>TOTAL:</strong> $ <?= $precios[3] ?></p>
        <hr>
        <div class="form-group">
          <label for="fecha" style="font-weight: normal;">Fecha</label>
          <input type="text" class="form-control" id="fecha" name="fecha" value="<?= date('Y-m-d') ?>" required>
        </div> 
      </div>
      <!-- /.box-body -->
      <div class="box-footer" id="resultado">
        <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-timbrar">Timbrar</button>
      </div>      
    </div>
  </form>
</div>