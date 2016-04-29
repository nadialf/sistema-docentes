<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
  <br>
    <div id="exTab3" class="tab">
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#1b" data-toggle="tab">
            <i class="fa fa-pencil"></i>     Edición de docente
          </a>
        </li>
      </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">
        
        <div class="tab-pane active" id="1b">
        <?php foreach ($query as $row) { ?>
          <?=  form_open(base_url().'docentes/updateDocente')?>
          <br>
          <h2 style="text-align:center;">Datos de cuenta y docente</h2>

          <input type="hidden" value="<?php echo $row->ID_Trabajador ?>" name="id" id="id">          
          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon">Nombre(s)</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="nombre" required 
                value="<?php echo $row->Nombres ?>">
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="paterno" required
                value="<?php echo $row->ApPaterno ?>">
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="materno" required
                value="<?php echo $row->ApMaterno ?>">
              </div>
            </div>
          </div>

          <br><br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon">Tipo de trabajador</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="tipot" required
                value="<?php echo $row->TipoTrabajo ?>">
              </div>

              <?php $userName = $row->Usuario;

                  if ( ($userName == 'Admin')  || ($userName == 'Director') ) {   ?>
                    <div class="col-xs-4">
                      <span class="input-group-addon">Nombre de usuario</span>
                      <input type="text" class="form-control" aria-describedby="sizing-addon2" name="user" required disabled 
                      value="<?php echo $userName ?>">
                    </div>
              <?php } else { ?>
                    <div class="col-xs-4">
                      <span class="input-group-addon">Nombre de usuario</span>
                      <input type="text" class="form-control" aria-describedby="sizing-addon2" name="user" id="user" required 
                      value="<?php echo $userName ?>">
                    </div>
              <?php } ?>

              <div class="col-xs-4">
                <span class="input-group-addon">Contraseña</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="contrasena" required
                value="<?php echo $row->Contrasena ?>">
              </div>
            </div>
          </div>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <input type="submit"  value="Guardar" class="btn btn-primary btn-lg pull-right" style="margin-top:20px; margin-bottom:20px; margin-right:40px;">
            </div>
          </div>

          <br>
          <?=form_close()?>
          <?php } ?>
        </div> <!-- EDICIÓN DOCENTE SECTION END -->

      </div>

    </div>

  </div> <!-- CONTENT-WRAPPER SECTION END-->

<script type="text/javascript">
  jQuery.noConflict();
  jQuery(document).ready(function() {
    jQuery("#datepicker").datepicker();
  });
</script>