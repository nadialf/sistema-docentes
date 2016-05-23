<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
  <br>
  <div id="exTab3" class="tab">

    <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Mis actividades 
        </a>
      </li>
      <li data-toggle="tab">
          <a href="#2b" data-toggle="tab">
            <i class="fa fa-list"></i>     Todas las actividades
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
                <th id="nombre_header">Nombre</th>
                <th id="tipo_header">Tipo</th>
                <th id="lugar_header">Lugar</th>
                <th id="fechaini_header">Fecha inicio</th>
                <th id="fechafin_header">Fecha fin</th>
                <th id="progreso_header">Progreso</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query1 as $row): ?>
            <tbody style="cursor: pointer;" onclick="show('<?php echo $row->ID_Actividad ?>');">
              <tr>
                <td><?php echo $row->Nombre; ?></td>
                <td><?php echo $row->Tipo; ?></td>
                <td><?php echo $row->Lugar; ?></td>
                <td><?php echo $row->Fecha_Inicio; ?></td>
                <td><?php echo $row->Fecha_Fin; ?></td>
                <td><?php 
                          if ($row->Avance == "Por comenzar"){
                            echo "<span style='color: #0000FF'>$row->Avance</span>";
                          } elseif ($row->Avance == "En curso"){
                            echo "<span style='color: #31B404'>$row->Avance</span>";
                          } elseif ($row->Avance == "Terminada"){
                            echo "<span style='color: #FF0000'>$row->Avance</span>";
                          }
                ?>
                </td>
                <td>
                  <a href='#' onclick="elimina('<?=base_url()?>asignaciones/delete2/<?=$row->ID_Asignacion?>/<?=$row->ID_Trabajador?>/<?=$row->ID_Actividad?>');"><i class='glyphicon glyphicon-trash' title='Eliminar asignación'></i></a>
                </td>
              </tr>
              <tr id="<?php echo $row->ID_Actividad ?>" style="display: none; background-color: #F5f5F5;">
                <td colspan=7><?php echo $row->Descripcion; ?></td>
              </tr>
              </tbody>
            <?php
            endforeach; ?>
          </table>
        </div> <!-- MIS ACTIVIDADES SECTION END -->

        <div class="tab-pane" id="2b">
        </br>
          <table class="table table-responsive table-hover">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Lugar</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Progreso</th>
              </tr>
            </thead>
            <?php foreach($query2 as $row): ?>
            <tbody style="cursor: pointer;" onclick="show('<?php echo $row->ID_Actividad ?>');">
              <tr>
                <td><?php echo $row->Nombre; ?></td>
                <td><?php echo $row->Tipo; ?></td>
                <td><?php echo $row->Lugar; ?></td>
                <td><?php echo $row->Fecha_Inicio; ?></td>
                <td><?php echo $row->Fecha_Fin; ?></td>
                <td><?php 
                          if ($row->Avance == "Por comenzar"){
                            echo "<span style='color: #0000FF'>$row->Avance</span>";
                          } elseif ($row->Avance == "En curso"){
                            echo "<span style='color: #31B404'>$row->Avance</span>";
                          } elseif ($row->Avance == "Terminada"){
                            echo "<span style='color: #FF0000'>$row->Avance</span>";
                          }
                ?>
                </td>
              </tr>
              <tr id="<?php echo $row->ID_Actividad ?>" style="display: none; background-color: #F5f5F5;">
                <td colspan=6><?php echo $row->Descripcion; ?></td>
              </tr>
            </tbody>
            <?php
            endforeach; ?>
          </table>
        </div> <!-- TODAS LAS ACTIVIDADES SECTION END -->

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
    $(".autocompletar").keyup(function(){
      var info = $(this).val();
      $.post('<?php echo base_url().'actividades/autocompletar' ?>',{ info : info }, function(data){
        if(data != ''){
          $("#tableSearch").html(data);
        }else{
          $("#tableSearch").html('');
        }
      })
    })

    })
      
  function elimina(url){
    if (confirm("¿Está seguro que desea eliminar su asignación a esta actividad?") ){
      location.href=url;
    }
  }
</script>

<script type="text/javascript">
function show(id) {
  if (!document.getElementById) return false;
  fila = document.getElementById(id);
  if (fila.style.display != "none") {
    fila.style.display = "none"; //ocultar fila 
  } else {
    fila.style.display = ""; //mostrar fila 
  }
}
</script>

<script type="text/javascript">
  var table = $('#mytable');
    
    $('#nombre_header, #tipo_header, #lugar_header, #fechaini_header, #fechafin_header, #progreso_header')
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