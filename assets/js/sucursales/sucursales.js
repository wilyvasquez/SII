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
        url: "CtrAdmin/agregar_sucursal",
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
          url: "CtrAdmin/"+json.url,
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