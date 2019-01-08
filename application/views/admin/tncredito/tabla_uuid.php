<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">UUID a Vincular </h3>
    <button class="btn btn-xs pull-right btn-primary" data-toggle="modal" data-target=".timbrar">Agregar UUID</button>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding" id="tbl-uuid">
    <table class="table table-hover">
      <thead>
        <tr style="background: #4C9DBD">
          <th>#</th>
          <th>UUID</th>
          <th>Relacion</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
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
              <li><a href="#" data-toggle="modal" class="open-uuid" data-target=".deleteuuid" data-uuid="<?= $articulo->id_relacion ?>">Eliminar</a></li>
            </ul>
          </div>
        </td>
      </tr>
      <?php $i++; } } ?>
      </tbody>
    </table>
  </div>
</div>