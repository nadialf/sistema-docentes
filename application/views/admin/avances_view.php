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
      <li data-toggle="tab">
        <a href="#3b" data-toggle="tab">
          <i class="glyphicon glyphicon-stats"></i>     Reportes
        </a>
      </li>
    </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">
        </br>
        <div class="tab-pane active" id="1b">
          <table class="table table-responsive" id="mytable">
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

        <div class="tab-pane" id="3b">
        <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
            <div id="exTab2" class="tab">
              <ul class="nav nav-pills">
                <li>
                  <a href="#pdocente" data-toggle="tab">
                    <i class="glyphicon glyphicon-user"></i>     Por docente
                  </a>
                </li>
                <li>
                  <a href="#pperiodo" data-toggle="tab">
                    <i class="glyphicon glyphicon-time"></i>     Por periodo
                  </a>
                </li>
                <li>
                  <a href="#pprogreso" data-toggle="tab">
                    <i class="glyphicon glyphicon-play"></i>     Por progreso
                  </a>
                </li>
                <li>
                  <a href="#ptipo" data-toggle="tab">
                    <i class="glyphicon glyphicon-asterisk"></i>     Por tipo
                  </a>
                </li>
              </ul>
            </div>
          </div>

          <div class="tab-content clearfix">
            <div class="tab-pane" id="pdocente">
              <?=  form_open(base_url().'avances/newReportDocente')?>
              <br>
              <h2 style="text-align:center;">Reporte por docente</h2>
                
              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <div class="col-xs-8 ui-widget">
                    <span class="input-group-addon" id="sizing- addon2">Docente</span>
                    <input type="text" class="form-control" aria-describedby="sizing-addon2" name="docente" id="docente" required>
                  </div>
                </div>
              </div>

              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <input type="submit"  value="Crear reporte" class="btn btn-primary btn-lg pull-right" style="margin-top:20px; margin-bottom:20px; margin-right:40px;">
                </div>
              </div>
              <br>
              <?=form_close()?>
            </div> <!-- REPORTE DOCENTE END -->

            <div class="tab-pane" id="pperiodo">
              <?=  form_open(base_url().'avances/newReportPeriodo')?>
              <br>
              <h2 style="text-align:center;">Reporte por fechas</h2>
                
              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <div class="col-xs-4">
                    <span class="input-group-addon" id="sizing-addon2">Fecha inicio</span>
                    <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechainiR" required>
                  </div>
                  <div class="col-xs-4">
                    <span class="input-group-addon" id="sizing-addon2">Fecha fin</span>
                    <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechafinR" required>
                  </div>
                </div>
              </div>

              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <input type="submit"  value="Crear reporte" class="btn btn-primary btn-lg pull-right" style="margin-top:20px; margin-bottom:20px; margin-right:40px;">
                </div>
              </div>
              <br>
              <?=form_close()?>
            </div> <!-- REPORTE PERIODO END -->

            <div class="tab-pane" id="pprogreso">
              <?=  form_open(base_url().'avances/newReport')?>
              <br>
              <h2 style="text-align:center;">Reporte por progreso</h2>
                
              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <div class="col-xs-4">
                    <span class="input-group-addon" id="sizing-addon2">Fecha inicio</span>
                    <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechainiR" required>
                  </div>
                  <div class="col-xs-4">
                    <span class="input-group-addon" id="sizing-addon2">Fecha fin</span>
                    <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechafinR" required>
                  </div>
                </div>
              </div>

              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <input type="submit"  value="Crear reporte" class="btn btn-primary btn-lg pull-right" style="margin-top:20px; margin-bottom:20px; margin-right:40px;">
                </div>
              </div>
              <br>
              <?=form_close()?>
            </div> <!-- REPORTE PROGRESO END -->

            <div class="tab-pane" id="ptipo">
              <?=  form_open(base_url().'avances/newReport')?>
              <br>
              <h2 style="text-align:center;">Reporte por tipo de actividad</h2>
                
              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <div class="col-xs-4">
                    <span class="input-group-addon" id="sizing-addon2">Fecha inicio</span>
                    <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechainiR" required>
                  </div>
                  <div class="col-xs-4">
                    <span class="input-group-addon" id="sizing-addon2">Fecha fin</span>
                    <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechafinR" required>
                  </div>
                </div>
              </div>

              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <input type="submit"  value="Crear reporte" class="btn btn-primary btn-lg pull-right" style="margin-top:20px; margin-bottom:20px; margin-right:40px;">
                </div>
              </div>
              <br>
              <?=form_close()?>
            </div> <!-- REPORTE TIPO END -->

          </div> <!--REPORTES SECTION END -->

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

<script type="text/javascript">
$("#mytable tbody tr").mouseover(function() {
  $(this).addClass("tr_hover");
});

$("#mytable tbody tr").mouseout(function() {
  $(this).removeClass("tr_hover");
});
</script>

<script>
    $(document).ready(function () {
    $("#docente").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?php echo base_url().'asignaciones/showDocentes' ?>",
                dataType: "json",
                minLength:1,
                data: {
                    term: request.term,
                },
                success: function(data) {
                    response(data);
                    //alert('You selected:');
                }
            });
        },
    });
  });
  </script>