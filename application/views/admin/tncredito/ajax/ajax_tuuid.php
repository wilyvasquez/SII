<table class="table table-hover">
  <tr style="background: #4C9DBD">
    <th>#</th>
    <th>UUID</th>
    <th>Relacion</th>
    <th>Acciones</th>
  </tr>
  <?php if (!empty($tuuid)) {
    $i= 1;
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