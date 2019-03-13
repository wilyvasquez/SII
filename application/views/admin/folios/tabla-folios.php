<table id="example2" class="table table-bordered table-striped">
  <thead>
  <tr style="background: #4C9DBD; color: white">
    <th>FOLIO INICIAL</th>
    <th>SERIE</th>
    <th>COMPROBANTE</th>
    <th>FOLIO SIGUIENTE</th>
    <th>ACCION</th>
  </tr>
  </thead>
  <tbody>
  <?php if (!empty($serieFolio)) {
    foreach ($serieFolio ->result() as $resul) { ?>
    <tr>
      <td><?= $resul->folio_inicial?></td>
      <td><?= $resul->serie ?></td>
      <td><?= $resul->tipo_comprobante ?></td>
      <td><?= $resul->folio_siguiente ?></td>
      <td>
        <a href="#" class="btn btn-primary btn-xs" onclick="selSerieFolio('<?= $resul->id_folios?>','<?= $resul->serie?>','<?= $resul->folio_inicial?>','<?= $resul->folio_siguiente?>','<?= $resul->tipo_comprobante?>')" data-toggle="modal" data-target=".editarSerieFolio">Editar</a>
      </td>
    </tr>
  <?php } } ?>
  </tbody>
</table>