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
      try {
        var json = $.parseJSON(res);
        $("#ntf-rpago").html(json.msg).delay(2000).hide(0); 
        $('#btn-articulo').attr("disabled", true);
        setTimeout(function(){ 
          $("#ntf-rpago").html("").delay(0).show(0);
        },1000);
      }
      catch(error) {
        $("#tbl-uuid").html(res);
        $('#btn-articulo').attr("disabled", true);  
      }
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
    var par = 
    {
      "ids"  : document.getElementById('ids').value,
      "id_cliente"  : document.getElementById('id_cliente').value,
      "fecha"  : document.getElementById('fecha').value,
      "activo"  : document.getElementById('activos').checked,
    };
    $.ajax({
      url: "../CtrTimbrarReciboPago/timbrado",
      type: "post",
      dataType: "html",
      data: par,
      beforeSend: function(){
        $("#resultado").html("Generando Recibo de pago, espere por favor");
        $('#btn-timbrar').attr("disabled", true);
      },
      success: function(response)
      {
        var json = $.parseJSON(response);
        $("#tbl-articulo").html(json.msg);
        $("#resultado").html(json.btn); 
        if (json.status == "error") 
        { 
          $('#btn-timbrar').attr("disabled", false);
          setTimeout(function(){ 
            $("#resultado").html("").delay(0).show(0);
          },1000);
        }else{
          $('#btn-timbrar').attr("disabled", true);
          $("#resultado").html(json.btn); 
          $("#notificacion").html(json.msg);  
          $('#btn-articulo').attr("disabled", true);
          $('#btn-limpiar').attr("disabled", true);            
        }
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
  .done(function(response)
  {
    var json = $.parseJSON(response);
    $("#parcialidad").val(json.parcialidad);
    $("#total").html(json.total);
    if (json.msg == "error") {
      $('#btn-articulo').attr("disabled", true);
    }
  });
}

 /**
 * Funcion que elimina un uuid de la tabla de relaciones
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#deleteuuidrpagos").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("deleteuuidrpagos"));
    $.ajax({
      url: "../CtrRecibosPago/deleteUuidRecibosPago",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res)
    {
      $("#tbl-uuid").html(res);
      setTimeout(function(){ 
        $('#modaldelete').modal('hide');
      },500);
    });
  });
});