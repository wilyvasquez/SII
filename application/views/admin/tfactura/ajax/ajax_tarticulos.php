<table id="example3" class="table table-hover" style="margin-top: 6px">
  <tr style="background: #4C9DBD">
    <th>Codigo</th>
    <th>Cantidad</th>
    <th>Articulo</th>
    <th>Valor</th>
    <th>Desc</th>
    <th>Importe</th>
    <th>Editar</th>
    <th>Eliminar</th>
  </tr>
  <?php if (!empty($tarticulos)) {
  foreach ($tarticulos ->result() as $articulo) { ?>
  <tr>
    <td><?= $articulo->codigo_interno ?></td>
    <td><?= $articulo->cantidad_venta ?></td>
    <td><?= $articulo->articulo ?></td>
    <td>$<?= $articulo->costo ?></td>
    <td>$<?= $articulo->descuento ?></td>
    <td>$<?= $articulo->importe ?></td>
    <td>
      <button type="button" data-toggle="modal" class="btn btn-primary open-Editar btn-xs" data-target=".addarticulo" data-idar="<?= $articulo->id_apreventa ?>" data-cant="<?= $articulo->cantidad_venta ?>" data-cod="<?= $articulo->codigo_interno ?>" data-des="<?= $articulo->descripcion ?>" data-costo="<?= $articulo->costo ?>" data-arti="<?= $articulo->ref_articulo ?>" data-descu="<?= $articulo->descuento ?>">Editar</button>
    </td>
    <td>
      <a href="#" data-toggle="modal" class="open-Editar" data-cod="<?= $articulo->codigo_interno ?>" data-idar="<?= $articulo->id_apreventa ?>" data-target=".deletearticulo" style="color: red">Eliminar</a>
    </td>
  </tr>
  <?php } } ?>
</table>