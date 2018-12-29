/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addinventario").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("addinventario"));
    formData.append("dato", "valor");
    $.ajax({
        url: "CtrAdmin/put_inventario",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        // $("#ntf-cliente").html(res);
        var json = $.parseJSON(res);
        $("#ntf-cliente").html(json.msg).delay(2000).hide(0);
        // $.ajax({
        //   url: "CtrAdmin/"+json.url,
        //   type: "post",
        //   dataType: "html",
        //   data: null,
        // })
        // .done(function(response){
        //   $("#ajax-cliente").html(response);
        // });
      });
  });
});

/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addmarca").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("addmarca"));
    formData.append("dato", "valor");
    $.ajax({
        url: "CtrAdmin/agregar_marca",
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
        // $.ajax({
        //   url: "CtrAdmin/"+json.url,
        //   type: "post",
        //   dataType: "html",
        //   data: null,
        // })
        // .done(function(response){
        //   $("#ajax-cliente").html(response);
        // });
      });
  });
});