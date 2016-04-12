<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
  <br>
  <div id="exTab3" class="tab">

    <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Actividades registradas 
        </a>
      </li>
      <li data-toggle="tab">
        <a href="#2b" data-toggle="tab">
          <i class="fa fa-plus"></i>     Nueva actividad
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
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Lugar</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
              <tr>
                <td><?php echo $row->Nombre; ?></td>
                <td><?php echo $row->Tipo; ?></td>
                <td><?php echo $row->Lugar; ?></td>
                <td><?php echo $row->Fecha_Inicio; ?></td>
                <td><?php echo $row->Fecha_Fin; ?></td>
                <td>
                  <a href='#' onclick="editar('<?=base_url()?>actividades/modificar/<?=$row->ID_Actividad?>');"><i class='glyphicon glyphicon-pencil'></i></a>
                </td>
                <td>
                  <a href='#' onclick="elimina('<?=base_url()?>actividades/delete/<?=$row->ID_Actividad?>');"><i class='glyphicon glyphicon-trash'></i></a>
                </td>
              </tr>
            <?php endforeach; ?>
          </table>
        </div> <!-- ACTIVIDADES REGISTRASTAS SECTION END -->

        
        <div class="tab-pane" id="2b">
          <?=  form_open(base_url().'actividades/agregarActividad')?>
          <br>
          <h2 style="text-align:center;">Datos de la actividad</h2>
          
          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon">Nombre de la actividad</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="nombre" required>
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon" id="sizing-addon2">Tipo de actividad</span>
                <select class="form-control" value="tipo" id="tipo" required>
                  <option></option>
                  <option value="Conferencia" name="Conferencia">Conferencia</option>
                  <option value="Congreso" name="Congreso">Congreso</option>
                  <option value="Festival" name="Festival">Festival</option>
                  <option value="Proyecto" name="Proyecto">Proyecto</option>
                  <option value="Taller" name="Taller">Taller</option>
                </select>
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Lugar</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="lugar" required>
              </div>
            </div>
          </div>

          <br><br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon" id="sizing-addon2">Fecha inicio</span>
                <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechaini" required>
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon" id="sizing-addon2">Fecha fin</span>
                <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechafin" required>
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
        </div> <!-- NUEVA ACTIVIDAD SECTION END -->


        <div class="tab-pane" id="3b">
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre de la actividad">
            <br/>
          </div>
          <table class="table table-hover table-responsive" id="tableSearch">
          </table>
        </div> <!-- BÚSQUEDA SECTION END -->

      </div>

    </div>

  </div> <!-- CONTENT-WRAPPER SECTION END-->

  <script type="text/javascript">
    $(document).ready(function(){
    //utilizamos el evento keyup para coger la información
    //cada vez que se pulsa alguna tecla con el foco en el buscador
    $(".autocompletar").keyup(function(){
    //alert("Hello! I am an alert box!!");
    //en info tenemos lo que vamos escribiendo en el buscador
      var info = $(this).val();
      //hacemos la petición al método autocompletado del controlador home
      //pasando la variable info
      $.post('<?php echo base_url().'actividades/autocompletarB' ?>',{ info : info }, function(data){
        //si autocompletado nos devuelve algo
        if(data != ''){
          //$('.contenedor').show();
          $("#tableSearch").html(data);
        }else{
          $("#tableSearch").html('');
        }
      })
    })

    })
      function elimina(url){
        if (confirm("¿Está seguro que desea eliminar la actividad?") ){
          location.href=url;
        }
      }
      function editar(url){
        location.href=url;
      }
    </script>