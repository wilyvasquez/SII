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
function show5()
{
    if (!document.layers&&!document.all&&!document.getElementById)
    return
      var Digital=new Date()
      var hours=Digital.getHours()
      var minutes=Digital.getMinutes()
      var seconds=Digital.getSeconds()
      var dn="PM"
    if (hours<12)
    {
      dn="AM";
    }
    if (hours>12)
    {
      hours=hours-12;
    }
    if (hours==0)
    {
      hours=12;
    }
    if (minutes<=9){
      minutes="0"+minutes;
    }
    if (seconds<=9)
    {
     seconds="0"+seconds
    }
    //change font size here to your desire
    myclock=hours+":"+minutes+":"+seconds+" "+dn;
    if (document.layers){
      document.layers.liveclock.document.write(myclock)
      document.layers.liveclock.document.close()
    }
    else if (document.all)
    {
      liveclock.innerHTML=myclock;          
    }
    else if (document.getElementById){
      document.getElementById("liveclock").innerHTML=myclock;
      setTimeout("show5()",1000);
    }
}
window.onload=show5