  <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>        Todos los avances 
        </a>
      <li data-toggle="tab">
        <a href="#2b" data-toggle="tab">
          <i class="glyphicon glyphicon-search"></i>     Búsqueda
        </a>
      </li>
    </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">
        </br>
        <div class="tab-pane active" id="1b">
          <table class="table" id="mytable">
            <thead>
              <tr>
                <th id="docente_header">Docente</th>
                <th id="tipo_header">Tipo</th>
                <th id="actividad_header">Actividad</th>
                <th id="fechainc_header">Fecha de inicio</th>
                <th id="progreso_header">Progreso</th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
            <tr>
              <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
              <td><?php echo $row->Tipo; ?></td>
              <td><?php echo $row->Nombre; ?></td>
              <td><?php echo $row->Fecha_Inicio; ?></td>
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
            <?php endforeach; ?>
          </table>
        </div> <!-- TABLE SECTION END -->


        <div class="tab-pane" id="2b">
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre del docente, tipo, actividad o progreso">
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
      $.post('<?php echo base_url().'avances/autocompletar' ?>',{ info : info }, function(data){
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
    
    $('#docente_header, #tipo_header, #actividad_header, #fechainc_header, #progreso_header')
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