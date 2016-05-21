 <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Solicitudes de constancias 
        </a>
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
          <table class="table table-responsive table-hover">
            <thead>
              <tr>
                <th>Actividad</th>
                <th>Tipo</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Formato</th>
                <th>Estado</th>
              </tr>
            </thead>
            <?php foreach($query1 as $row): ?>
            <tr>
              <td><?php echo $row->Nombre; ?></td>
              <td><?php echo $row->Tipo; ?></td>
              <td><?php echo $row->Fecha_Inicio; ?></td>
              <td><?php echo $row->Fecha_Fin; ?></td>
              <td></td>
              <td><?php echo $row->Etapa; ?></td>
            </tr>
            <?php endforeach; ?>
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

  <script type="text/javascript">
    $(document).ready(function(){
    $(".autocompletar").keyup(function(){
      var info = $(this).val();
      $.post('<?php echo base_url().'constancias/autocompletar' ?>',{ info : info }, function(data){
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