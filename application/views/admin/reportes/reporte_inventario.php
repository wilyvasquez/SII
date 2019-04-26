<!DOCT<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		.ancho{
			width: 380px;
			font-weight:bold;
			font-size: 12px;
		}
		.pie{
			width: 320px;
			font-weight:bold;
			font-size: 12px;
		}
		.alto{
			margin-top: 10px
		}
		.img{
			font-family: Helvetica;
			background-repeat: no-repeat;
			background-position: center 250px;
		}
	</style>
</head>
<body class="img" background="<?= base_url() ?>assets/img/logo_suzuki_2.png">
	<?php 
		$rutaimg  = "assets/img/nombre-atrum.jpg";
		$logo     = "assets/img/logo_suzuki.jpg";
		$rutaimg2 = "assets/img/direccion_oaxaca.jpg";
		$lugar 	  = "Oaxaca de Juarez, Oaxaca, ".date("Y-m-d"); 
	?>
	<img src="./<?= $rutaimg ?>" style="margin-top: 20px">
	<img src="./<?= $logo ?>" width="200" style="margin-left: 80px">
	<p style="text-align: right;font-family: sans-serif;"><?= $lugar ?></p>
	<div style="margin-left: 100px; background: red">
		<table>
			<tr>
				<td style="width: 200px">hola</td>
				<td style="width: 200px">hola</td>
				<td style="width: 200px">hola</td>
			</tr>
			<tr>
				<td>PROVEEDOR</td>
				<td>FACTURA</td>
				<td>FECHA CAPTURA</td>
			</tr>
		</table>		
	</div>
	<!-- <center>
		<img src="./<?= $rutaimg2 ?>" width="400" style="margin-top: 850px; margin-left: 140px; background-attachment: fixed;">
	</center> -->
</body>
</html>