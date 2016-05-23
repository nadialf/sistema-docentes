<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Mis constancias
        </a>
      </li>
      <li data-toggle="tab">
          <a href="#2b" data-toggle="tab">
            <i class="fa fa-list"></i>     Firmar constancias
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
          <table class="table table-responsive table-hover" id="mytable">
            <thead>
              <tr>
                <th id="actividad_header">Actividad</th>
                <th id="tipo_header">Tipo</th>
                <th id="progreso_header">Progreso</th>
                <th id="formato_header">Formato</th>
                <th id="estado_header">Estado</th>
              </tr>
            </thead>
            <?php foreach($query1 as $row){ ?>
            <tr>
              <td><?php echo $row->Nombre; ?></td>
              <td><?php echo $row->Tipo; ?></td>
              <td><?php echo $row->Avance; ?></td>
              
              <?php
              $this->load->database('default');
              $this->db->select('ID_Actividad, Fecha_Inicio, Fecha_Fin');
              $this->db->from('actividades');
              $query2 = $this->db->get();

              foreach ($query2->result() as $line) {
                $ID_Actividad = $line->ID_Actividad;

                $fecha = getdate();
                $fechaactual = "$fecha[year]-$fecha[mon]-$fecha[mday]";

                $fechahoy = new DateTime($fechaactual);
                $fechaini = new DateTime($line->Fecha_Inicio);
                $fechafin = new DateTime($line->Fecha_Fin);

                if ($fechahoy < $fechaini){
                  $progreso = "Por comenzar";
                } elseif ( ($fechahoy >= $fechaini) && ($fechahoy <= $fechafin) ){
                  $progreso = "En curso";
                } elseif ($fechahoy > $fechafin){
                   $progreso = "Terminada";
                }

                $datos = array('Avance' => $progreso);
                $this->db->where('ID_Actividad', $ID_Actividad);
                $this->db->update('asignaciones', $datos);
              }

                $this->db->distinct();
                $this->db->select('asignaciones.ID_Asignacion, asignaciones.Avance, asignaciones.ID_Trabajador, asignaciones.ID_Actividad, 
                  solicitudes.ID_Solicitud, solicitudes.Etapa, solicitudes.ID_Trabajador, solicitudes.ID_Actividad, solicitudes.Aceptada');
                $this->db->from('asignaciones');
                $this->db->where('asignaciones.ID_Trabajador', $row->ID_Trabajador);
                $this->db->where('asignaciones.ID_Asignacion', $row->ID_Asignacion);
                $this->db->where('asignaciones.ID_Actividad', $row->ID_Actividad);
                $this->db->join('solicitudes', 'solicitudes.ID_Actividad = asignaciones.ID_Actividad');
                $this->db->where('solicitudes.ID_Trabajador', $row->ID_Trabajador);
                $this->db->group_by('asignaciones.ID_Asignacion');
                $query3 = $this->db->get();

                if($query3->num_rows() > 0){
                  foreach ($query3->result() as $fila) {
                    
                    if ($fila->Etapa == 'Firmada'){
                       
                       $ruta = base_url().'constancias/formatoFirmaDownload3/'.$fila->ID_Solicitud;
                       $Archivo = "<a href='$ruta' class='btn-lg'><i class='glyphicon glyphicon-file' title='Descargar formato con firma'></i></a>"; ?>
                        
                        <td><?php echo $Archivo; ?></td>
                        <td><?php echo "<span style='color: #FF0000'>$fila->Etapa</span>"; ?></td> <?php

                    } elseif ($fila->Etapa == 'En proceso'){ ?>
                        <td></td>
                        <td><?php echo "<span style='color: #0000FF'>$fila->Etapa</span>"; ?></td> <?php
                    } elseif ($fila->Etapa == 'Aceptada'){ ?>
                        <td></td>
                        <td><?php echo "<span style='color: #31B404'>$fila->Etapa</span>"; ?></td> <?php
                    }
                  }
                } else { ?>
                    <td></td>
                    <td>
                      <?php
                      if ($row->Avance == 'Terminada') { ?>
                        <?=  form_open(base_url().'constancias/newSolicitud/'.$row->ID_Trabajador.'/'.$row->ID_Actividad)?>
                          <input type="submit"  value="Solicitar" class="btn btn-primary">
                        <?=form_close()?> <?php
                      } else { ?>
                          <?=  form_open()?>
                            <input type="submit" value="Solicitar" class="btn btn-primary disabled">
                          <?=form_close()?> <?php
                      } ?>
                    </td> <?php
                }?>
            </tr>
            <?php } ?>
          </table>
        </div> <!-- MIS CONSTANCIAS SECTION END -->

        <div class="tab-pane" id="2b">
        </br>
          <table class="table table-responsive table-hover">
            <thead>
              <tr>
                <th id="docente_header">Docente</th>
                <th id="tipo_header">Tipo</th>
                <th id="actividad_header">Actividad</th>
                <th>Formato con firma</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query as $row){ ?>
              <tr>
                <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
                <td><?php echo $row->Tipo; ?></td>
                <td><?php echo $row->Nombre; ?></td>
                
                <?php
                if ($row->Etapa == "Aceptada"){ ?>
                  <td></td>
                  <td>
                    <?=  form_open(base_url().'constancias/newConstancia/'.$row->ID_Solicitud)?>
                      <input type="submit"  value="Firmar" class="btn btn-primary">
                    <?=form_close()?>
                  </td> <?php
                } else {                  
                  $this->load->database('default');
                  $this->db->select('ID_Constancias, Formato, ID_Solicitud');
                  $this->db->where('ID_Solicitud', $row->ID_Solicitud);
                  $this->db->from('constancias');
                  $query2 = $this->db->get();

                  if($query2->num_rows() > 0){
                    foreach ($query2->result() as $fila) { ?>
                      <td> 
                        <?php 
                        $ruta = base_url().'constancias/formatoFirmaDownload/'.$row->ID_Solicitud;
                        $Archivo = "<a href='$ruta' class='btn-lg'><i class='glyphicon glyphicon-file' title='Descargar formato con firma'></i></a>";
                        echo $Archivo; ?>
                      </td>
                      <td></td>
                    <?php
                    }
                  }
                } ?>
              </tr>
            <?php } //END FOREACH ?>
          </table>
        </div> <!-- TABLA SECTION END -->


        <div class="tab-pane" id="3b">
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre del docente">
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
    $(".autocompletar").keyup(function(){
      var info = $(this).val();
      $.post('<?php echo base_url().'constancias/autocompletarB' ?>',{ info : info }, function(data){
        if(data != ''){
          $("#tableSearch").html(data);
        }else{
          $("#tableSearch").html('');
        }
      })
    })

    })
      function elimina(url){
        if (confirm("¿Está seguro que desea eliminar la solicitud?") ){
          location.href=url;
        }
      }
</script>

<script type="text/javascript">
  var table = $('#mytable');
    
    $('#docente_header, #tipo_header, #actividad_header')
        .wrapInner('<span title="sort this column"/>')
        .each(function(){
            var th = $(this),
                thIndex = th.index(),
                inverse = false;
            th.click(function(){
                table.find('td').filter(function(){
                    return $(this).index() === thIndex;
                }).sortElements(function(a, b){
                    return $.text([a]) > $.text([b]) ?
                        inverse ? -1 : 1
                        : inverse ? 1 : -1;
                }, function(){
                    // parentNode is the element we want to move
                    return this.parentNode;      
                });
                inverse = !inverse;     
            });                
        });
</script>

<script type="text/javascript">
$("#mytable tbody tr").mouseover(function() {
  $(this).addClass("tr_hover");
});

$("#mytable tbody tr").mouseout(function() {
  $(this).removeClass("tr_hover");
});
</script>