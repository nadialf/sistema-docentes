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

<body style="background: url('assets/img/fondo4.jpg') no-repeat fixed center center; background-size: cover;font-family: Roboto;">

<header>
  
<nav class="navbar navbar-default"> <!-- navbar-fixed-top" role="navigation"> -->
  	<div class="container-fluid">
  		<div class="navbar-header" style="margin:5px;">
  			<img src="assets/img/LogoFEI.png">
  		</div>
  		<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    		<ul class="nav navbar-nav" style="margin:5px;">
    			<li><a style="color:#FFF; font-size:45px;"> Sistema de Administración de Constancias</a></li>
        	</ul>
    	</div><!-- /.navbar-collapse -->
  	</div><!-- /.container-fluid -->
</nav>

</header>

<div class="clear"></div> <!-- MENU SECTION END-->


<div class="content-wrapper">
	<div class="container">
		<?=form_open(base_url().'login/new_login')?>
        <div class="login-block">
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