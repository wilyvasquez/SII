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


function datosCliente()
{
  var id = document.getElementById('cliente').value;
  console.log("DATOS DEL CLIENTE");
  var par = 
  {
    "id"  : id,
  };
  $.ajax({
    url: "CtrUniversal/get_datosCliente",
    type: "post",
    dataType: "html",
    data: par,
  })
  .done(function(response)
  {
    var json = $.parseJSON(response);
    console.log(json.cliente);
    $("#dcliente").val(json.cliente);
    $("#rfc").val(json.rfc);
    $("#correo").val(json.correo);
    $("#telefono").val(json.telefono);
    $("#direccion").val(json.direccion);
    $("#id_cliente").val(json.id_cliente);
    $('#btn-up').attr("disabled", false);
  });
}