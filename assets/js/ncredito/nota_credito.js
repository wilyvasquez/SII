/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#agregar_ncredito").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("agregar_ncredito"));
    $.ajax({
      url: "CtrNotaCredito/push_prencredito",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      $("#ntf-cliente").html(res);
      $('#relacionar').attr("disabled", true);
    });
  });
});

/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#agregar_uuid").on("submit", function(e){
    e.preventDefault();
    $('#btn-articulo').attr("disabled", true);
    var formData = new FormData(document.getElementById("agregar_uuid"));
    ids = document.getElementById('ids').value;
    par =
    {
      "ids" : ids
    }
    $.ajax({
      url: "../CtrUniversal/agregar_uuid",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      var json = $.parseJSON(res);
      $("#ntf-uuid").html(json.msg).delay(2000).hide(0);
      ajax_tuuid(json,par);
      // ajax_precios(par);
    });
  });
});

/**
 * 
 */
function ajax_tuuid(json,par)
{
  console.log("AJAX TABLA UUID");
  $.ajax({
    url: "../CtrUniversal/"+json.url,
    type: "post",
    dataType: "html",
    data: par,
  })
  .done(function(response){
    $("#tbl-uuid").html(response);
    setTimeout(function(){ 
      $('#deleteModal').modal('hide');
      $("#editado").html("").delay(0).show(0);
      $("#borrado").html("").delay(0).show(0);
    },2000); 
  });
}

/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#timbrarncredito").on("submit", function(e){
    console.log("TIMBRAR NOTA CREDITO");
    e.preventDefault();
    var ids        = document.getElementById('ids').value;
    var id_cliente = document.getElementById('id_cliente').value;
    console.log(id_cliente);
    var par = 
    {
      "ids"  : ids,
      "id_cliente"  : id_cliente,
    };
    $.ajax({
      url: "../CtrTimbrarNotaCredito/timbrado",
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
        var json = $.parseJSON(response);
        $("#resultado").html(json.btn);
        $("#tbl-articulo").html(json.msg);
        // $("#resultado").html(response);
      }
    })
  });
});