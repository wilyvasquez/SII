$(function () {
  $('#tblCotizacion').DataTable({
    'paging'      : true,
    'info'        : false,
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
        "url":baseurl+"CtrInventario/getInventario",
        "type":"POST",            
      },
      'columns': [
        // {data: 'id_articulo','sClass':'dt-body-center'},
        {data: 'articulo'},
        {data: 'codigo_interno'},
        {data: 'cantidad'},
        {data: 'costo'},
        // {data: 'codigo_sat'},
        {"orderable": true,
          render:function(data, type, row){
            return '<button type="button" class="btn btn-block btn-primary btn-xs" onclick="selCotizacion(\''+row.id_articulo+'\',\''+row.articulo+'\',\''+row.codigo_interno+'\',\''+row.cantidad+'\',\''+row.costo+'\')" data-toggle="modal" data-target=".agregarArticulo">Agregar</button>'
          }
        }
      ],
      "order" : [[0, "asc"]],
  });
});

selCotizacion =  function(id,articulo,codigo_interno,cantidad,costo){
  $('#mid').val(id);
  $('#marticulo').val(articulo);
  $('#mcodigo').val(codigo_interno);
  $('#mcantidad').val(cantidad);
  $('#mcosto').val(costo);
}

selDCotizacion =  function(id,codigo_interno){
	console.log(codigo_interno);
  $('#midc').val(id);
  $('#mcodigoss').val(codigo_interno);
}

// Funcion que agrega un nuevo articulo en el apartado de articulos para timbrado Factura y nota de credito
$(function(){
  $("#addCotizacion").on("submit", function(e){
    e.preventDefault();
    $('#btn-articulo').attr("disabled", true);
    console.log("AGREGAR ARTICULO COTIZACION");
    var formData = new FormData(document.getElementById("addCotizacion"));
    $.ajax({
      url: "CtrCotizacion/agregar_articulo",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res)
    {
      var json = $.parseJSON(res);
      $("#ntf-cotizacion").html(json.msg).delay(2000).hide(0);
      setTimeout(function(){ 
        $("#ntf-cotizacion").html("").delay(0).show(0);
      },1000);
    });
  });
});

// Funcion que eliminar una articulo de la cotizacion de refacciones
$(function(){
  $("#deleteArticuloCotizacion").on("submit", function(e){
    e.preventDefault();
    $('#btn-articulo').attr("disabled", true);
    console.log("ELIMINAR ARTICULO DE LA COTIZACION");
    var formData = new FormData(document.getElementById("deleteArticuloCotizacion"));
    $.ajax({
      url: "CtrCotizacion/eliminar_articulo",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res)
    {
      var json = $.parseJSON(res);
      $("#ntf-dcotizacion").html(json.msg).delay(2000).hide(0);
      setTimeout(function(){ 
        $("#ntf-dcotizacion").html("").delay(0).show(0);
      },1000);
    });
  });
});

// Funcion que eliminar una articulo de la cotizacion de refacciones
$(function(){
  $("#generarCotizacion").on("submit", function(e){
    e.preventDefault();
    $('#btn-articulo').attr("disabled", true);
    console.log("GENERAR COTIZACION");
    var formData = new FormData(document.getElementById("generarCotizacion"));
    $.ajax({
      url: "CtrCotizacion/generar_cotizacion",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res)
    {
    	$("#ntf-dcotizaciones").html(res);
    	console.log(res);
      // var json = $.parseJSON(res);
      // $("#ntf-dcotizacion").html(json.msg).delay(2000).hide(0);
      // setTimeout(function(){ 
      //   $("#ntf-dcotizacion").html("").delay(0).show(0);
      // },1000);
    });
  });
});