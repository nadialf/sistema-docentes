<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Nadia Libreros">
  <title>SAC</title>

  <link href="<?php echo base_url(); ?>assets/css/bootstrap.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/font-awesome.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" />
  <link href="<?php echo base_url(); ?>assets/css/jquery-ui.css" rel="stylesheet" />

  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/css/jquery-ui.js"></script>
  <script src="//rawgit.com/padolsey/jQuery-Plugins/master/sortElements/jquery.sortElements.js"></script>

  <link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/icon.png">

</head>

<body style="background-color:#e5e5e5;">

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

          <?php foreach($query as $row){ ?>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right" style="margin:10px;">
                  <li>
                    <a href="<?php echo base_url().'actividades/act_direc/'.$row->ID_Trabajador ?>">
                      <div style="color:#FFF;">
                        <i class="fa fa-calendar"></i>     Actividades
                      </div>
                    </a>
                  </li>
                  <li>
                     <a href="<?php echo base_url().'correo/mail_direc/'.$row->ID_Trabajador?>">
                      <div style="color:#FFF;">
                        <i class="fa fa-envelope"></i>     Mensajes
                      </div>
                    </a>
                  </li>
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <div style="color:#FFF;">
                          <i class="fa fa-file-text-o"></i>     Constancias
                          <span class="caret"></span>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url().'constancias/mis_cons_direc/'.$row->ID_Trabajador ?>" style="color:#FFF;">Mis constancias</a></li>
                      <li><a href="<?php echo base_url().'constancias/cons_direc/'.$row->ID_Trabajador ?>" style="color:#FFF;">Firmar constancias</a></li>
                    </ul>
                  </li>
                  <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                      <div style="color:#FFF;">
                        <i class="fa fa-user"></i>     Director
                          <span class="caret"></span>
                      </div>
                    </a>
                    <ul class="dropdown-menu">
                      <li><a href="<?php echo base_url().'login/logout'?>" style="color:#FFF;">Cerrar sesión</a></li>
                    </ul>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
          <?php } ?>
      </div>
      <!-- /.container-fluid -->
  </nav>