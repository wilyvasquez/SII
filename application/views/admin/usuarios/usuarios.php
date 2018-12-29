<!-- VISTA DE CLIENTES -->
<div class="row">
  <div class="col-md-4">
    <div class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Subir Usuarios</h3>
      </div>
      <!-- /.box-header -->
      <!-- form start -->
      <form role="form">
        <div class="box-body">
          <div class="form-group">
            <label for="articulo">Nombre usuario</label>
            <input type="text" class="form-control" id="articulo" placeholder="Nombre Cliente">
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="codigoi">Usuario</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Usuario">
            </div>
            <div class="form-group col-md-6">
              <label for="codigoi">Password</label>
              <input type="text" class="form-control" id="codigoi" placeholder="Password">
            </div>            
          </div>
          <div class="form-group">
            <label for="costo">Telefono</label>
            <input type="text" class="form-control" id="costo" placeholder="Telefono">
          </div>
          <div class="form-group">
            <label for="codigoi">Correo</label>
            <input type="text" class="form-control" id="codigoi" placeholder="Correo">
          </div>
          <div class="form-group">
            <label for="costo">Direccion</label>
            <input type="text" class="form-control" id="costo" placeholder="Direccion">
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="estatus">Sucursal</label>
              <select class="form-control select2" style="width: 100%;" id="estatus">
                <option selected="selected">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="estatus">Estatus</label>
              <select class="form-control select2" style="width: 100%;" id="estatus">
                <option selected="selected">Alabama</option>
                <option>Alaska</option>
                <option>California</option>
                <option>Delaware</option>
                <option>Tennessee</option>
                <option>Texas</option>
                <option>Washington</option>
              </select>
            </div>            
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
        <table id="example2" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Usuario</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Sucursal</th>
            <th>Estatus</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>Trident</td>
            <td>Internet
              Explorer 4.0
            </td>
            <td>Win 95+</td>
            <td> 4</td>
            <td>X</td>
          </tr>
          <tr>
            <td>Tasman</td>
            <td>Internet Explorer 5.1</td>
            <td>Mac OS 7.6-9</td>
            <td>1</td>
            <td>C</td>
          </tr>
          <tr>
            <td>Tasman</td>
            <td>Internet Explorer 5.2</td>
            <td>Mac OS 8-X</td>
            <td>1</td>
            <td>C</td>
          </tr>
          <tr>
            <td>Misc</td>
            <td>NetFront 3.1</td>
            <td>Embedded devices</td>
            <td>-</td>
            <td>C</td>
          </tr>
          <tr>
            <td>Misc</td>
            <td>NetFront 3.4</td>
            <td>Embedded devices</td>
            <td>-</td>
            <td>A</td>
          </tr>
          <tr>
            <td>Misc</td>
            <td>Dillo 0.8</td>
            <td>Embedded devices</td>
            <td>-</td>
            <td>X</td>
          </tr>
          <tr>
            <td>Other browsers</td>
            <td>All others</td>
            <td>-</td>
            <td>-</td>
            <td>U</td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>