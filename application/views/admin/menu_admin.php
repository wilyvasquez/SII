<!-- INICIO DEL MENU -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">MENU DE OPCIONES</li>
  <li class="treeview <?php if(!empty($timbrado)){ echo $timbrado; } ?>">
    <a href="#">
      <i class="fa fa-qrcode"></i> <span>Timbrado</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="<?php if(!empty($factura)){ echo $factura; } ?>"><a href="<?= base_url() ?>prefactura"><i class="fa fa-circle-o"></i> Factura</a></li>
      <li class="<?php if(!empty($ncredito)){ echo $ncredito; } ?>"><a href="<?= base_url() ?>prencredito"><i class="fa fa-circle-o"></i> Nota de credito</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Recibo de pago</a></li>
    </ul>
  </li>
  <li class="<?php if(!empty($cliente)){ echo $cliente; } ?>">
    <a href="<?= base_url() ?>cliente">
      <i class="fa fa-users"></i> <span>Clientes</span>
    </a>
  </li>
  <li class="<?php if(!empty($user)){ echo $user; } ?>">
    <a href="<?= base_url() ?>usuario">
      <i class="fa fa-user-plus"></i> <span>Usuarios y Roles</span>
    </a>
  </li>
  <li class="<?php if(!empty($inventario)){ echo $inventario; } ?>">
    <a href="<?= base_url() ?>inventario">
      <i class="fa fa-archive"></i> <span>Inventario</span>
    </a>
  </li>
  <li class="<?php if(!empty($sucursal)){ echo $sucursal; } ?>">
    <a href="<?= base_url() ?>sucursal">
      <i class="fa fa-building-o"></i> <span>Sucursales</span>
    </a>
  </li>
  <li class="<?php if(!empty($folios)){ echo $folios; } ?>">
    <a href="<?= base_url() ?>folios">
      <i class="fa fa-sort-alpha-asc"></i> <span>Folios y series</span>
    </a>
  </li>
  <li class="treeview <?php if(!empty($sat)){ echo $sat; } ?>">
    <a href="#">
      <i class="icon-sat"></i><span style="margin-left: 8px"> Altas SAT</span>
      <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li><a href="#"><i class="fa fa-circle-o"></i> Uso CFDI</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Claves Articulos</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Unidad de Medida</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Metodo de pago</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Formas de pago</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Tipos de relacion</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Tipo de documentos</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Regimen fiscal</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Condiciones de pagos</a></li>
      <li><a href="#"><i class="fa fa-circle-o"></i> Claves de unidad</a></li>
    </ul>
  </li>
  <li class="<?php if(!empty($reporte)){ echo $reporte; } ?>">
    <a href="#" target="_black">
      <i class="fa fa-clipboard"></i> <span>Reportes</span>
    </a>
  </li>
  <li class="header">OTROS</li>
  <li class="<?php if(!empty($config)){ echo $config; } ?>">
    <a href="#" target="_black">
      <i class="fa fa-file-text"></i> <span>Historial</span>
    </a>
  </li>
  <li class="<?php if(!empty($config)){ echo $config; } ?>">
    <a href="#" target="_black">
      <i class="fa fa-share-alt"></i> <span>Extras</span>
    </a>
  </li>
  <li class="<?php if(!empty($config)){ echo $config; } ?>">
    <a href="#" target="_black">
      <i class="fa fa-gears"></i> <span>Configuraciones</span>
    </a>
  </li>
</ul> 
</section>
    <!-- /.sidebar -->
</aside>
 <!-- ==================FIN DEL MENU============================= -->  