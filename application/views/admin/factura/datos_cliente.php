<div class="box box-primary">
  <div class="box-header with-border">
    <h3 class="box-title">Datos del cliente</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal" id="upDatosCliente">
    <div class="box-body">
      <div class="form-group">
        <label for="cliente" class="col-md-3 control-label" style="font-weight: normal;">Cliente: </label>

        <div class="col-md-9">
          <input type="text" class="form-control input-sm" id="dcliente" name="dcliente" placeholder="Nombre del cliente" required>
          <input type="hidden" id="id_cliente" name="id_cliente" required>
        </div>
      </div>
      <div class="form-group">
        <label for="rfc" class="col-md-3 control-label" style="font-weight: normal;">RFC: </label>

        <div class="col-md-9">
          <input type="text" class="form-control input-sm" id="rfc" name="rfc" placeholder="RFC del cliente" required>
        </div>
      </div>
      <div class="form-group">
        <label for="correo" class="col-md-3 control-label" style="font-weight: normal;">Correo: </label>

        <div class="col-md-9">
          <input type="text" class="form-control input-sm" id="correo" name="correo" placeholder="Correo del cliente" required>
        </div>
      </div>
      <div class="form-group">
        <label for="telefono" class="col-md-3 control-label" style="font-weight: normal;">Telefono: </label>

        <div class="col-md-9">
          <input type="text" class="form-control input-sm" id="telefono" name="telefono" placeholder="Telefono del cliente" required>
        </div>
      </div>
      <div class="form-group">
        <label for="direccion" class="col-md-3 control-label" style="font-weight: normal;">Direccion: </label>

        <div class="col-md-9">
          <input type="text" class="form-control input-sm" id="direccion" name="direccion" placeholder="Direccion del cliente" required>
        </div>
      </div>
      <div id="ajax-ntf"></div>
    </div>
    <div class="box-footer" id="ntf-cliente">
      <button type="submit" class="btn btn-primary btn-sm pull-right" id="btn-up" disabled>Actualizar</button>
    </div>
  </form>
</div>