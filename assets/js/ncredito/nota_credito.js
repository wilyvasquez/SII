/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#agregar_ncredito").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("agregar_ncredito"));
    // formData.append("dato", "valor");
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
    var f = $(this);
    var formData = new FormData(document.getElementById("agregar_uuid"));
    ids = document.getElementById('ids').value;
    par =
    {
      "ids" : ids
    }
    $.ajax({
      url: "../CtrNotaCredito/agregar_uuid",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      var json = $.parseJSON(res);
      $("#ntf-cliente").html(json.msg).delay(2000).hide(0);
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
    url: "../CtrNotaCredito/"+json.url,
    type: "post",
    dataType: "html",
    data: par,
  })
  .done(function(response){
    $("#tbl-articulo").html(response);
    setTimeout(function(){ 
      $('#deleteModal').modal('hide');
      $("#editado").html("").delay(0).show(0);
      $("#borrado").html("").delay(0).show(0);
    },2000); 
  });
}