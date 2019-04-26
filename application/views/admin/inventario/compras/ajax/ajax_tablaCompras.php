<div class="box box-primary">
  <div class="box-body table-responsive">
    <table id="example2" class="table table-bordered table-striped">
      <thead>
        <tr style="background: #4C9DBD; color: white">
          <!-- <th>#</th> -->
          <th>ARTICULOS</th>
          <th>CODIGO</th>
          <th>CANTIDAD</th>
          <th>COSTO</th>
          <th>COSTO PROV.</th>
          <th>CLAVE SAT</th>
          <th>ACCION</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        if (!empty($acompras)) {
          foreach ($acompras ->result() as $articulo) { ?>
            <tr>
              <td><?= $articulo->articulo ?></td>
              <td><?= $articulo->codigo ?></td>
              <td><?= $articulo->cantidad ?></td>
              <td><?= $articulo->costo ?></td>
              <td><?= $articulo->costo_proveedor ?></td>
              <td><?= $articulo->clave ?></td>
              <td>
                <button class="btn btn-warning btn-xs">Eliminar</button>
              </td>
            </tr>
        <?php } } ?>
      </tbody>
    </table>     
  </div>
</div>
<script type="text/javascript">
$(function () {
  $('#example1').DataTable()
  $('#example2').DataTable({
    'paging'      : true,
    'lengthChange': false,
    'searching'   : true,
    'ordering'    : false,
    'info'        : false,
    'autoWidth'   : false,
    "lengthMenu": [[12, 24], [12, 24]],
    "language": {
        "zeroRecords": "No se encontraron datos",
        "infoEmpty": "No se encontraron datos",
        "search": "Buscar",
      "paginate": {
        "first":      "Primero",
        "last":       "Ultimo",
        "next":       "Siguiente",
        "previous":   "Anterior"
      }
    },
  })
})
</script>