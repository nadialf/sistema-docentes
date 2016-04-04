<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
  <br>
    <div id="exTab3" class="tab">
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#1b" data-toggle="tab">
            <i class="fa fa-pencil"></i>     Edición de actividad
          </a>
        </li>
      </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">

        <div class="tab-pane active" id="1b">
          <?=  form_open(base_url().'actividades/updateActividad')?>
          <br>
          <h2 style="text-align:center;">Datos de la actividad</h2>
          
          <input type="hidden" value="<?php echo $query['0']->ID_Actividad ?>" name="id" id="id">
          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon">Nombre de la actividad</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="nombre" required
                      value="<?php echo $query['0']->Nombre ?>">
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Tipo de actividad</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="tipo" required
                      value="<?php echo $query['0']->Tipo ?>">
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Lugar</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="lugar" required
                      value="<?php echo $query['0']->Lugar ?>">
              </div>
            </div>
          </div>

          <br><br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon" id="sizing-addon2">Fecha inicio</span>
                <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechaini"  
                      required value="<?php echo $query['0']->Fecha_Inicio ?>">
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon" id="sizing-addon2">Fecha fin</span>
                <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechafin" 
                      required value="<?php echo $query['0']->Fecha_Fin ?>">
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
        </div> <!-- EDICIÓN ACTIVIDAD SECTION END -->

      </div>

    </div>

  </div> <!-- CONTENT-WRAPPER SECTION END-->

<script type="text/javascript">
  jQuery.noConflict();
  jQuery(document).ready(function() {
    jQuery("#datepicker").datepicker();
  });
</script>