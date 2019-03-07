<table id="example4" class="table table-striped table-hover">
  <tr style="background: #4C9DBD">
    <th>#</th>
    <th>UUID</th>
    <th>RELACION</th>
    <th>ACCIONES</th>
  </tr>
  <?php if (!empty($tuuid)) {
    $i= 1;
  foreach ($tuuid ->result() as $articulo) { ?>
  <tr>
    <td><?= $i ?></td>
    <td><?= $articulo->uuid ?></td>
    <td><?= $articulo->t_relacion ?></td>
    <td>
      <button type="button" data-toggle="modal" class="btn btn-danger open-uuid btn-xs" data-target=".deleteuuid" data-uuid="<?= $articulo->id_relacion ?>">Eliminar</button>
    </td>
  </tr>
  <?php $i++; } } ?>
</table>