<table id="example3" class="table table-hover">
  <tr style="background: #4C9DBD">
    <th>Codigo</th>
    <th>Cantidad</th>
    <th>Articulo</th>
    <th>Valor</th>
    <th>Importe</th>
    <th>Desc</th>
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
    <td>$<?= $articulo->importe ?></td>
    <td>$<?= $articulo->descuento ?></td>
    <td>
      <button type="button" data-toggle="modal" class="btn btn-primary open-Editar btn-xs" data-target=".addarticulo" data-idar="<?= $articulo->id_apreventa ?>" data-cant="<?= $articulo->cantidad_venta ?>" data-cod="<?= $articulo->codigo_interno ?>" data-des="<?= $articulo->descripcion ?>" data-costo="<?= $articulo->costo ?>" data-arti="<?= $articulo->ref_articulo ?>" data-descu="<?= $articulo->descuento ?>">Editar</button>
    </td>
    <td>
      <a href="#" data-toggle="modal" class="open-Editar" data-cod="<?= $articulo->codigo_interno ?>" data-idar="<?= $articulo->id_apreventa ?>" data-target=".deletearticulo" style="color: red">Eliminar</a>
    </td>
    <!-- <td>
      <div class="dropdown">
        <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          Accion
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu pull-right" aria-labelledby="dropdownMenu1">
          <li><a href="#" data-toggle="modal" class="open-Editar" data-target=".addarticulo" data-idar="<?= $articulo->id_apreventa ?>" data-cant="<?= $articulo->cantidad_venta ?>" data-cod="<?= $articulo->codigo_interno ?>" data-des="<?= $articulo->descripcion ?>" data-costo="<?= $articulo->costo ?>" data-arti="<?= $articulo->ref_articulo ?>" data-descu="<?= $articulo->descuento ?>">Editar</a></li>
          <li><a href="#" data-toggle="modal" class="open-Editar" data-cod="<?= $articulo->codigo_interno ?>" data-idar="<?= $articulo->id_apreventa ?>" data-target=".deletearticulo">Eliminar</a></li>
        </ul>
      </div>
    </td> -->
  </tr>
  <?php } } ?>
</table>