<div class="box box-primary">
  <form role="form" id="timbrarpagos">
    <div id="ajaxprecio">
      <div class="box-body" id="suma">
        <p><strong>SUBTOTAL:</strong> $ <?= $precios[0] ?></p>
        <p><strong>IVA (16 %):</strong> $ <?= $precios[1] ?></p>
        <p><strong>Descuento:</strong> $ <?= $precios[2] ?></p>
        <p><strong>TOTAL:</strong> $ <?= $precios[3] ?></p>
        <hr class="row">
        <div class="form-horizontal">
          <div class="form-group">
            <label for="fecha" style="font-weight: normal;" class="col-md-3 control-label">Fecha: </label>
            <div class="col-md-9">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="fa fa-calendar"></i>
                </div>
                <input type="text" class="form-control" id="fecha" name="fecha" value="<?= date('Y-m-d') ?>" required>
              </div>
            </div>
          </div>
        </div>
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