<div class="box box-primary">
  <div id="notificacion">
    <div class="box-header">
      <h3 class="box-title">Documentos relacionados <strong>(UUID)</strong> </h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body no-padding" id="tbl-uuid">
      <table class="table table-hover">
        <thead>
          <tr style="background: #4C9DBD">
            <th>#</th>
            <th>UUID</th>
            <th>Serie/Folio</th>
            <th>Parcialidad</th>
            <th>Pagado</th>
          </tr>
        </thead>
        <tbody>
        <?php if (!empty($rdocto)) {
          $i = 1;
        foreach ($rdocto ->result() as $articulo) { ?>
        <tr>
          <td><?= $i ?></td>
          <td><?= $articulo->uuid ?></td>
          <td><?= $articulo->folio ?></td>
          <td><?= $articulo->parcialidad ?></td>
          <td>
            <div class="dropdown">
              <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="btn-accion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                Accion
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu pull-right" aria-labelledby="btn-accion">
                <li><a href="#" data-toggle="modal" class="open-uuid" data-target=".deleteuuid" data-uuid="<?= $articulo->id_rdocto ?>">Eliminar</a></li>
              </ul>
            </div>
          </td>
        </tr>
        <?php $i++; } } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>