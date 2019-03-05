<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">UUID Relacionados</h3>
  </div>
  <div class="box-body no-padding" id="tabla_relacion">
    <table id="example3" class="table table-bordered table-hover">
      <thead>
        <tr style="background: #4C9DBD; color: white">
          <th>#</th>
          <th>UUID</th>
          <th>Relacion</th>
          <th style="width: 100px">Accion</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($uuids)) {
        $i=1;
        foreach ($uuids ->result() as $uuid) { ?>
        <tr>
          <td><?= $i ?></td>
          <td><?= $uuid->uuid ?></td>
          <td><?= $uuid->t_relacion ?></td>
          <td>
            <button class="btn btn-danger btn-xs open-uuid" data-toggle="modal" data-target=".deleteuuid" data-uuid="<?= $uuid->id_relacion ?>">Eliminar</button>
          </td>
        </tr>
      <?php $i++; } } ?>
    </tbody>
    </table><br>
  </div>
</div>