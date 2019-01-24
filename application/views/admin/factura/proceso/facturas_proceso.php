<!-- VISTA DE PRE FACTURA -->
<div class="row">
  <div class="col-md-12">
  	<div class="box box-primary">
      <div class="box-header">

      </div>
      <!-- /.box-header -->
      <div class="box-body table-responsive">
        <table id="example2" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>#</th>
            <th>Codigo PreVenta</th>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>RFC</th>
            <th>Telefono</th>
            <th>Accion</th>
          </tr>
          </thead>
          <tbody>
          <?php if (!empty($prefactura)) {
          	$i = 0;
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
      <!-- /.box-body -->
    </div>  
  </div>
</div>