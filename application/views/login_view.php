<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<meta name="description" content="">
 	<meta name="author" content="">
 	
 	<title>SAC</title>

	<link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="assets/js/jquery-1.11.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/icon.png">

</head>

<body style="background: url('assets/img/fondo4.jpg') no-repeat fixed center center; background-size: cover;font-family: Roboto;" class="img-responsive">
  
<!-- Navigation -->
  <nav class="navbar navbar-default navbar-fixed">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll" style="margin:5px;">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
              </button>
              <img src="<?php echo base_url(); ?>assets/img/LogoSAC.png">
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-left" style="margin:10px;">
                  <li>
                    <a style="color:#FFF; font-size:45px;">
                      Sistema de Administración de Constancias
                    </a>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>

<div class="content-wrapper">
	<div class="container">
		<?=form_open(base_url().'login/new_login')?>
        <div class="login-block img-responsive center-block">
		    <h1>Bienvenido</h1>
		    <h2>Por favor introduzca su usuario y contraseña</h2>
            <div class="input-group margin-bottom-sm">
                <span class="input-group-addon"><i class="fa fa-user fa-fw"></i></span>
                <input class="form-control" type="text" name="usuario" placeholder="Usuario">
            </div>
        	<div class="input-group">
        		<span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
        		<input class="form-control" type="password" name="contrasena" placeholder="Contraseña">
    		</div>
    		<br>
    		<input type="submit" value="Ingresar" name="submit" class="sumbutL">
		</div>
        <?=form_close()?>
    </div>
</div>


<!-- CONTENT-WRAPPER SECTION END-->