$(function () {
  $('#tblIFacturas').DataTable({
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
        "url":baseurl+"CtrInventario/getIFacturas",
        "type":"POST",            
      },
      'columns': [
        {data: 'id_dfacturacion','sClass':'dt-body-center'},
        {data: 'proveedor'},
        {data: 'factura'},
        {data: 'alta_dfacturacion'},
        {"orderable": true,
          render:function(data, type, row){
            return '<a href="rdfacturas/'+row.id_dfacturacion+'" target="_blank" class="btn btn-block btn-primary btn-xs">Descargar</a>'
          }
        }
      ],
      "order" : [[0, "asc"]],
  });
});
