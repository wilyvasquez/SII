/**
 * ESTA FUNCION ESTA PENDIENTE DE SI SE ESTA UTILIZANDO O SE QUITARA
 */
/*function uuid_relacion()
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
    url: "CtrFactura/ajax_cliente_uuid",
    type: "post",
  })
  .done(function(response){
    $("#uuid_relacion").html(response);        
  });  
}*/
/**
 * ESTA FUNCION ESTA PENDIENTE DE SI SE ESTA UTILIZANDO O SE QUITARA
 */
/*function agregar_relacion()
{
  var cfdi      = document.getElementById('cfdi_r').value;
  var trelacion = document.getElementById('trelacion').value;
  console.log("FUNCION AGREGAR RELACION");
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
      url: "CtrFactura/ajax_agregar_relacion",
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
}*/

// FUNCION QUE DA DE ALTA LA PRE FACTURA (MENU FACTURA)
$(function(){
  $("#generarPreFactura").on("submit", function(e){
    console.log("GENERANDO PRE FACTURA");
    e.preventDefault();
    var formData = new FormData(document.getElementById("generarPreFactura"));
    $.ajax({
      url: "CtrFactura/push_prefactura",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      $("#ntf-cliente").html(res);
      $('#btn-generar').attr("disabled", true);
    });
  });
});