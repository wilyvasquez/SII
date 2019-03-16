<div class="box box-primary">
  <div class="box-body" id="tbl-cproductos">
    <table id="example2" class="table table-bordered table-striped">
      <thead>
        <tr style="background: #4C9DBD;color: white">
          <th>#</th>
          <th>CLIENTE</th>
          <th>TELEFONO</th>
          <th>COTIZACION</th>
          <th>FECHA</th>
          <TH>ACCION</TH>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($datos)) { $i = 1;
        foreach ($datos ->result() as $coti) { ?>
        <tr>
          <td><?= $i ?></td>
          <td><?= $coti->cliente ?></td>
          <td><?= $coti->telefono ?></td>
          <td><?= $coti->num_cotizacion ?></td>
          <td><?= $coti->alta_dcotizacion ?></td>
          <td>
            <a href="#" class="btn btn-block btn-primary btn-xs">Datos</a>
          </td>
        </tr>
      <?php $i++; } } ?>
      </tbody>
    </table>    
  </div>
</div>