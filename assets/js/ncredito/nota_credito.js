/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#agregar_ncredito").on("submit", function(e){
    e.preventDefault();
    var formData = new FormData(document.getElementById("agregar_ncredito"));
    $.ajax({
      url: baseurl+"CtrNotaCredito/push_prencredito",
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
      url: baseurl+"CtrUniversal/agregar_uuid",
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
    url: baseurl+"CtrUniversal/"+json.url,
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
    var par = 
    {
      "ids"  : document.getElementById('ids').value,
      "id_cliente"  : document.getElementById('id_cliente').value,
      "activo"  : document.getElementById('activos').checked,
    };
    $.ajax({
      url: baseurl+"CtrTimbrarNotaCredito/timbrado",
      type: "post",
      dataType: "html",
      data: par,
      beforeSend: function(){
        $('#btn-timbrar').attr("disabled", true);
        $("#resultado").html("Generando Nota de Credito, espere por favor");
      },
      success: function(response) {
        var json = $.parseJSON(response);
        $("#resultado").html(json.btn);
        $("#tbl-articulo").html(json.msg);
        if (json.status == "error") {
          $('#btn-timbrar').attr("disabled", false);
          setTimeout(function(){ 
            $("#resultado").html("").delay(0).show(0);
          },1000);
        }else{
          $('#btn-timbrar').attr("disabled", true);
          $('#ocultarUUID').hide(0);
          $('#btn-adduuid').attr("disabled", true);
          $('#btn-limpiar').attr("disabled", true);
          $('#btn-articulo').attr("disabled", true);
          $('#btn-actualizar').attr("disabled", true);
          $('#btn-eliminar').attr("disabled", true);
          $('#btn-delete').attr("disabled", true);
          $('#activos').attr("disabled",true)
        }
      }
    })
  });
});