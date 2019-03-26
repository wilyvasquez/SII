<!-- VISTA DE INVENTARIO -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Motocicletas (BAJAJ)</h3>
      </div>
      <form enctype="multipart/form-data" id="altaXml" method="post">
        <div class="box-body">
          <div class="form-group">
            <label for="file">SUBIR XML</label>
            <input type="file" class="form-control" id="file" name="file" required>
          </div>
          <div id="mensaje"></div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right" id="btn-guardarInventario">Subir XML</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
  	<?= $tabla ?>
  </div>
</div>
<div>
	<?= $modal_i ?>
	<?= $modal_c ?>
</div>