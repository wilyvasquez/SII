  </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <strong>ERP Code.</strong>
  </footer>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="<?= base_url() ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url() ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url() ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url() ?>bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url() ?>bower_components/admin-lte/plugins/input-mask/jquery.inputmask.js"></script>
<!-- FastClick -->
<script src="<?= base_url() ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- DataTables -->
<script src="<?= base_url() ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url() ?>bower_components/admin-lte/dist/js/adminlte.min.js"></script>
<!-- funciones -->
<script src="<?= base_url() ?>assets/js/cliente/funciones_cliente.js"></script>
<script src="<?= base_url() ?>assets/js/pre_factura/pre_factura.js"></script>
<script src="<?= base_url() ?>assets/js/factura/funcion_factura.js"></script>
<script src="<?= base_url() ?>assets/js/inventario/funcion_inventario.js"></script>
<script src="<?= base_url() ?>assets/js/sucursales/sucursales.js"></script>
<script src="<?= base_url() ?>assets/js/ncredito/nota_credito.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url() ?>dist/js/demo.js"></script> -->
<!-- page script -->
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
    $('#example3').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : false,
      'info'        : false,
      'autoWidth'   : false,
      "scrollY"     : "300px",
      "scrollCollapse": true,
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

    $('.select2').select2()

    $('[data-mask]').inputmask()

  })
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
</body>
</html>