/**
 * Funcion que seleccionamos si queremos relacionar uuid con otros
 * @return {HTML}     mostramos uuid disponibles del cliente
 */
function uuid_relacion()
{
  var relacionar = document.getElementById('relacionar').value;
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
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addpreventa").on("submit", function(e){
    e.preventDefault();
    var f = $(this);
    var formData = new FormData(document.getElementById("addpreventa"));
    formData.append("dato", "valor");
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
    });
  });
});