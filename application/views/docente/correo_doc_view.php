 <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#1b" data-toggle="tab">
            <i class="glyphicon glyphicon-send"></i>     Enviados
          </a>
        </li>
        <li data-toggle="tab">
          <a href="#2b" data-toggle="tab">
            <i class="glyphicon glyphicon-pencil"></i>     Nuevo correo
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
      </br>        

        <div class="tab-pane active" id="1b">
          <table class="table table-hover table-responsive mytable" id="mytable">
            <thead>
              <tr>
                <th>Remitente</th>
                <th id="mensaje_header">Mensaje</th>
                <th id="fecha_header">Fecha</th>
              </tr>
            </thead>
            <?php foreach($query1 as $row): ?>
            <tr>
              <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
              <td><?php echo $row->Asunto; ?></td>
              <td><?php echo $row->Fecha_Envio; ?></td>
            </tr>
            <?php endforeach; ?>
          </table>

        </div> <!--ENVIADOS SECTION END-->

        <div class="tab-pane" id="2b">
        <?php foreach ($query as $row) { ?>  
        <?=  form_open(base_url().'correo/newMail/'.$row->ID_Trabajador)?>
          <br>
          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-6 col-md-push-3">
                <span class="input-group-addon" id="sizing-addon2">Fecha</span>
                <input type="date" class="form-control" aria-describedby="sizing-addon2" data-provide="datepicker" name="fecha" id="fecha" required disabled value="<?php echo date("Y-m-d");?>">
              </div>
            </div>
          </div>

          <br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-6 ui-widget col-md-push-3">
                <span class="input-group-addon" id="sizing- addon2">Destinatario</span>
                  <input type="text" class="form-control" aria-describedby="sizing-addon2" value="Administrador" disabled>
              </div>
            </div>
          </div>

          <br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-6 col-md-push-3">
                <span class="input-group-addon">Remitente</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="remitente" id="remitente" disabled value="<?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno ?>">
              </div>
            </div>
          </div>

          <br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-12">
                <span class="input-group-addon">Mensaje</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="mensaje" id="mensaje" required>
              </div>
            </div>
          </div>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <input type="submit"  value="Enviar" class="btn btn-primary btn-lg pull-right" style="margin-top:20px; margin-bottom:20px; margin-right:40px;">
            </div>
          </div>

          <br>
          <?=form_close()?>
        <?php } ?>
        </div> <!--NUEVO SECTION END -->

        <div class="tab-pane" id="3b">
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Palabras clave mensaje">
            <br/>
          </div>
          <table class="table table-hover table-responsive" id="tableSearch">
          </table>
        </div> <!--BÚSQUEDA SECTION END-->

      </div>

    </div>

  </div> <!-- CONTENT-WRAPPER SECTION END-->

  <script type="text/javascript">
    $(document).ready(function(){
    $(".autocompletar").keyup(function(){
      var info = $(this).val();
      $.post('<?php echo base_url().'correo/autocompletarB/'.$this->uri->segment(3) ?>',{ info : info }, function(data){
        if(data != ''){
          $("#tableSearch").html(data);
        }else{
          $("#tableSearch").html('');
        }
      })
    })

    })
      function elimina(url){
        if (confirm("¿Está seguro que desea eliminar la actividad? Se eliminará toda la información contenida acerca de la actividad en el sistema. (Constancias/Asignaciones/Avances).") ){
          location.href=url;
        }
      }
    </script>

<script type="text/javascript">
  var table = $('.mytable');
    
    $('#mensaje_header, #fecha_header')
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