<!-- VISTA DE CLIENTES -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Folios y series</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="addFolioSeries">
        <div class="box-body">
          <div class="form-group">
            <label for="finicial">Folio Inicial</label>
            <input type="number" class="form-control" name="finicial" id="finicial" min="1" placeholder="Folio Inicial">
          </div>
          <div class="form-group">
            <label for="serie">Serie</label>
            <input type="text" class="form-control" name="serie" id="serie" placeholder="Serie">
          </div>
          <div class="form-group">
            <label for="tcomprobante">Tipo comprobante</label>
            <select class="form-control" name="tcomprobante" id="tcomprobante">
              <option value="Ingreso">Ingreso</option>
              <option value="Egreso">Egreso</option>
              <option value="Pago">Pago</option>              
            </select>
          </div>
          <div class="form-group">
            <label for="fsiguiente">Folio siguente</label>
            <input type="number" class="form-control" name="fsiguiente" id="fsiguiente" min="1" placeholder="Folio siguente">
          </div>
          <div id="ajax-ntf"></div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Guardar</button>
        </div>        
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-primary">
      <div class="box-header">

      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <?= $tabla ?>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<div>
  <?= $mSerieFolio ?>
</div>