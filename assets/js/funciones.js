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
  "scrollY"     : "360px",
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

//Date picker
$('#fecha').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd',
})

})

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});