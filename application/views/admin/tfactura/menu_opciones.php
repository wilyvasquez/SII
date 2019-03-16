<div class="box-header">
  <h3 class="box-title">Articulos a Timbrar</h3>
  <div class="dropdown pull-right" style="margin-right: 10px">
    <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="text-decoration:none;color:black; font-size: 14px;">
      Opciones <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" style="border-color: #67A6E5">
      <!-- <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Editar Pre-Factura</a></li> -->
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target=".agregarCotizacion">Agregar Cotizacion</a></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" href="#" data-toggle="modal" data-target=".timbrar">Vincular Facturas <strong>(UUID)</strong></a></li>

      <li role="presentation" class="divider"></li>
      <li role="presentation"><a role="menuitem" tabindex="-1" target="_blank" href="<?= base_url()?>pcliente/<?= $idCliente ?>">Informacion del Cliente</a></li>
    </ul>
  </div>     
</div>