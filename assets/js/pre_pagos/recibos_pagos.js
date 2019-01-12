/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#agregar_rpagos").on("submit", function(e){
    e.preventDefault();
    $('#btn-generar').attr("disabled", true);
    console.log("PRE RECIBOS DE PAGO");
    var formData = new FormData(document.getElementById("agregar_rpagos"));
    $.ajax({
      url: "CtrRecibosPago/push_prepagos",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      $("#ntf-cliente").html(res);
      // $('#relacionar').attr("disabled", true);
    });
  });
});

/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#agregar_docto").on("submit", function(e){
    e.preventDefault();
    console.log("SUBIR DOCTOS RECIBO DE PAGOS");
    var formData = new FormData(document.getElementById("agregar_docto"));
    $.ajax({
      url: "../CtrRecibosPago/agregar_docto",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      // $("#ntf-cliente").html(res);
      $("#tbl-uuid").html(res);
      $('#btn-articulo').attr("disabled", true);
    });
  });
});

/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#timbrarpagos").on("submit", function(e){
    console.log("TIMBRAR RECIBO DE PAGOS");
    e.preventDefault();
    var ids        = document.getElementById('ids').value;
    var id_cliente = document.getElementById('id_cliente').value;
    var fecha      = document.getElementById('fecha').value;
    console.log(ids);
    console.log(fecha);
    var par = 
    {
      "ids"  : ids,
      "id_cliente"  : id_cliente,
      "fecha"  : fecha,
    };
    $.ajax({
      url: "../CtrComplemento/timbrado",
      type: "post",
      dataType: "html",
      data: par,
      beforeSend: function(){
        $("#resultado").html("Generando factura, espere por favor");
      },
      success: function(response){
        // $('#btn-timbrar').attr("disabled", true);
        // $('#btn-limpiar').attr("disabled", true);
        // $('#btn-articulo').attr("disabled", true);
        // 
        var json = $.parseJSON(response);
        $("#resultado").html(json.btn);
        $("#tbl-articulo").html(json.msg);
        // 
        // $("#resultado").html(response);
      }
    })
  });
});
/**
 * obtener parcialidad
 */
 function valorParcialidad()
 {
  var uuid = document.getElementById('uuid').value;
  console.log("PARCIALIDAD");
  var par = 
  {
    "uuid"  : uuid,
  };
  $.ajax({
    url: "../CtrRecibosPago/get_parcialidad",
    type: "post",
    dataType: "html",
    data: par,
  })
  .done(function(response){
     $("#parcialidad").val(response);
  });
 }