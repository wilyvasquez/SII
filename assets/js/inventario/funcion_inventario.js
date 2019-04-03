/**
 * Funcion que agrega un nuevo articulo en el apartado de articulos
 * @return {HTML}     regresando el ajax de la tabla y la notificacion
 */
$(function(){
  $("#addinventario").on("submit", function(e){
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("addinventario"));
    // formData.append("dato", "valor");
    $.ajax({
        url: baseurl+"CtrInventario/put_inventario",
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
        //   url: "CtrFactura/"+json.url,
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
 * Funcion que agrega una nueva marca al catalogo
 * @return {HTML}     regresando el ajax del select y la notificacion
 */
$(function(){
  $("#addmarca").on("submit", function(e){
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("addmarca"));
    // formData.append("dato", "valor");
    $.ajax({
        url: baseurl+"CtrInventario/agregar_marca",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        $("#ntf-marca").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#ntf-marca").html("").delay(0).show(0);
        },2000); 
        $.ajax({
          url: "CtrInventario/"+json.url,
          type: "post",
          dataType: "html",
          data: null,
        })
        .done(function(response){
          $("#ajax-marca").html(response);
        });
      });
  });
});

/**
 * Funcion que agrega una nueva linea al catalogo
 * @return {HTML}     regresando el ajax del select y la notificacion
 */
$(function(){
  $("#addlinea").on("submit", function(e){
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("addlinea"));
    // formData.append("dato", "valor");
    $.ajax({
        url: baseurl+"CtrInventario/agregar_linea",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        $("#ntf-linea").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#ntf-linea").html("").delay(0).show(0);
        },2000); 
        $.ajax({
          url: "CtrInventario/"+json.url,
          type: "post",
          dataType: "html",
          data: null,
        })
        .done(function(response){
          $("#ajax-linea").html(response);
        });
      });
  });
});

/**
 * Funcion que agrega un nuevo fabricante al catalogo
 * @return {HTML}     regresando el ajax del select y la notificacion
 */
$(function(){
  $("#addfabricante").on("submit", function(e){
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("addfabricante"));
    // formData.append("dato", "valor");
    $.ajax({
        url: baseurl+"CtrInventario/agregar_fabricante",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        $("#ntf-fabricante").html(json.msg).delay(2000).hide(0);
        setTimeout(function(){ 
          $("#ntf-fabricante").html("").delay(0).show(0);
        },2000); 
        $.ajax({
          url: "CtrInventario/"+json.url,
          type: "post",
          dataType: "html",
          data: null,
        })
        .done(function(response){
          $("#ajax-fabricante").html(response);
        });
      });
  });
});

/**
 * Funcion que actualiza un articulo en el menu inventario
 */
$(function(){
  $("#upInventario").on("submit", function(e){
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("upInventario"));
    // formData.append("dato", "valor");
    $.ajax({
        url: baseurl+"CtrInventario/up_inventario",
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
 * Cerrar inventario
 */
$(function(){
  $("#cerrarInventarioDatos").on("submit", function(e){
    e.preventDefault();
    console.log("CERRAR INVENTARIO");
    var formData = new FormData(document.getElementById("cerrarInventarioDatos"));
    $.ajax({
        url: baseurl+"CtrInventario/cerrar_dinventario",
        type: "post",
        dataType: "html",
        data: formData,
        cache: false,
        contentType: false,
        processData: false
      })
      .done(function(res){
        var json = $.parseJSON(res);
        console.log(json.msg);
        if (json.num == 1) {
          $("#ntf-cIventario").html(json.url);
          $('#btn-guardarInventario').attr("disabled", true);
          $('#btn-gcotizacion').attr("disabled", true);          
        }else{
          console.log("entree");
          $("#ntf-cIventario").html(json.msg).delay(2000).hide(0);
          setTimeout(function(){ 
            $("#ntf-cIventario").html("").delay(0).show(0);
          },1000);          
        }
      });
  });
});

/**
 * 
 */
$(function(){
  $("#altaXml").on("submit", function(e){
    e.preventDefault();
    // var f = $(this);
    var formData = new FormData(document.getElementById("altaXml"));
    // formData.append("dato", "valor");
    $.ajax({
      url: baseurl+"CtrInventario/subir_xml",
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      beforeSend: function(){
        $("#mensaje").html("Subiendo articulos, espere...");
      }
    })
    .done(function(res){
        $("#mensaje").html(res);
    });
  });
});
