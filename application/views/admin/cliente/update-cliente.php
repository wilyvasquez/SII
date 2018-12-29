<form class="form-horizontal">
  <div class="form-group">
    <label for="inputName" class="col-sm-2 control-label">Nombre</label>

    <div class="col-sm-10">
      <input type="email" class="form-control" id="inputName" value="<?= $icliente->cliente ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="rfc" class="col-sm-2 control-label">RFC</label>

    <div class="col-sm-10">
      <input type="email" class="form-control" id="rfc" value="<?= $icliente->rfc ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="correo" class="col-sm-2 control-label">Correo</label>

    <div class="col-sm-10">
      <input type="email" class="form-control" id="correo" value="<?= $icliente->correo ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="telefono" class="col-sm-2 control-label">Telefono</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" id="telefono" value="<?= $icliente->telefono ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="direccion" class="col-sm-2 control-label">Direccion</label>

    <div class="col-sm-10">
      <input type="text" class="form-control" name="direccion" value="<?= $icliente->direccion ?>">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-danger">Actualizar</button>
    </div>
  </div>
</form>