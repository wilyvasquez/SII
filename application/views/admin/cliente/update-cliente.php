<form class="form-horizontal" id="upDatosCliente">
  <div class="form-group">
    <label for="nombre" class="col-sm-2 control-label">Nombre</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" id="dcliente" name="dcliente" value="<?= $icliente->cliente ?>">
      <input type="hidden" class="form-control" id="id_cliente" name="id_cliente" value="<?= $icliente->id_cliente ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="rfc" class="col-sm-2 control-label">RFC</label>

    <div class="col-sm-6">
      <!-- <input type="text" class="form-control" id="rfc" name="rfc" value="<?= $icliente->rfc ?>"> -->
      <input type="text" id="rfc" name="rfc" class="form-control" oninput="validarInput(this)" value="<?= $icliente->rfc ?>">
    </div>
    <div id="resultado" class="col-sm-4"></div>
  </div>
  <div class="form-group">
    <label for="correo" class="col-sm-2 control-label">Correo</label>

    <div class="col-sm-10">
      <input type="email" class="form-control" id="correo" name="correo" value="<?= $icliente->correo ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="telefono" class="col-sm-2 control-label">Telefono</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" id="telefono" name="telefono" value="<?= $icliente->telefono ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="direccion" class="col-sm-2 control-label">Direccion</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" name="direccion" value="<?= $icliente->direccion ?>">
    </div>
  </div>
  <div id="ajax-ntf" class="col-md-offset-2"></div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-primary pull-right">Actualizar</button>
      <label class="switch">
        <input type="checkbox" class="success" id="activo" name="activo">
        <span class="slider round"></span>
      </label>
    </div>
  </div>
</form>