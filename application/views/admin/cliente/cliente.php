<!-- VISTA DE CLIENTES -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Cliente</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="addcliente">
        <div class="box-body">
          <div class="form-group">
            <label for="cliente">Nombre Cliente</label>
            <input type="text" class="form-control" name="cliente" placeholder="Nombre Cliente" required>
          </div>
          <div class="form-group">
            <label for="rfc">RFC</label>
            <input type="text" class="form-control" name="rfc" placeholder="RFC" required>
          </div>
          <div class="form-group">
            <label for="ucfdi">Uso CFDI</label>
            <select class="form-control select2" style="width: 100%;" name="ucfdi">
              <?php if (!empty($ucfdis)) {
                foreach ($ucfdis ->result() as $ucfdi) { ?>
                  <option value="<?= $ucfdi->c_usoCFDI ?>"><?= $ucfdi->c_usoCFDI ?> - <?= $ucfdi->uso_cfdi ?> </option>
              <?php } } ?>
            </select>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="telefono">Telefono</label>
              <input type="text" class="form-control" name="telefono" placeholder="Telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
            </div>
            <div class="form-group col-md-6">
              <label for="correo">Correo</label>
              <input type="email" class="form-control" name="correo" placeholder="Correo" required>
            </div>            
          </div>
          <!-- <div class="row">
            <div class="form-group col-md-6">
              <label for="codigoi">Direccion</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Pais">
            </div>
            <div class="form-group col-md-6">
              <label for="codigoi">CP</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Codigo postal">
            </div>
          </div> -->
          <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" name="direccion" placeholder="Direccion" required>
          </div>
         <!--  <div class="row">
            <div class="form-group col-md-6">
              <label for="codigoi">Num exterior</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Numero exterior">
            </div>          
            <div class="form-group col-md-6">
              <label for="codigoi">Num interior</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Numero interior">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="codigoi">Colonia</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Colonia">
            </div>
            <div class="form-group col-md-6">
              <label for="codigoi">Poblacion</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Poblacion">
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="codigoi">Ciudad</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Ciudad">
            </div>
            <div class="form-group col-md-6">
              <label for="codigoi">Estado</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Estado">
            </div>
          </div> -->
          <input type="hidden" class="form-control" name="ref" value="1">
          <div id="ntf-cliente">

          </div>
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
      <div class="box-body" id="ajax-cliente">
       <?= $tabla ?>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>