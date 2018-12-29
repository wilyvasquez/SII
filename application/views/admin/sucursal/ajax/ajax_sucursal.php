<table id="example2" class="table table-bordered table-striped">
  <thead>
  <tr>
    <th>Razon Social</th>
    <th>RFC</th>
    <th>Correo</th>
    <th>Telefono</th>
    <th>Estatus</th>
  </tr>
  </thead>
  <tbody>
    <?php if (!empty($sucursales)) {
    foreach ($sucursales ->result() as $sucursal) { ?>
    <tr>
      <td><?= $sucursal->razon_social ?></td>
      <td><?= $sucursal->rfc ?></td>
      <td><?= $sucursal->correo ?></td>
      <td><?= $sucursal->telefono ?></td>
      <td><?= $sucursal->estatus_sucursal ?></td>
    </tr>
    <?php } } ?>
  </tbody>
</table>
<script>
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