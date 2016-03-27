<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>SAD</title>

 	<link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>css/jquery-ui.min.css" rel="stylesheet" />

    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body style="background-color:#e5e5e5;">
  <nav class="navbar navbar-default"> <!-- navbar-fixed-top" role="navigation"> -->
  	<div class="container-fluid">
  		<div class="navbar-header" style="margin:5px;">
  			<img src="assets/img/LogoFEI.png">
  		</div>
      	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav" style="margin:5px;">
            <li><a style="color:#FFF; font-size:45px;"> SAD</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <div style="color:#FFF;">
                    <i class="fa fa-user"></i>     Administrador
                    <span class="caret"></span>
                </div>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#">Perfil</a></li>
                <li role="separator" class="divider"></li>
                <li><a href="<?php echo base_url().'login/logout'?>">Cerrar Sesión</a></li>
              </ul>
            </li>
          </ul>
      </div>
    </div>
  </nav>
  


  <section class="menu-section">
    <div >
      <div class="row">
        <div class="col-md-12">
          <div class="navbar-collapse collapse ">
            <ul id="menu-top" class="nav navbar-nav navbar-right">
              <li>
             	<a href="">
                  <div>
                    <i class="fa fa-calendar"></i>     Actividades
                  </div>
                </a>
              </li>
              <li>
                <a href="">
                  <div>
                    <i class="fa fa-envelope"></i>     Correo
                  </div>
                </a>
              </li>
              <li>
                 <a href="">
                  <div>
                    <i class="fa fa-file-text-o"></i>     Constancias
                  </div>
                </a>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                  <div>
                      <i class="fa fa-users"></i>     Docentes
                      <span class="caret"></span>
                  </div>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="">Ver docentes</a></li>
                  <li><a href="">Asignaciones</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

<div class="clear"> </div>

<div style="text-align: center;   width:  100%;">

</br></br></br></br></br></br></br>
<h1>Bienvenido al</h1>
<h1>Sistema de Actividades de Docentes</h1>

</div>

<div class="clear"> </div>


<footer style="bottom: 0; width: 100%; position: fixed;">
	<div class="container">
	    <div class="row">
	        <div class="col-md-12 col-md-push-1">
	         	&copy; 2016 SISTEMA SAD | BY : <a href="http://www.uv.mx/Fei/" target="_blank">FEI UV</a>
	        </div>
	    </div>
    </div>
</footer>


</body>
</html>