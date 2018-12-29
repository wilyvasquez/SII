    <!-- Vista de usuarios -->
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <!-- <h3 class="box-title">Cuentas de usuario</h3> -->
              <input type="checkbox" checked data-toggle="toggle" data-size="small" data-style="ios">
            <div class="box-tools">
              <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="table_search" class="form-control pull-right" placeholder="Buscar">

                <div class="input-group-btn">
                  <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <table class="table table-hover">
              <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Alta</th>
                <th>Status</th>
                <th>Descripcion</th>
                <th>Accion</th>
              </tr>
              <tr>
                <td>183</td>
                <td>John Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-success">Activo</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      Accion
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                      <li><a href="#" data-toggle="modal" data-target=".editUser">Editar</a></li>
                      <li><a href="#" data-toggle="modal" data-target=".deleteUser">Eliminar</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <tr>
                <td>219</td>
                <td>Alexander Pierce</td>
                <td>11-7-2014</td>
                <td><span class="label label-warning">Pendiente</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      Accion
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                      <li><a href="#" data-toggle="modal" data-target=".editUser">Editar</a></li>
                      <li><a href="#" data-toggle="modal" data-target=".deleteUser">Eliminar</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <tr>
                <td>657</td>
                <td>Bob Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-success">Activo</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      Accion
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                      <li><a href="#" data-toggle="modal" data-target=".editUser">Editar</a></li>
                      <li><a href="#" data-toggle="modal" data-target=".deleteUser">Eliminar</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
              <tr>
                <td>175</td>
                <td>Mike Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-danger">Suspendido</span></td>
                <td>Bacon ipsum dolor sit amet salami venison chicken flank fatback doner.</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                      Accion
                      <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
                      <li><a href="#" data-toggle="modal" data-target=".editUser">Editar</a></li>
                      <li><a href="#" data-toggle="modal" data-target=".deleteUser">Eliminar</a></li>
                    </ul>
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <div class="box-footer clearfix no-border">
          <button type="button" class="btn btn-default pull-right" data-toggle="modal" data-target=".addUser">
            <i class="fa fa-plus"></i> Agregar</button>
        </div>
        <!-- /.box -->
      </div>
    </div>
    <div> 
      <!-- Inicio de los modales de la vista de usuario -->
      <!-- modal de eliminar usuarios  -->
      <div class="modal fade deleteUser" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                  </button>
                  <h4 class="modal-title" id="myModalLabel" style="font-weight: bold;color: #393737">Eliminar Usuario</h4>
                </div>
                <div class="col-md-12" style="margin-top: 20px">
                  <div class="alert  alert-dismissible fade in" role="alert" style="background-color: #F7BFB0">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      </button>
                      <strong style="font-weight: bold;color: #DC1D0D"><center><i class="fa fa-warning" style="width: 20px"></i> Esta accion eliminara permanentamente todos los datos de este usuario (incluidos datos anidados).</center></strong> 
                   </div>
              </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal" style="border: 0">Cancelar</button>
              <button type="button" class="btn btn-primary" style="background-color:#DC1D0D;border: 0">Eliminar</button>
            </div>

          </div>
        </div>
      </div>
      <!-- modal de editar usuario -->
      <div class="modal fade editUser" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Editar datos usuario</h4>
            </div>
            <div class="modal-body">
              <form role="form">
                <div class="box-body">
                  <div class="form-group">
                    <label for="unidad">Nombre</label>
                    <input type="text" class="form-control" id="nombreUp" placeholder="Numero de la Unidad">
                  </div>
                  <div class="form-group">
                    <label for="marca">Status</label>
                    <input type="text" class="form-control" id="status" placeholder="Marca, Modelo y Año">
                  </div>
                  <div class="form-group">
                    <label for="marca">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" placeholder="Marca, Modelo y Año">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Actualizar</button>
            </div>

          </div>
        </div>
      </div>
      <!-- modal de agregar usuario -->
      <div class="modal fade addUser" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Nueva Cuenta</h4>
            </div>
            <div class="modal-body">
              <form role="form">
                <div class="box-body">
                  <div class="form-group">
                    <label for="nombre">Nombre completo</label>
                    <input type="email" class="form-control" id="nombre" placeholder="Numero de la Unidad">
                  </div>
                  <div class="form-group">
                    <label for="estacion">Estacion</label>
                    <input type="password" class="form-control" id="estacion" placeholder="Marca, Modelo y Año">
                  </div>
                  <div class="form-group">
                    <label for="nacimiento">Fecha Nacimiento</label>
                    <input type="password" class="form-control" id="nacimiento" placeholder="Marca, Modelo y Año">
                  </div>
                  <div class="form-group">
                    <label>Anexe cualquier informacion necesaria *</label>
                    <textarea class="form-control" rows="3" placeholder="Enter ..."></textarea>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Guardar</button>
            </div>

          </div>
        </div>
      </div>
      <!-- Fin de los modales -->
    </div>  