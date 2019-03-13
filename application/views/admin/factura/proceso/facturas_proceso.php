<!-- VISTA DE PRE FACTURA -->
<div class="row">
  <div class="col-md-12">
  	<div class="box box-primary">
      <div class="box-header">

      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive" style="display: none" id="cargando">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
          <tr style="background: #4C9DBD;color: white">
            <th>#</th>
            <th>CODIGO PREVENTA</th>
            <th>CLIENTE</th>
            <th>FECHA</th>
            <th>RFC</th>
            <th>TELEFONO</th>
            <th>ACCION</th>
          </tr>
          </thead>
          <tbody>
          <?php if (!empty($prefactura)) {
          	$i = 1;
          foreach ($prefactura ->result() as $proceso) { ?>
          <tr>
          	<td><?= $i ?></td>
            <td><?= $proceso->codigo_preventa ?></td>
            <td><?= $proceso->cliente ?></td>
            <td><?= $proceso->alta_preventa ?></td>
            <td><?= $proceso->rfc ?></td>
            <td><?= $proceso->telefono ?></td>
            <td>
            	<a href="<?= base_url() ?>infoFactura/<?= $proceso->id_preventa ?>" class="btn-primary btn-sm">Más</a>
            </td>
          </tr>
          <?php $i++; } } ?>
          </tbody>
        </table>
      </div>
      <div class="overlay" id="ocultar">
        <i class="fa fa-refresh fa-spin"></i>
      </div>
    </div>  
  </div>
</div>