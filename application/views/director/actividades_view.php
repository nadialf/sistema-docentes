 <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#3b" data-toggle="tab">
            <i class="fa fa-list"></i>     Actividades registradas
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
        
        <div class="tab-pane active" id="3b">
        </br>
          <table class="table table-responsive" id="mytable">
            <thead>
              <tr>
                <th id="nombre_header">Nombre</th>
                <th id="tipo_header">Tipo</th>
                <th id="lugar_header">Lugar</th>
                <th id="fechaini_header">Fecha inicio</th>
                <th id="fechafin_header">Fecha fin</th>
                <th id="progreso_header">Progreso</th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
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
        </div> <!-- TABLA SECTION END -->

        <div class="tab-pane" id="2b">
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

  </div>  <!-- CONTENT-WRAPPER SECTION END-->


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
</script>

<script type="text/javascript">
  var table = $('table');
    
    $('#nombre_header, #tipo_header, #lugar_header, #fechaini_header, #fechafin_header, #progreso_header')
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