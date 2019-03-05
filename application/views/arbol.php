<?php 
function arbol($id)
{
 
  foreach ($id ->result() as $pagos) { ?>
    <ul>
      <?php echo "hola" ?>
    </ul>
  <?php } 
}
?>


<ul>
  <?php 
  $categorias = $this->Modelo_cliente->get_facturaClientePrueba(126);
  foreach ($categorias ->result() as $pagos) 
  { ?>
      <ul>
        <?php echo $pagos->uuid; 
        $ids = $this->Modelo_timbrado->get_contarComprobantesPagoPrueba($pagos->id_factura);         
        if (!empty($ids)) {
           foreach ($ids ->result() as $segunda) { ?>
            <li>
              <?php echo $segunda->uuid ?>
            </li>
            <?php 
            $ids = $this->Modelo_timbrado->get_contarComprobantesPagoPrueba($segunda->id_factura); 
            if (!empty($ids)) {
              foreach ($ids ->result() as $segunda){ ?>
                <li>
                  <?php echo $segunda->uuid ?>
                </li>
             <?php  }
            }
            ?>
            
           <?php }
        }
        ?>
      </ul>
  <?php }
  ?>
</ul>

<?php 
$totalRestante = 100; 
$monto = 100;
echo number_format($totalRestante - $monto,2) 
?>