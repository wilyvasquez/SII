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
  <li class="<?php if(!empty($cliente)){ echo $cliente; } ?>">
    <a href="<?= base_url() ?>cliente">
      <i class="fa fa-users"></i> <span>Clientes</span>
    </a>
  </li>
  <li class="header">OTROS</li>
  <li class="<?php if(!empty($doctos)){ echo $doctos; } ?>">
    <a href="<?= base_url() ?>timbrado">
      <i class="fa fa-file-text"></i> <span>Doctos Timbrado</span>
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