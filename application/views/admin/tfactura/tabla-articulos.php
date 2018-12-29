<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Articulos a facturar  - <strong><?= $icliente->cliente ?></strong></h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding" id="tbl-articulo">
    <table class="table table-hover">
      <tr style="background: #4C9DBD">
        <th>Cantidad</th>
        <th>Codigo</th>
        <th>Descripcion</th>
        <th>Valor</th>
        <th>Importe</th>
        <th>Desc</th>
        <th>Acciones</th>
      </tr>
      <?php if (!empty($tarticulos)) {
      foreach ($tarticulos ->result() as $articulo) { ?>
      <tr>
        <td><?= $articulo->cantidad_venta ?></td>
        <td><?= $articulo->codigo_interno ?></td>
        <td><?= $articulo->descripcion ?></td>
        <td>$<?= $articulo->costo ?></td>
        <td>$<?= $articulo->importe ?></td>
        <td><?= $articulo->descuento ?></td>
        <td>
          <div class="dropdown">
            <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="btn-accion" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
              Accion
              <span class="caret"></span>
            </button>
            <ul class="dropdown-menu pull-right" aria-labelledby="btn-accion">
              <li><a href="#" data-toggle="modal" class="open-Editar" data-target=".addarticulo" data-idar="<?= $articulo->id_apreventa ?>" data-cant="<?= $articulo->cantidad_venta ?>" data-cod="<?= $articulo->codigo_interno ?>" data-des="<?= $articulo->descripcion ?>" data-costo="<?= $articulo->costo ?>" data-arti="<?= $articulo->ref_articulo ?>">Editar</a></li>
              <li><a href="#" data-toggle="modal" class="open-Editar" data-cod="<?= $articulo->codigo_interno ?>" data-idar="<?= $articulo->id_apreventa ?>" data-target=".deletearticulo">Eliminar</a></li>
            </ul>
          </div>
        </td>
      </tr>
      <?php } } ?>
    </table>
  </div>
  <!-- <div class="box-footer">
    <button type="submit" class="btn btn-danger btn-sm pull-left">Cancelar Timbrado</button>
    <button type="submit" class="btn btn-primary btn-sm pull-right">Timbrar</button>
  </div> -->
  <!-- /.box-body -->
</div>