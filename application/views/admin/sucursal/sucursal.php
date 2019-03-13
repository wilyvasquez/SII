<!-- VISTA DE INVENTARIO -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Sucursal</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form" id="addsucursales">
        <div class="box-body">
          <div class="form-group">
            <label for="razon">Razon social</label>
            <input type="text" class="form-control" name="razon" placeholder="Razon social" required>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="sucursal">Sucursal</label>
              <select class="form-control select2" style="width: 100%;" name="sucursal" required>
                <option selected="selected" value="Oaxaca">Oaxaca</option>
                <option value="Monterrey">Monterrey</option>
                <option value="Chiapas">Chiapas</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="rfc">RFC</label><font id="resultado"></font>
              <input type="text" class="form-control" name="rfc" oninput="validarInput(this)" placeholder="RFC" required>
            </div>
          </div>
          <div class="form-group">
            <label for="direccion">Direccion</label>
            <input type="text" class="form-control" name="direccion" placeholder="Direccion" required>
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="text" class="form-control" name="correo" placeholder="Correo" required>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="telefono">Telefono</label>
              <input type="text" class="form-control" name="telefono" placeholder="Telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
            </div>
            <div class="form-group col-md-6">
              <label for="estatus">Estatus</label>
              <select class="form-control select2" style="width: 100%;" name="estatus" required>
                <option selected="selected" value="activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
            </div>          
          </div>
          <div id="ntf-sucursal"></div>
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
      <div class="box-body" id="tbl-sucursal">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
          <tr style="background: #4C9DBD;color: white">
            <th>RAZON SOCIAL</th>
            <th>RFC</th>
            <th>CORREO</th>
            <th>TELEFONO</th>
            <th>ESTATUS</th>
            <th>ACCION</th>
          </tr>
          </thead>
          <tbody>
          <?php if (!empty($sucursales)) {
            foreach ($sucursales ->result() as $sucursal) { ?>
            <tr>
              <td><?= $sucursal->razon_social ?></td>
              <td><?= $sucursal->rfc ?></td>
              <td><?= $sucursal->correo ?></td>
              <td><?= $sucursal->telefono ?></td>
              <td><?= $sucursal->estatus_sucursal ?></td>
              <td>
                <button type="button" class="btn btn-block btn-primary btn-xs" onclick="selSucursal('<?= $sucursal->id_sucursal ?>','<?= $sucursal->razon_social ?>','<?= $sucursal->rfc ?>','<?= $sucursal->correo?>','<?= $sucursal->telefono?>','<?= $sucursal->estatus_sucursal?>')" data-toggle="modal" data-target=".editarSucursal">Editar</button>
              </td>
            </tr>
          <?php } } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div> 
<div>
  <?= $modal_s ?>
</div>