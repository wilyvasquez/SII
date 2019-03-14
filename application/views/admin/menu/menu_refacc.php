<!-- INICIO DEL MENU -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">HOME</li>
  <li class="<?php if(!empty($home)){ echo $home; } ?>">
    <a href="<?= base_url() ?>home">
      <i class="fa fa-home"></i> <span>Principal</span>
    </a>
  </li>
  <li class="header">MENU DE OPCIONES</li>
  <li class="treeview <?php if(!empty($rinventario)){ echo $rinventario; } ?>">
    <a href="#">
      <i class="fa fa-archive"></i> <span>Inventario</span>
      <span class="pull-right-container">
        <i class="fa fa-angle-left pull-right"></i>
      </span>
    </a>
    <ul class="treeview-menu">
      <li class="<?php if(!empty($historial)){ echo $historial; } ?>"><a href="<?= base_url() ?>hinventario"><i class="fa fa-circle-o"></i> Inventario</a></li>
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
      <li class="<?php if(!empty($historial)){ echo $historial; } ?>"><a href="<?= base_url() ?>Cinventario"><i class="fa fa-circle-o"></i> Historial</a></li>
    </ul>
  </li>
  <li class="<?php if(!empty($cliente)){ echo $cliente; } ?>">
    <a href="<?= base_url() ?>cliente">
      <i class="fa fa-users"></i> <span>Clientes</span>
    </a>
  </li>
  <li class="header">OTROS</li>
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