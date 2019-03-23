<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?= base_url()?>plantilla/creditos/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
   <style type="text/css">
    hr { 
     border-top: 2px solid #D3CECE; 
     border-bottom: 2px solid #D3CECE; 
     border-left:none; 
     border-right:none; 
     height: 6px; 
    }
   </style>
</head>
<body>
<div class="col-md-12" style="background-color: #CD2114; margin-top: 5px; width: 700px;font: 100% sans-serif;">
  <div><br>
   <center><font style="margin-top: 10PX" size="5" color="white">Hola, <?= $nombre ?></font></center>
  </div>
  <br>
</div>
<div class="col-md-12">
  <img width="700" src="<?= base_url()?>assets/img/facturacion.png">
</div>
<div style="width: 700px;font: 100% sans-serif;">
  <p>Factura: <a href="https://app.facturadigital.com.mx/docs/pdf/<?= $uuid ?>" target="_blank">Descargar Factura</a></p>
  <p>XML: <a href="https://app.facturadigital.com.mx/docs/xml/SAOA890320M87/<?= $uuid ?>" target="_blank">Descargar XML</a></p>
  <hr>
  <font size="1"><strong>ATRUM MOTORS DE MEXICO S.A DE C.V</strong></font>
  <font style="margin-left: 340px" size="1"><strong>Todos los derechos reservados</strong></font>
  <p size="3" style="text-align: justify;">Estimado cliente, este es un correo de envio de facturas generadas a su nombre y correo registrado en nuestros sistemas.</p>
</div>
<div style="width: 700px;font: 70% sans-serif;text-align: justify;">
  <hr>
  <p>
    Aviso Legal: El contenido de este mensaje de datos es una COMUNICACIÓN PRIVADA, SECRETA Y CONFIDENCIAL, y se entiende dirigido y para uso exclusivo del destinatario, por lo que no podrá distribuirse y/o difundirse por ningún medio sin la previa autorización del emisor original. Si usted no es el destinatario, se le prohíbe su utilización total o parcial para cualquier fin. El emisor de este correo, la empresa a nombre de quien se emita este correo y la empresa titular de la cuenta, NO AUTORIZAN al destinatario o a cualquier persona que por error tenga acceso al mismo, a usarlo como medio de prueba, en ningún tipo de procedimiento legal.
  </p>
</div>
<!-- jQuery 2.2.3 -->
<script src="<?= base_url()?>plantilla/creditos/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?= base_url()?>plantilla/creditos/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>