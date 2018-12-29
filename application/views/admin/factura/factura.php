<!-- VISTA DE FACTURA -->
<div class="row">
  <form id="addpreventa">
    <div class="col-md-6">
      <?php if (!empty($info)) { echo $info; }?>
    </div>
    <div class="col-md-6">
      <?php if (!empty($relacion)) { echo $relacion; }?>
    </div>
  </form>
</div>
<div class="row">
  <div class="col-md-6">
    
  </div>
  <div class="col-md-6" id="tblrelacion">
    <?php if (!empty($trelacion)) { echo $trelacion; }?>
  </div>
</div>
<!-- <div class="row">
  <div class="col-md-12">
    <?php if (!empty($btncrear)) { echo $btncrear; }?>
  </div>
</div> -->
<div>
  <?= $mcliente ?>
  <?= $meliminar ?>
  <?= $mcrelacion ?>
</div>