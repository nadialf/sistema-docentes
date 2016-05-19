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
          <table class="table" id="mytable">
            <thead>
              <tr>
                <th id="docente_header">Docente</th>
                <th id="tipo_header">Tipo</th>
                <th id="actividad_header">Actividad</th>
                <th>Formato sin firma</th>
                <th id="formato_header">Formato con firma</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
            <tr>
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
                $query2 = $this->db->get();

                if($query2->num_rows() > 0){
                  foreach ($query2->result() as $fila) {
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
      function elimina(url){
        if (confirm("¿Está seguro que desea eliminar la solicitud?") ){
          location.href=url;
        }
      }
      function formatDOW(url){
        location.href=url;
      }
</script>

<script type="text/javascript">
  var table = $('table');
    
    $('#docente_header, #tipo_header, #actividad_header, #formato_header')
        .wrapInner('<span title="Ordenar esa columna"/>')
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