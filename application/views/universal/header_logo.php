<!-- ADD THE CLASS fixed TO GET A FIXED HEADER AND SIDEBAR LAYOUT -->
<!-- the fixed layout is not compatible with sidebar-mini -->
<body class="hold-transition skin-blue fixed sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../../index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>ode</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>ERP</b> Code</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <span class="logo" style="width: auto">
        <?php 
          if (!empty($nombre)) {
           echo $nombre." - "."<b id='liveclock'></b>";
          }else{
  	        $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
  			    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
  			    echo $meses[date('n')-1]." ".date('d').", ". " ".date('Y')." "."<b id='liveclock'></b>";
          }
        ?>
      </span>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">