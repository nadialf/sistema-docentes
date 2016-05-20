 <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Solicitudes 
        </a>
      <li data-toggle="tab">
          <a href="#2b" data-toggle="tab">
            <i class="fa fa-list"></i>     Constancias aceptadas
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
          <table class="table table-hover table-responsive">
            <thead>
              <tr>
                <th>Aceptar</th>
                <th id="docente_header">Docente</th>
                <th id="tipo_header">Tipo</th>
                <th id="actividad_header">Actividad</th>
                <th>Formato sin firma</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query1 as $row): ?>
            <tr>
              <td><input type="checkbox" onchange="aceptada('<?=base_url()?>constancias/changeAceptada/<?=$row->ID_Solicitud?>');" title='Aceptar'></td>
              <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
              <td><?php echo $row->Tipo; ?></td>
              <td><?php echo $row->Nombre; ?></td>
              <td>
                <a href='#' onclick="formatDOW('<?=base_url()?>constancias/formatoDownload/<?=$row->ID_Solicitud?>');" class='btn-lg'><i class='glyphicon glyphicon-save' title='Descargar formato sin firma'></i></a>
              </td>
              <td>
                <a href='#' onclick="elimina('<?=base_url()?>constancias/delete/<?=$row->ID_Solicitud?>');"><i class='glyphicon glyphicon-trash' title='Eliminar'></i></a>
              </td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div> <!-- SOLICITUDES SECTION END -->

        <div class="tab-pane" id="2b">
        </br>
          <table class="table table-hover table-responsive">
            <thead>
              <tr>
                <th>Aceptar</th>
                <th id="docente_header">Docente</th>
                <th id="tipo_header">Tipo</th>
                <th id="actividad_header">Actividad</th>
                <th>Formato sin firma</th>
                <th>Formato con firma</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query2 as $row): ?>
            <tr>
              <td id="chkStatusB">
                <input type="checkbox" onchange="noAceptada('<?=base_url()?>constancias/changeNoAceptada/<?=$row->ID_Solicitud?>');" title='No aceptada'>
              </td>
              <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
              <td><?php echo $row->Tipo; ?></td>
              <td><?php echo $row->Nombre; ?></td>
              <td>
                <a href='#' onclick="formatDOW('<?=base_url()?>constancias/formatoDownload/<?=$row->ID_Solicitud?>');" class='btn-lg'><i class='glyphicon glyphicon-save' title='Descargar formato sin firma'></i></a>
              </td>
              <td><?php 
                $this->load->database('default');
                $this->db->select('ID_Constancias, Formato, ID_Solicitud');
                $this->db->where('ID_Solicitud', $row->ID_Solicitud);
                $this->db->from('constancias');
                $query4 = $this->db->get();

                if($query4->num_rows() > 0){
                  foreach ($query4->result() as $fila) {
                    $ruta = base_url().'constancias/formatoFirmaDownload2/'.$row->ID_Solicitud;
                    $Archivo = "<a href='$ruta' class='btn-lg'><i class='glyphicon glyphicon-file' title='Descargar formato con firma'></i></a>";
                    echo $Archivo;
                  }
                }?>
              </td>
              <td>
                <a href='#' onclick="elimina('<?=base_url()?>constancias/delete/<?=$row->ID_Solicitud?>');"><i class='glyphicon glyphicon-trash' title='Eliminar'></i></a>
              </td>
            </tr>
            <?php endforeach; ?>
          </table>
        </div> <!-- ACEPTADAS SECTION END -->


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
      $.post('<?php echo base_url().'constancias/autocompletar' ?>',{ info : info }, function(data){
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
      function formatDOW(url){
        location.href=url;
      }
      function noAceptada(url){
        location.href=url;
      }
      function aceptada(url){
        location.href=url;
      }
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
    $('document').ready(function(){
      $("#chkStatusB input[type=checkbox]").prop("checked", true);
    });
</script>