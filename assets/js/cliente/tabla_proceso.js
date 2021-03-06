$(function () {
  $('#tblProceso').DataTable({
    'paging'      : true,
    'info'        : true,
    'filter'      : true,
    'stateSave'   : true,
    'ordering'    : false,
    "language": {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sInfo":           "Registros del _START_ al _END_  (_TOTAL_ registros)",
        "sInfoFiltered":   "",
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
    'processing': true,
    'serverSide':true,
    'ajax': {
        "url":baseurl+"CtrFactura/getFacturaProceso",
        "type":"POST",            
      },
      'columns': [
        {data: 'id_cliente','sClass':'dt-body-center'},
        {data: 'cliente'},
        {data: 'rfc'},
        {data: 'telefono'},
        {data: 'correo'},
        {"orderable": true,
          render:function(data, type, row){
            return '<a href ="#">Hola</a>'
          }
        }
      ],
      "order" : [[0, "asc"]],
  });
});