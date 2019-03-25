<!-- INICIO DEL MENU -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">HOME</li>
  <li class="<?php if(!empty($home)){ echo $home; } ?>">
    <a href="<?= base_url() ?>home">
      <i class="fa fa-home"></i> <span>Principal</span>
    </a>
  </li>
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
      <li class="<?php if(!empty($rpagos)){ echo $rpagos; } ?>"><a href="<?= base_url() ?>prepagos"><i class="fa fa-circle-o"></i> Recibo de pago</a></li>
    </ul>
  </li>
  <li class="<?php if(!empty($proceso)){ echo $proceso; } ?>">
    <a href="<?= base_url() ?>proceso">
      <i class="fa fa-retweet"></i> <span>Facturas en Proceso</span>
    </a>
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
  <li class="treeview <?php if(!empty($rinventario)){ echo $rinventario; } ?>">
    <a href="#">
      <i class="fa fa-archive"></i> <span>Inventario</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="<?php if(!empty($inventario)){ echo $inventario; } ?>"><a href="<?= base_url() ?>inventario"><i class="fa fa-circle-o"></i> Alta Inventario</a></li>
      <li class="<?php if(!empty($historial)){ echo $historial; } ?>"><a href="<?= base_url() ?>hinventario"><i class="fa fa-circle-o"></i> Inventario</a></li>
      <li class="<?php if(!empty($idfactura)){ echo $idfactura; } ?>"><a href="<?= base_url() ?>ifacturas"><i class="fa fa-circle-o"></i> Facturas Inventario</a></li>
    </ul>
  </li>
  <li class="treeview <?php if(!empty($cotizacion)){ echo $cotizacion; } ?>">
    <a href="#">
      <i class="fa fa-edit"></i> <span>Cotizacion</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="<?php if(!empty($gcotizacion)){ echo $gcotizacion; } ?>"><a href="<?= base_url() ?>cotizacion"><i class="fa fa-circle-o"></i> Generar</a></li>
      <li class="<?php if(!empty($historial)){ echo $historial; } ?>"><a href="<?= base_url() ?>chistorial"><i class="fa fa-circle-o"></i> Historial</a></li>
    </ul>
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
  <li class="<?php if(!empty($reporte)){ echo $reporte; } ?>">
    <a href="#">
      <i class="fa fa-clipboard"></i> <span>Reportes</span>
    </a>
  </li>
  <li class="header">OTROS</li>
  <li class="<?php if(!empty($doctos)){ echo $doctos; } ?>">
    <a href="<?= base_url() ?>timbrado">
      <i class="fa fa-file-text"></i> <span>Doctos Timbrado</span>
    </a>
  </li>
  <li class="<?php if(!empty($corte)){ echo $corte; } ?>">
    <a href="<?= base_url() ?>cortes">
      <i class="fa fa-pencil-square-o"></i> <span>Cortes</span>
    </a>
  </li>
  <li class="<?php if(!empty($config)){ echo $config; } ?>">
    <a href="#">
      <i class="fa fa-gears"></i> <span>Configuraciones</span>
    </a>
  </li>
</ul> 
</section>
    <!-- /.sidebar -->
</aside>
 <!-- ==================FIN DEL MENU============================= -->  