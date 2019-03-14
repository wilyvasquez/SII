<div class="box box-primary">
  <div class="box-body" id="tbl-cproductos">
    <table id="example2" class="table table-bordered table-striped">
      <thead>
        <tr style="background: #4C9DBD;color: white">
          <th>ARTICULO</th>
          <th>CODIGO</th>
          <th>CANTIDAD</th>
          <th>COSTO</th>
          <th>ACCION</th>
        </tr>
      </thead>
      <tbody>
      <?php if (!empty($cotizacion)) {
        foreach ($cotizacion ->result() as $coti) { ?>
        <tr>
          <td><?= $coti->articulo ?></td>
          <td><?= $coti->codigo ?></td>
          <td><?= $coti->cantidad ?></td>
          <td><?= $coti->costo ?></td>
          <td>
            <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".eliminarACotizacion" onclick="selDCotizacion('<?= $coti->id_cotizacion ?>','<?= $coti->codigo ?>')">Eliminar</button>
          </td>
        </tr>
      <?php } } ?>
      </tbody>
    </table>    
  </div>
  <!-- <form id="generarCotizacion"> -->
  <div class="box-footer clearfix">    
    <button type="submit" class="btn btn-primary pull-right" id="btn-actualizar" data-toggle="modal" data-target=".crearCotizacion">Generar</button>
  </div>
  <!-- </form> -->
</div>