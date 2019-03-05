/**
 * Funcion que agrega un nuevo cliente en el apartado de cliente
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addsucursales").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("addsucursales"));
    formData.append("dato", "valor");
    $.ajax({
        url: "CtrSucursal/agregar_sucursal",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        $("#ntf-sucursal").html(json.msg).delay(2000).hide(0);
        $.ajax({
          url: "CtrSucursal/"+json.url,
          type: "post",
          dataType: "html",
          data: null,
        })
        .done(function(response){
          $("#tbl-sucursal").html(response);
        });
      });
  });
});

/**
 * Funcion que actualiza un articulo en el menu inventario
 */
$(function(){
  $("#upSucursal").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("upSucursal"));
    formData.append("dato", "valor");
    $.ajax({
        url: "CtrSucursal/up_sucursal",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        $("#ajax-ntf").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#ajax-ntf").html("").delay(0).show(0);
        },1000);
      });
  });
});

selSucursal =  function(id,rsocial,rfc,correo,telefono,estatus){
  $('#mid').val(id);
  $('#rsocial').val(rsocial);
  $('#mrfc').val(rfc);
  $('#mcorreo').val(correo);
  $('#mtelefono').val(telefono);
  $('#mestatus').val(estatus);
}