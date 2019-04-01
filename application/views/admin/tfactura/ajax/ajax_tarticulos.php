<table id="example3" class="table table-striped table-hover" style="margin-top: 6px">
  <tr style="background: #4C9DBD">
    <th>CODIGO</th>
    <th>CANTIDAD</th>
    <th>ARTICULO</th>
    <th>VALOR</th>
    <th>DESC</th>
    <th>IMPORTE</th>
    <th>EDITAR</th>
    <th>ELIMINAR</th>
  </tr>
  <?php if (!empty($tarticulos)) {
  foreach ($tarticulos ->result() as $articulo) { ?>
  <tr>
    <td><?= $articulo->codigo_interno ?></td>
    <td><center><?= $articulo->cantidad_venta ?></center></td>
    <td><?= $articulo->articulo ?></td>
    <td>$<?= number_format($articulo->costo * 1.16,2) ?></td>
    <td>$<?= number_format($articulo->descuento,2) ?></td>
    <td>$<?= number_format($articulo->importe * 1.16,2) ?></td>
    <td>
      <button type="button" data-toggle="modal" class="btn btn-primary open-Editar btn-xs" data-target=".addarticulo" data-idar="<?= $articulo->id_apreventa ?>" data-cant="<?= $articulo->cantidad_venta ?>" data-cod="<?= $articulo->codigo_interno ?>" data-des="<?= $articulo->descripcion ?>" data-costo="<?= $articulo->costo ?>" data-arti="<?= $articulo->ref_articulo ?>" data-descu="<?= $articulo->descuento ?>">Editar</button>
    </td>
    <td>
      <a href="#" data-toggle="modal" class="open-Editar" data-cod="<?= $articulo->codigo_interno ?>" data-idar="<?= $articulo->id_apreventa ?>" data-target=".deletearticulo" style="color: red">Eliminar</a>
    </td>
  </tr>
  <?php } } ?>
</table>