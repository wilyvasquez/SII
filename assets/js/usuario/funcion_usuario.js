/**
 * Funcion que agrega un nuevo cliente en el apartado de cliente
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addUsuario").on("submit", function(e){
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("addUsuario"));
    // formData.append("dato", "valor");
    $.ajax({
        url: baseurl+"CtrUsuarios/agregar_usuario",
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

selUsuario =  function(id,nombre,telefono,correo,sucursal,direccion,estatus){
  $('#mnombre').val(nombre);
  $('#mtelefono').val(telefono);
  $('#mcorreo').val(correo);
  $('#msucursal').val(sucursal);
  $('#mdireccion').val(direccion);
  $('#mestatus').val(estatus);
  $('#ids').val(id);
}


$(function(){
  $("#upUsuario").on("submit", function(e){
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("upUsuario"));
    // formData.append("dato", "valor");
    $.ajax({
        url: baseurl+"CtrUsuarios/update_usuario",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        $("#ajax-mntf").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#ajax-mntf").html("").delay(0).show(0);
        },1000);
      });
  });
});