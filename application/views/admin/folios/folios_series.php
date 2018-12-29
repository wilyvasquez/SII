<!-- VISTA DE CLIENTES -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Folios y series</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="articulo">Folio Inicial</label>
            <input type="text" class="form-control" id="articulo" placeholder="Folio Inicial">
          </div>
          <div class="form-group">
            <label for="codigoi">Serie</label>
            <input type="text" class="form-control" id="codigoi" placeholder="Serie">
          </div>
          <div class="form-group">
            <label for="codigoi">Tipo comprobante</label>
            <input type="text" class="form-control" id="codigoi" placeholder="Tipo comprobante">
          </div>
          <div class="form-group">
            <label for="costo">Folio siguente</label>
            <input type="text" class="form-control" id="costo" placeholder="Folio siguente">
          </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
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