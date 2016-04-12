<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
  <br>
    <div id="exTab3" class="tab">
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#1b" data-toggle="tab">
            <i class="fa fa-pencil"></i>     Edición de asignación
          </a>
        </li>
      </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">
                       
        <div class="tab-pane active" id="1b">
        <?=  form_open(base_url().'asignaciones/updateAsignacion')?>
          <br>
          <h2 style="text-align:center;">Datos de asignación</h2>

          <input type="hidden" value="<?php echo $query['0']->ID_Asignacion ?>" name="id" id="id">
          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-8 ui-widget">
                <span class="input-group-addon" id="sizing- addon2">Docente</span>
                  <input type="text" class="form-control" aria-describedby="sizing-addon2" name="docente" id="docente" required 
                  value="<?php echo $query['0']->Nombres." ".$query['0']->ApPaterno." ".$query['0']->ApMaterno ?>">
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Tipo de actividad</span>
                <select class="form-control" value="<?php echo $query['0']->Tipo ?>" id="tipo" required>
                  <option></option>
                  <option value="Conferencia" name="Conferencia">Conferencia</option>
                  <option value="Congreso" name="Congreso">Congreso</option>
                  <option value="Festival" name="Festival">Festival</option>
                  <option value="Proyecto" name="Proyecto">Proyecto</option>
                  <option value="Taller" name="Taller">Taller</option>
                </select>
              </div>
            </div>
          </div>

          <br><br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon">Actividad</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="actividad" id="actividad" required value="<?php echo $query['0']->Nombre ?>">
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon" id="sizing-addon2">Fecha de incorporación</span>
                <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fecha" id="fecha" required value="<?php echo $query['0']->Fecha_Incorporacion ?>">
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
        </div> <!--EDICIÓN ASIGNACIÓN SECTION END -->

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

<script>
  $(document).ready(function () {
    $("#actividad").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "<?php echo base_url().'asignaciones/showActividades' ?>",
                dataType: "json",
                minLength:1,
                data: {
                    term: request.term,
                    tipo: $("#tipo").val(),
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

  <script type="text/javascript">
  jQuery(document).ready(function() {
      jQuery("#datepicker").datepicker();
  });
</script>

<script type="text/javascript">
    $(document).ready(function(){
    $(".autocompletar").keyup(function(){
      var info = $(this).val();
      $.post('<?php echo base_url().'asignaciones/autocompletar' ?>',{ info : info }, function(data){
        if(data != ''){
          $("#tableSearch").html(data);
        }else{
          $("#tableSearch").html('');
        }
      })
    })

    })
      function elimina(url){
        if (confirm("¿Está seguro que desea eliminar la asignación?") ){
          location.href=url;
        }
      }
      function editar(url){
        location.href=url;
      }
</script>