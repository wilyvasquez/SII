<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Agregar Articulo</h3>
   <!--  <button class="btn btn-xs pull-right btn-primary" data-toggle="modal" data-target=".timbrar">Vincular UUID</button> -->
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form role="form" id="addarticulo">
    <div class="box-body">
      <div class="row">
        <div class="form-group col-md-6">
          <label for="codigo" style="font-weight: normal;">Codigo</label>
          <select class="form-control select2" style="width: 100%;" onchange="valorUnitario()" id="codigo" name="codigo" data-placeholder="Selecciona" required>
              <option value="">Selecciona</option>
            <?php if (!empty($articulos)) {
            foreach ($articulos ->result() as $articulo) { ?>
              <option value="<?= $articulo->id_articulo ?>"><?= $articulo->codigo_interno ?></option>
            <?php } } ?>
          </select>
        </div>
        <div class="form-group col-md-6">
          <label for="costo" style="font-weight: normal;">Costo</label>
          <input type="text" class="form-control" id="costo" name="costo" placeholder="0.00" min="1" required step="any">
          <input type="hidden" class="form-control" id="ids" name="ids" value="<?= $id ?>" required>
          <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?= $icliente->id_cliente ?>" required>
        </div>                      
      </div>
      <div class="row">
        <div class="form-group col-md-6">
          <label for="cantidad" style="font-weight: normal;">Cantidad</label>
          <input type="number" class="form-control" id="cantidad" name="cantidad" onchange="importe()" placeholder="0" min="1" required disabled>
        </div>
        <div class="form-group col-md-6">
          <label for="importes" style="font-weight: normal;">Importe</label>
          <input type="text" class="form-control" id="importes" name="importes" placeholder="0" disabled>
        </div>
      </div>     
      <div class="form-group">
        <label for="descripcion" style="font-weight: normal;">Descripción del producto o servicio</label>
        <textarea class="form-control" rows="3" placeholder="Descripcion ..." id="descripcion" name="descripcion" required disabled></textarea>
      </div> 
      <!-- <div id="ntf-cliente">
        
      </div> -->
    </div>
    <!-- /.box-body -->

    <div class="box-footer">
      <button type="reset" class="btn btn-default btn-sm" id="btn-limpiar">Nuevo</button>
      <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-articulo">Agregar</button>
    </div>
  </form>
</div>