<div class="box box-primary">
  <!-- <div class="box-header">
    <h3 class="box-title">Documentos Timbrado</h3>
  </div> -->
  <div class="box-body table-responsive" id="tabla_relacion" style="padding: 5px">
    <table id="example5" class="table table-bordered table-hover">
      <thead>
        <tr style="background: #4C9DBD; color: white">
          <th>#</th>
          <th>UUID</th>
          <th>FECHA</th>
          <th>TOTAL FACTURA</th>
          <th>SERIE Y FOLIO</th>
          <th>TIPO</th>
          <!-- <th>NOTA CREDITO</th> -->
          <th>ACCION</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($docto)) {
        $i=1;
        foreach ($docto ->result() as $uuid) { ?>
        <tr>
          <td><?= $i ?></td>
          <td><?= $uuid->uuid ?></td>
          <td><?= $uuid->fecha_timbrado ?></td>
          <td>$ <?= number_format($uuid->total_factura,2) ?></td>
          <td><strong><?= $uuid->serie ?> - <?= $uuid->folio ?></strong></td>
          <?php if ($uuid->tipo_comprobante == "I") {
            $tipo  = "INGRESO";
            $color = "success";
          }if ($uuid->tipo_comprobante == "E") {
            $tipo  = "EGRESO";
            $color = "warning";
          }if ($uuid->tipo_comprobante == "P") {
            $tipo  = "COMPROBANTE";
            $color = "primary";
          } ?>
          <td>
            <span class="label label-<?= $color ?>"><?= $tipo ?></span>
          </td>
          <td>
            <a href="<?= base_url() ?>dfactura/<?= $uuid->id_factura ?>" class="btn btn-primary btn-xs">Docto</a>
          </td>
        </tr>
      <?php $i++; } } ?>
    </tbody>
    </table><br>
  </div>
</div>