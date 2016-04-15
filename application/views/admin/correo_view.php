 <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#1b" data-toggle="tab">
            <i class="fa fa-table"></i>     Todos los correos
          </a>
        </li>
        <li data-toggle="tab">
          <a href="#2b" data-toggle="tab">
            <i class="glyphicon glyphicon-inbox"></i>     No leidos
          </a>
        </li>
        <li data-toggle="tab">
          <a href="#3b" data-toggle="tab">
            <i class="glyphicon glyphicon-check"></i>     Leidos
          </a>
        </li>
        <li data-toggle="tab">
          <a href="#4b" data-toggle="tab">
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
                <th></th>
                <th id="remitente_header">Remitente</th>
                <th>Mensaje</th>
                <th id="fecha_header">Fecha</th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
            <tr>
              <td><input type="checkbox" value="<?php echo $row->ID_Correo ?>" name="<?php echo $row->ID_Correo ?>"></td>
              <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
              <td><?php echo $row->Asunto; ?></td>
              <td><?php echo $row->Fecha_Envio; ?></td>
            </tr>
            <?php endforeach; ?>
          </table>

        </div> <!-- TODOS LOS CORREOS SECTION END-->

        <div class="tab-pane" id="2b">
          <table class="table" id="mytable">
            <thead>
              <tr>
                <th></th>
                <th id="remitente_header">Remitente</th>
                <th>Mensaje</th>
                <th id="fecha_header">Fecha</th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
            <tr>
              <td><input type="checkbox"></td>
              <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
              <td><?php echo $row->Asunto; ?></td>
              <td><?php echo $row->Fecha_Envio; ?></td>
            </tr>
            <?php endforeach; ?>
          </table>

        </div> <!--NO LEIDOS SECTION END-->

        <div class="tab-pane" id="3b">
          <table class="table" id="mytable">
            <thead>
              <tr>
                <th id="remitente_header">Remitente</th>
                <th>Mensaje</th>
                <th id="fecha_header">Fecha</th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
            <tr>
              <td><?php echo $row->Nombres.' '.$row->ApPaterno.' '.$row->ApMaterno; ?></td>
              <td><?php echo $row->Asunto; ?></td>
              <td><?php echo $row->Fecha_Envio; ?></td>
              <td>
                <a href='#' onclick="elimina('<?=base_url()?>correo/delete/<?=$row->ID_Correo?>');"><i class='glyphicon glyphicon-trash' title='Eliminar'></i></a>
              </td>
            </tr>
            <?php endforeach; ?>
          </table>

        </div> <!--LEIDOS SECTION END-->

        <div class="tab-pane" id="4b">
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre del remitente">
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
      $.post('<?php echo base_url().'correo/autocompletar' ?>',{ info : info }, function(data){
        if(data != ''){
          $("#tableSearch").html(data);
        }else{
          $("#tableSearch").html('');
        }
      })
    })

    })
      function elimina(url){
        if (confirm("¿Está seguro que desea eliminar el correo de manera permanente?") ){
          location.href=url;
        }
      }
</script>

<script type="text/javascript">
  var table = $('table');
    
    $('#remitente_header, #fecha_header')
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