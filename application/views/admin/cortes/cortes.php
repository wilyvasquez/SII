<!-- VISTA DE CLIENTES -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Generar corte</h3>
      </div>
      <form role="form" id="addFolioSeries">
        <div class="box-body">
          <div class="form-group">
            <label for="fecha">Fecha corte</label>
            <input type="text" class="form-control" name="fecha" id="fecha" placeholder="Fecha corte">
          </div>
          <div class="form-group">
            <label for="fecha">Tipo corte</label>
            <select class="form-control select2">
              <option>Corte X</option>
              <option>Corte Z</option>
            </select>
          </div>
          <div id="ajax-ntf"></div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary pull-right">Guardar</button>
        </div>        
      </form>
    </div>
  </div>
  <!-- <div class="col-md-8">
    <div class="box box-primary">
      <div class="box-body">
        <?= $tabla ?>
      </div>
    </div>
  </div> -->
</div>