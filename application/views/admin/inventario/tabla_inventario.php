<script language="javascript">
function PulsarTecla(event)
{
    tecla = event.keyCode;
    if(tecla==118)
    {
      console.log("modal");
      $("#cerrarInventario").modal();
    }
}
window.onkeydown=PulsarTecla;
</script>
<div class="box box-primary">
  <div class="box-body table-responsive">
    <table id="tblInventario" class="table table-bordered table-striped">
      <thead>
        <tr style="background: #4C9DBD; color: white">
          <!-- <th>#</th> -->
          <th>ARTICULO</th>
          <th>CODIGO</th>
          <th>CANTIDAD</th>
          <th>COSTO</th>
          <th>COSTO PROV.</th>
          <th>CLAVE SAT</th>
          <th>ACCION</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>     
  </div>
</div>
  