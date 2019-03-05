/**
 * Funcion que agrega un nuevo cliente en el apartado de cliente
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addcliente").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("addcliente"));
    formData.append("dato", "valor");
    $.ajax({
        url: "CtrClientes/agregar_cliente",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        $("#add-cliente").html(json.msg).delay(2000).hide(0);
        $.ajax({
          url: "CtrClientes/"+json.url,
          type: "post",
          dataType: "html",
          data: null,
        })
        .done(function(response){
          $("#ajax-cliente").html(response);
        });
      });
  });
});

/**
 * 
 */

/**
 * Funcion que agrega un nuevo cliente en el apartado de cliente
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#upDatosCliente").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("upDatosCliente"));
    formData.append("dato", "valor");
    $.ajax({
        url: baseurl+"CtrClientes/update_cliente",
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

/**
 * Funcion que agrega un nuevo cliente en el apartado de cliente
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addFolioSeries").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("addFolioSeries"));
    formData.append("dato", "valor");
    $.ajax({
        url: "CtrClientes/add_SerieFolios",
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

/**
 * Funcion que agrega un nuevo cliente en el apartado de cliente
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#updateSerie").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("updateSerie"));
    formData.append("dato", "valor");
    $.ajax({
        url: "CtrClientes/update_SerieFolios",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        $("#majax-ntf").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#majax-ntf").html("").delay(0).show(0);
        },1000);
      });
  });
});

selSerieFolio =  function(id,serie,finicial,fsiguiente,comprobante){
  console.log(serie);
  $('#mserie').val(serie);
  $('#ids').val(id);
  $('#mtcomprobante').val(comprobante);
  $('#mfinicial').val(finicial);
  $('#mfsiguiente').val(fsiguiente);
}