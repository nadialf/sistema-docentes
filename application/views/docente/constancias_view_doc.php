 <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Solicitudes de constancias 
        </a>
      </li>
      <li data-toggle="tab">
          <a href="#2b" data-toggle="tab">
            <i class="glyphicon glyphicon-search"></i>     Búsqueda
          </a>
        </li>
    </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">

        <div class="tab-pane active" id="1b">
        </br>
          <table class="table table-responsive table-hover mytable" id="mytable">
            <thead>
              <tr>
                <th id="actividad_header">Actividad</th>
                <th id="tipo_header">Tipo</th>
                <th id="progreso_header">Progreso</th>
                <th id="formato_header">Formato</th>
                <th id="estado_header">Estado</th>
              </tr>
            </thead>
            <?php foreach($query as $row){ ?>
            <tr>
              <td><?php echo $row->Nombre; ?></td>
              <td><?php echo $row->Tipo; ?></td>
              <td><?php echo $row->Avance; ?></td>
              
              <?php
              $this->load->database('default');
              $this->db->select('ID_Actividad, Fecha_Inicio, Fecha_Fin');
              $this->db->from('actividades');
              $query1 = $this->db->get();

              foreach ($query1->result() as $line) {
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
                $query2 = $this->db->get();

                if($query2->num_rows() > 0){
                  foreach ($query2->result() as $fila) {
                    
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
        </div> <!-- TABLA SECTION END -->


        <div class="tab-pane" id="2b">
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

<br><br><br>

  <script type="text/javascript">
    $(document).ready(function(){
    $(".autocompletar").keyup(function(){
      var info = $(this).val();
      $.post('<?php echo base_url().'constancias/autocompletarC/'.$this->uri->segment(3) ?>',{ info : info }, function(data){
        if(data != ''){
          $("#tableSearch").html(data);
        }else{
          $("#tableSearch").html('');
        }
      })
    })

    })

      function formatDOW(url){
        location.href=url;
      }
</script>

<script type="text/javascript">
  var table = $('.mytable');
    
    $('#actividad_header, #tipo_header, #progreso_header, #formato_header, #estado_header')
        .wrapInner('<span title="Ordenar esta columna"/>')
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
                    return this.parentNode;      
                });
                inverse = !inverse;     
            });                
        });
</script>