// Funcion que agrega un nuevo articulo en el apartado de articulos para timbrado Factura y nota de credito
$(function(){
  $("#agregar_articulo").on("submit", function(e){
    e.preventDefault();
    $('#btn-articulo').attr("disabled", true);
    console.log("AGREGAR ARTICULO FACTURA, NOTA DE CREDITO");
    var formData = new FormData(document.getElementById("agregar_articulo"));
    // ids = document.getElementById('ids').value;
    par =
    {
      "ids" : document.getElementById('ids').value
    }
    $.ajax({
      url: "../CtrUniversal/push_articulo",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res)
    {
      var json = $.parseJSON(res);
      $("#ntf-cliente").html(json.msg).delay(2000).hide(0);
      ajax_tarticulos(json,par);
      ajax_precios(par);
    });
  });
});
////////////////////////////////////////////////////////////////////////////////

$(document).on("click", ".open-Modal", function () {
  var venta = $(this).data('venta');
  $(".modal-body #venta").val( venta );
});

/**
 * Funcion que valida el timbrado para generar la factura 
 */
$(function(){
  $("#timbrar").on("submit", function(e){
    console.log("TIMBRAR FACTURA");
    e.preventDefault();
    // var ids        = document.getElementById('ids').value;
    // var id_cliente = document.getElementById('id_cliente').value;
    // var activo     = document.getElementById('activos').checked;
    var par = 
    {
      "ids"  : document.getElementById('ids').value,
      "id_cliente"  : document.getElementById('id_cliente').value,
      "activo"  : document.getElementById('activos').checked,
    };
    $.ajax({
      url: "../CtrTimbrarFactura/timbrado",
      type: "post",
      dataType: "html",
      data: par,
      beforeSend: function(){
        $("#resultado").html("Generando factura, espere por favor");
        $('#btn-limpiar').attr("disabled", true);
        $('#btn-articulo').attr("disabled", true);
        $('#btn-actualizar').attr("disabled", true);
        $('#btn-eliminar').attr("disabled", true);
        $('#btn-delete').attr("disabled", true);
        $('#btn-adduuid').attr("disabled", true);
      },
      success: function(response) {
        $('#btn-timbrar').attr("disabled", true);
        $('#ocultarUUID').hide(0);
        var json = $.parseJSON(response);
        $("#resultado").html(json.btn);
        $("#tbl-articulo").html(json.msg);
      }
    })
  });
});

/**
 * obtenemos el costo de cada producto seleccionado en el formulario de agregar productos
 * @return retornamos en costo en el input
 */
function valorUnitario()
{
  // var codigo = document.getElementById('codigo').value;
  $('#cantidad').attr("disabled", false);
  $('#descripcion').attr("disabled", false);
  console.log("VALOR UNITARIO");
  var par = 
  {
    "codigo"  : document.getElementById('codigo').value,
  };
  $.ajax({
    url: "../CtrUniversal/get_valorUnitario",
    type: "post",
    dataType: "html",
    data: par,
  })
  .done(function(response)
  {
    var json = $.parseJSON(response);
    $("#costo").val(json.importe);
    $("#descripcion").val(json.msg);
  });
}
/*FIN VALOR UNITARIO*/
/**
 * OBTENEMOS EL IMPORTE DEL PRODUCTO MULTIPLICACION DE LA CANTIDAD POR UNIDAD
 * @return OBTENEMOS EL IMPORTE EN EL INPUT
 */
function importe()
{
  // var cantidad = document.getElementById('cantidad').value;
  // var costo    = document.getElementById('costo').value;
  console.log("IMPORTE");
  var par = 
  {
    "cantidad"  : document.getElementById('cantidad').value,
    "costo"   : document.getElementById('costo').value,
  };
  $.ajax({
    url: "../CtrUniversal/get_importe",
    type: "post",
    dataType: "html",
    data: par,
  })
  .done(function(response){
    var json = $.parseJSON(response);
    $("#importes").val(json.importe);
  });
}
/*FIN IMPORTE*/

///////////////// LIMPIAR FORMULARIO ARTICULOS ////////////////////////////////////    
$('#btn-limpiar').click(function(){
  $('#btn-articulo').attr("disabled", false);
console.log("activar boton");
});
/**
 * INICIO DE LOS MODALES ELIMINAR Y EDITAR
 */
$(document).on("click", ".open-Editar", function () {
  var cantidad = $(this).data('cant');
  $(".modal-body #cantidad").val( cantidad );
  var articulo = $(this).data('idar');
  $(".modal-body #articulo").val( articulo );
  var codigo = $(this).data('cod');
  $(".modal-body #codigo").val( codigo );
  var descuento = $(this).data('descu');
  $(".modal-body #descuento").val( descuento );

  if (document.getElementById("codigos")) 
  {
    document.getElementById("codigos").innerHTML = codigo;
  }

  var descripcion = $(this).data('des');
  $(".modal-body #descripcion").val( descripcion );
  var idArticulo = $(this).data('arti');
  $(".modal-body #idArticulo").val( idArticulo );

  var costo = $(this).data('costo');
  $(".modal-body #costo").val( costo );
});

// INICIO DE LOS MODALES ELIMINAR Y EDITAR
$(document).on("click", ".open-uuid", function () {
  var uuid = $(this).data('uuid');
  $(".modal-body #uuid").val( uuid );
});


/**
 * FUNCIONA QUE ELIMINA UN ARTICULO DE LA TABLA QUE SE AGREGARON AL CLIENTE
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#deletearticulo").on("submit", function(e){
    console.log("ELIMINAR ARTICULO");
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("deletearticulo"));
    par =
    {
      "ids" : document.getElementById('ids').value
    }
    $.ajax({
      url: "../CtrUniversal/eliminar_articulo",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      var json = $.parseJSON(res);
      $("#borrado").html(json.msg).delay(1000).hide(0);
       ajax_tarticulos(json,par);
       ajax_precios(par);
    });
  });
});

/**
 *FUNCION QUE EDITA EN EL MODAL DATOS DEL ARTICULO QUE SE ENCUENTRA EN LA TABLA
 * @return regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#editarArticulo").on("submit", function(e){
    console.log("EDITAR ARTICULO");
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("editarArticulo"));
    par =
    {
      "ids" : document.getElementById('ids').value
    }
    $.ajax({
      url: "../CtrUniversal/editar_articulo",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      var json = $.parseJSON(res);
      $("#editado").html(json.msg).delay(1000).hide(0);
      ajax_precios(par);
      ajax_tarticulos(json,par);
    });
  });
});
/**
 * [ajax_precios description]
 * @param  {[type]} par [description]
 * @return {[type]}     [description]
 */
function ajax_precios(par)
{
  console.log("AJAX PRECIOS");
  $.ajax({
    url: "../CtrUniversal/ajax_precios",
    type: "post",
    dataType: "html",
    data: par,
  })
  .done(function(response){
    $("#ajaxprecio").html(response);
  });
}

function ajax_tarticulos(json,par)
{
  console.log("AJAX TABLA ARTICULOS");
  $.ajax({
    url: "../CtrUniversal/"+json.url,
    type: "post",
    dataType: "html",
    data: par,
  })
  .done(function(response){
    $("#tbl-articulo").html(response);
    setTimeout(function(){ 
      $('#deleteModal').modal('hide');
      $("#editado").html("").delay(0).show(0);
      $("#borrado").html("").delay(0).show(0);
    },1000); 
  });
}

// FUNCION EN FUNCIONAMIENTO PARA ELIMINAR RELACCION UUID (POSIBLE MOVERLO)
$(function(){
  $("#deleteuuid").on("submit", function(e){
    e.preventDefault();
    console.log("ELIMINAR UUID");
    var formData = new FormData(document.getElementById("deleteuuid"));
    $.ajax({
      url: "../CtrUniversal/delete_uuid",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      $("#tbl-uuid").html(res);
      setTimeout(function(){ 
        $('#modaldelete').modal('hide');
      },500);
    });
  });
});

// FUNCION PARA ACTUALIZAR DATOS DEL CLIENTE
$(function(){
  $("#updateCliente").on("submit", function(e){
    e.preventDefault();
    console.log("ACTUALIZAR CLIENTE");
    var formData = new FormData(document.getElementById("updateCliente"));
    $.ajax({
      url: "../CtrClientes/update_cliente",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false
    })
    .done(function(res){
      var json = $.parseJSON(res);
      $("#upd-cliente").html(json.msg);
    });
  });
});