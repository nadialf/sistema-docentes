<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SAC</title>

  <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" />

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/css/jquery-ui.js"></script>
  <script src="//rawgit.com/padolsey/jQuery-Plugins/master/sortElements/jquery.sortElements.js"></script>
  <!-- <script src='https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js'></script> -->

  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/icon.png">

</head>

<body style="background-color:#e5e5e5;">
  <nav class="navbar navbar-default"> <!-- navbar-fixed-top" role="navigation"> -->
    <div class="container-fluid">
      <div class="navbar-header" style="margin:5px;">
        <img src="<?php echo base_url(); ?>assets/img/LogoFEI.png">
      </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav" style="margin:5px;">
            <li><a style="color:#FFF; font-size:45px;"> SAC</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <div style="color:#FFF;">
                    <i class="fa fa-user"></i>     Director
                    <span class="caret"></span>
                </div>
              </a>
              <ul class="dropdown-menu">
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
             	<a href="<?php echo base_url().'actividades/act_direc'; ?>">
                  <div>
                    <i class="fa fa-calendar"></i>     Actividades
                  </div>
                </a>
              </li>
              <li>
                <a href="<?php echo base_url().'constancias/cons_direc'; ?>">
                  <div>
                    <i class="fa fa-file-text-o"></i>     Constancias
                  </div>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

<div class="clear"> </div>