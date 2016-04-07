<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
  <br>
  <div id="exTab3" class="tab"> 

    <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Asignaciones registradas 
        </a>
      </li>
      <li data-toggle="tab">
        <a href="#2b" data-toggle="tab">
          <i class="fa fa-plus"></i>     Nueva asignación
        </a>
      </li>
      <li data-toggle="tab">
        <a href="#3b" data-toggle="tab">
          <i class="glyphicon glyphicon-search"></i>     Búsqueda
        </a>
      </li>
    </ul>

    <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">
        
        <div class="tab-pane active" id="1b">
          </br>
          <table class="table">
            <thead>
              <tr>
                <th>Docente</th>
                <th>Tipo</th>
                <th>Actividad</th>
                <th>Fecha de incorporación</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
            <tr>
              <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
              <td><?php echo $row->Tipo; ?></td>
              <td><?php echo $row->Nombre; ?></td>
              <td><?php echo $row->Fecha_Incorporacion; ?></td>
              <td>
                <a href='#' onclick="editar('');"><i class='glyphicon glyphicon-pencil'></i></a>
              </td>
              <td>
                <a href='#' onclick="elimina('');"><i class='glyphicon glyphicon-trash'></i></a>
              </td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div>
          


        <div class="tab-pane" id="2b">

        <?=  form_open(base_url().'actividades/agregar')?>
          <br>
          <h2 style="text-align:center;">Datos de asignación</h2>
          
          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-8 ui-widget">
                <span class="input-group-addon" id="sizing- addon2">Docente</span>
                  <input type="text" class="form-control" aria-describedby="sizing-addon2" name="docente" id="docente" required="required">
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Tipo de actividad</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="tipo" required>
              </div>
            </div>
          </div>

          <br><br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon">Actividad</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="actividad" required>
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon" id="sizing-addon2">Fecha de incorporación</span>
                <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fecha" required>
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
        </div> <!--NUEVA ASIGNACIÓN SECTION END -->



        <div class="tab-pane" id="3b">
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre del docente o actividad">
            <br/>
          </div>
          <table class="table table-hover table-responsive" id="tableSearch">
          </table>
        </div> <!-- BÚSQUEDA SECTION END -->

      </div>
    </div>
  </div> <!-- CONTENT-WRAPPER SECTION END-->

<script>
    $(document).ready(function($){

     $('#docente').autocomplete({
      source:'<?php echo base_url('asignaciones/showDocentes');?>',
      minLength:1,
      // optional
      html: true,

      // optional (if other layers overlap the autocomplete list)
      open: function(event, ui) {
       $(".ui-autocomplete").css("z-index", 1000);
      }
     });
    });
</script>

<script type="text/javascript">
  jQuery(document).ready(function() {
      jQuery("#datepicker").datepicker();
  });
</script>