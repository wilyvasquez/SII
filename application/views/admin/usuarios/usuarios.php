<!-- VISTA DE CLIENTES -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Usuarios</h3>
      </div>
      <form role="form" id="addUsuario">
        <div class="box-body">
          <div class="form-group">
            <label for="nombre">Nombre usuario</label>
            <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre de cliente" required>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuario" required>
            </div>
            <div class="form-group col-md-6">
              <label for="contrasena">Password</label>
              <input type="text" class="form-control" id="contrasena" name="contrasena" placeholder="Password" required>
            </div>            
          </div>
          <div class="form-group">
            <label for="telefono">Telefono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Telefono" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
          </div>
          <div class="form-group">
            <label for="correo">Correo</label>
            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" required>
          </div>
          <div class="form-group">
            <label for="direccion">Permisos</label>
            <select class="form-control select2" style="width: 100%;" id="direccion" name="direccion">
              <option selected="selected" value="Caja">Caja</option>
              <option value="Admin">Admin</option>
            </select>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="sucursal">Sucursal</label>
              <select class="form-control select2" style="width: 100%;" id="sucursal" name="sucursal">
                <option selected="selected" value="Oaxaca">Oaxaca</option>
                <option value="Monterrey">Monterrey</option>
                <option value="Chiapas">Chiapas</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="estatus">Estatus</label>
              <select class="form-control select2" style="width: 100%;" id="estatus" name="estatus">
                <option selected="selected" value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
            </div>            
          </div>
          <div id="ajax-ntf"></div>
        </div>
        <div class="box-footer">
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
    </div>
  </div>
  <div class="col-md-8">
    <div class="box box-primary">
      <div class="box-body">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
          <tr style="background: #4C9DBD; color: white">
            <th>USUARIO</th>
            <th>TELEFONO</th>
            <th>CORREO</th>
            <th>SUCURSAL</th>
            <th>ESTATUS</th>
            <th>ACCION</th>
          </tr>
          </thead>
          <tbody>
          <?php if (!empty($usuarios)) { 
          foreach ($usuarios ->result() as $usuario) { ?>
            <tr>
              <td><?= $usuario->nombre?></td>
              <td><?= $usuario->telefono?></td>
              <td><?= $usuario->correo?></td>
              <td><?= $usuario->sucursal?></td>
              <td><?= $usuario->estatus?></td>
              <td>
                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target=".editarUsuario" onclick="selUsuario('<?= $usuario->id_usuario?>','<?= $usuario->nombre?>','<?= $usuario->telefono?>','<?= $usuario->correo?>','<?= $usuario->sucursal?>','<?= $usuario->direccion?>','<?= $usuario->estatus?>')">Editar</button>
              </td>
            </tr>
          <?php }} ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div>
  <?= $modalUser ?>
</div>