<div class="box box-primary" id="ocultarUUID">
  <div class="box-header">
    <h3 class="box-title">Facturas Vinculadas  <strong>(UUID)</strong></h3>    
  </div>
  <div class="box-body table-responsive no-padding" id="tbl-uuid">
    <table id="example4" class="table table-striped table-hover">
      <thead>
        <tr style="background: #4C9DBD">
          <th>#</th>
          <th>UUID</th>
          <th>RELACION</th>
          <th>ACCIONES</th>
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
          <button type="button" data-toggle="modal" class="btn btn-danger open-uuid btn-xs" data-target=".deleteuuid" data-uuid="<?= $articulo->id_relacion ?>">Eliminar</button>
        </td>
      </tr>
      <?php $i++; } } ?>
      </tbody>
    </table>
  </div>
</div>