<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">UUID a Vincular  - <strong><?= $icliente->cliente ?></strong></h3>
    <div class="dropdown pull-right" style="margin-right: 10px">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="text-decoration:none;color:black; font-size: 14px;">
        Menu <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" style="border-color: #67A6E5">
        <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="../icredito/1">Informacion del Credito</a></li> -->
        <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="#">Generar Reporte</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="#">Ver Graficas</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="#">Editar Pre-Factura</a></li>
        <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Actualizar fecha</a></li> -->
        <li role="presentation" class="divider"></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Informacion del Cliente</a></li>
      </ul>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding" id="tbl-articulo">
    <table class="table table-hover">
      <tr style="background: #4C9DBD">
        <th>#</th>
        <th>UUID</th>
        <th>Relacion</th>
        <th>Acciones</th>
      </tr>
      <?php if (!empty($tuuid)) {
      	$i = 1;
      foreach ($tuuid ->result() as $articulo) { ?>
      <tr>
        <td><?= $i ?></td>
        <td><?= $articulo->uuid ?></td>
        <td><?= $articulo->t_relacion ?></td>
        <td>
          <div class="dropdown">
            <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="btn-accion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Accion
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" aria-labelledby="btn-accion">
              <li><a href="#" data-toggle="modal" class="open-Editar" data-target=".deletearticulo">Eliminar</a></li>
            </ul>
          </div>
        </td>
      </tr>
      <?php $i++; } } ?>
    </table>
  </div>
</div>