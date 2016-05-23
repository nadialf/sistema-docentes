<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
            <i class="glyphicon glyphicon-user"></i>     Por docente 
        </a>
      <li data-toggle="tab">
        <a href="#2b" data-toggle="tab">
          <i class="glyphicon glyphicon-time"></i>     Por periodo
        </a>
      </li>
      <li data-toggle="tab">
        <a href="#3b" data-toggle="tab">
          <i class="glyphicon glyphicon-play"></i>     Por progreso
        </a>
      </li>
      <li data-toggle="tab">
        <a href="#4b" data-toggle="tab">
          <i class="glyphicon glyphicon-asterisk"></i>     Por tipo
        </a>
      </li>
    </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">
        </br>
        
        <div class="tab-pane active" id="1b">
          <?=  form_open(base_url().'avances/newReportDocente')?>
          <h2 style="text-align:center;">Reporte de avance</h2> <br/>
              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <div class="col-xs-8 col-md-push-2 ui-widget">
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
        </div> <!-- REPORTE DOCENTE SECTION END -->


        <div class="tab-pane" id="2b">
          <?=  form_open(base_url().'avances/newReportPeriodo')?>
          <h2 style="text-align:center;">Reporte de avance</h2> <br/>
              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <div class="col-xs-4 col-md-push-2">
                    <span class="input-group-addon" id="sizing-addon2">Fecha inicio</span>
                    <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fechainiR" required>
                  </div>
                  <div class="col-xs-4 col-md-push-2">
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
        </div> <!-- REPORTE PERIODO SECTION END -->

        <div class="tab-pane" id="3b">
        <?=  form_open(base_url().'avances/newReportProgreso')?>
        <h2 style="text-align:center;">Reporte de avance</h2> <br/>
              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <div class="col-xs-4 col-md-push-4">
                    <span class="input-group-addon">Progreso</span>
                    <select class="form-control" name="avanceR" required>
                      <option></option>
                      <option value="Por empezar">Por empezar</option>
                      <option value="En curso">En curso</option>
                      <option value="Terminada">Terminada</option>
                    </select>
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
          </div> <!-- REPORTE PROGRESO SECTION END -->

          <div class="tab-pane" id="4b">
          <?=  form_open(base_url().'avances/newReportTipo')?>
          <h2 style="text-align:center;">Reporte de avance</h2> <br/>
              <div style="margin-left:20px; margin-right:20px;">
                <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
                  <div class="col-xs-4 col-md-push-4">
                    <span class="input-group-addon">Tipo de actividad</span>
                    <select class="form-control" name="tipo" required>
                      <option></option>
                      <option value="Certificación">Certificación</option>
                      <option value="Conferencia">Conferencia</option>
                      <option value="Congreso">Congreso</option>
                      <option value="Curso">Curso</option>
                      <option value="Festival">Festival</option>
                      <option value="Proyecto">Proyecto</option>
                      <option value="Taller">Taller</option>
                      <option value="Otro">Otro</option>
                    </select>
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
          </div> <!-- REPORTE TIPO SECTION END -->
      </div>
    </div>
  </div> <!-- CONTENT-WRAPPER SECTION END-->

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