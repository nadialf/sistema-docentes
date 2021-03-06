<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Solicitudes de constancias
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

        <div class="tab-pane active" id="1b">
        </br>
          <table class="table table-responsive table-hover" id="mytable">
            <thead>
              <tr>
                <th id="docente_header">Docente</th>
                <th id="tipo_header">Tipo</th>
                <th id="actividad_header">Actividad</th>
                <th>Formato con firma</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query as $row){ ?>
              <tr>
                <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
                <td><?php echo $row->Tipo; ?></td>
                <td><?php echo $row->Nombre; ?></td>
                
                <?php
                if ($row->Etapa == "Aceptada"){ ?>
                  <td></td>
                  <td>
                    <?=  form_open(base_url().'constancias/newConstancia/'.$this->uri->segment(3).'/'.$row->ID_Solicitud)?>
                      <input type="submit"  value="Firmar" class="btn btn-primary">
                    <?=form_close()?>
                  </td> <?php
                } else {                  
                  $this->load->database('default');
                  $this->db->select('ID_Constancias, Formato, ID_Solicitud');
                  $this->db->where('ID_Solicitud', $row->ID_Solicitud);
                  $this->db->from('constancias');
                  $query2 = $this->db->get();

                  if($query2->num_rows() > 0){
                    foreach ($query2->result() as $fila) { ?>
                      <td> 
                        <?php 
                        $ruta = base_url().'constancias/formatoFirmaDownload/'.$row->ID_Solicitud;
                        $Archivo = "<a href='$ruta' class='btn-lg'><i class='glyphicon glyphicon-file' title='Descargar formato con firma'></i></a>";
                        echo $Archivo; ?>
                      </td>
                      <td></td>
                    <?php
                    }
                  }
                } ?>
              </tr>
            <?php } //END FOREACH ?>
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

<br><br><br>

  <script type="text/javascript">
    $(document).ready(function(){
    $(".autocompletar").keyup(function(){
      var info = $(this).val();
      $.post('<?php echo base_url().'constancias/autocompletarB' ?>',{ info : info }, function(data){
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
</script>

<script type="text/javascript">
  var table = $('#mytable');
    
    $('#docente_header, #tipo_header, #actividad_header')
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