/**
 * Funcion que seleccionamos si queremos relacionar uuid con otros
 * @return {HTML}     mostramos uuid disponibles del cliente
 */
function uuid_relacion()
{
  var relacionar = document.getElementById('relacionar').value;
  $('#btn-relacion').attr("disabled", true);
  if (relacionar == "SI") {
    $('#btn-relacion').attr("disabled", false);    
  }
  console.log(relacionar);
  var par = 
  {
    "relacionar"  : relacionar,
  };
  $.ajax({
    data: par,
    url: "CtrAdmin/ajax_cliente_uuid",
    type: "post",
  })
  .done(function(response){
    $("#uuid_relacion").html(response);        
  });  
}
/**
 * 
 */
function agregar_relacion()
{
  var cfdi      = document.getElementById('cfdi_r').value;
  var trelacion = document.getElementById('trelacion').value;
  if (cfdi.length > 0 && trelacion.length > 0) 
  {
    console.log(cfdi);
    var par = 
    {
      "cfdi"  : cfdi,
      "trelacion"  : trelacion,
    };
    $.ajax({
      data: par,
      url: "CtrAdmin/ajax_agregar_relacion",
      type: "post",
    })
    .done(function(response){
      $("#tblrelacion").html(response);      
    });
  }else{
    var html = '<div class="alert alert-danger" role="alert">Faltan campos</div>';
    $("#ntf-error").html(html).delay(1000).hide(0);
    setTimeout(function(){
      $("#ntf-error").html("").delay(0).show(0);
    },1000);
  }
}
/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addpreventa").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("addpreventa"));
    // formData.append("dato", "valor");
    $.ajax({
      url: "CtrAdmin/push_prefactura",
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
 * Funcion que elimina un uuid de la tabla de relaciones
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#deleteuuid").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("deleteuuid"));
    // formData.append("dato", "valor");
    $.ajax({
      url: "CtrAdmin/delete_uuid",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      $("#tblrelacion").html(res);
      setTimeout(function(){ 
        $('#modaldelete').modal('hide');
      },500);
    });
  });
});