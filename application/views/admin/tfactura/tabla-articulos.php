<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Articulos a Timbrar</h3>
    <div class="dropdown pull-right" style="margin-right: 10px">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="text-decoration:none;color:black; font-size: 14px;">
        Opciones <span class="caret"></span>
      </a>
      <ul class="dropdown-menu" style="border-color: #67A6E5">
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Editar Pre-Factura</a></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target=".timbrar">Vincular Facturas <strong>(UUID)</strong></a></li>

        <li role="presentation" class="divider"></li>
        <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="<?= base_url()?>pcliente/<?= $idCliente ?>">Informacion del Cliente</a></li>
      </ul>
    </div>     
  </div>
  <!-- /.box-header -->
  <div class="box-body table-responsive no-padding" id="tbl-articulo">
    <table id="example3" class="table table-striped table-hover table-responsive">
      <thead>
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
      </thead>
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
  </div>
</div>