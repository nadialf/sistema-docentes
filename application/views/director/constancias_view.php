<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Constancias firmadas
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
          <table class="table">
            <thead>
              <tr>
                <th>Docente</th>
                <th>Tipo</th>
                <th>Actividad</th>
                <th>Formato con firma</th>
              </tr>
            </thead>
            <?php foreach($query as $row){

                $this->load->database('default');
                $this->db->select('ID_Constancias, Formato, ID_Solicitud');
                $this->db->where('ID_Solicitud', $row->ID_Solicitud);
                $this->db->from('constancias');
                $query2 = $this->db->get();

                if($query2->num_rows() > 0){
                  foreach ($query2->result() as $fila) {
                    if ($fila->Formato != '') {
            ?>
                      <tr>
                      <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
                      <td><?php echo $row->Tipo; ?></td>
                      <td><?php echo $row->Nombre; ?></td>
                      <td><?php 
                                $ruta = base_url().$fila->Formato;
                                $Archivo = "<a href='$ruta' target='_blank' title='Constancia'> <i class='glyphicon glyphicon-file' title='Ver formato con firma'></i></a>";
                                echo $Archivo; ?>
                      </td>
                      </tr>
                    <?php }
                  }
                }
            } ?>
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