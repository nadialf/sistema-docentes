<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
      <li class="active" data-toggle="tab">
        <a href="#1b" data-toggle="tab">
          <i class="fa fa-list"></i>     Docentes registrados 
        </a>
      </li>
      <li data-toggle="tab">
        <a href="#2b" data-toggle="tab">
          <i class="fa fa-plus"></i>     Nuevo docente
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
          <table class="table table-responsive" id="mytable">
            <thead>
              <tr>
                <th id="nombre_header">Nombre(s)</th>
                <th id="appaterno_header">Apellido paterno</th>
                <th id="apmaterno_header">Apellido materno</th>
                <th id="tipo_header">Tipo de trabajador</th>
                <th id="usuario_header">Nombre de usuario</th>
                <th>Contraseña</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
           <?php foreach($query as $row): ?>
              <tr>
                <td><?php echo $row->Nombres; ?></td>
                <td><?php echo $row->ApPaterno; ?></td>
                <td><?php echo $row->ApMaterno; ?></td>
                <td><?php echo $row->TipoTrabajo; ?></td>
                <td><?php echo $row->Usuario; ?></td>
                <td><?php echo $row->Contrasena; ?></td>
                <td>
                  <a href='#' onclick="editar('<?=base_url()?>docentes/modificar/<?=$row->ID_Trabajador?>');"><i class='glyphicon glyphicon-pencil' title='Editar'></i></a>
                </td>
                <?php
                    if ( ($row->Usuario == 'Admin') || ($row->Usuario == 'Director') ) { ?>

                          <td></td> <?php                         
                    } else { ?>
                        <td>
                          <a href='#' onclick="elimina('<?=base_url()?>docentes/delete/<?=$row->ID_Trabajador?>');"><i class='glyphicon glyphicon-trash' title='Eliminar'></i></a>
                        </td> <?php
                    } ?>
              </tr>
            <?php endforeach; ?>
          </table>

        </div> <!-- DOCENTES REGISTRADOS SECTION END -->
        
        <div class="tab-pane" id="2b">
          <?=  form_open(base_url().'docentes/agregarDocente')?>
          <br>
          <h2 style="text-align:center;">Datos de cuenta y docente</h2>
          
          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon">Nombre(s)</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="nombre" required>
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Apellido paterno</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="paterno" required>
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Apellido materno</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="materno" required>
              </div>
            </div>
          </div>

          <br><br>

          <div style="margin-left:20px; margin-right:20px;">
            <div class="content-wrapper"  style="width:100%; min-height: auto; height:auto; margin-left;10px; margin-right:10px;">
              <div class="col-xs-4">
                <span class="input-group-addon">Tipo de trabajador</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="tipot" required>
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Nombre de usuario</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="user" required>
              </div>
              <div class="col-xs-4">
                <span class="input-group-addon">Contraseña</span>
                <input type="text" class="form-control" aria-describedby="sizing-addon2" name="contrasena" required>
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
        </div> <!-- REGISTRAR DOCENTE SECTION END -->



        <div class="tab-pane" id="3b">
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre del docente o usuario">
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
      $.post('<?php echo base_url().'docentes/autocompletar' ?>',{ info : info }, function(data){
        if(data != ''){
          $("#tableSearch").html(data);
        }else{
          $("#tableSearch").html('');
        }
      })
    })

    })
      function elimina(url){
        if (confirm("¿Está seguro que desea eliminar al docente? Se eliminará toda la información contenida acerca de dicho docente en el sistema.") ){
          location.href=url;
        }
      }
      function editar(url){
        location.href=url;
      }
</script>

<script type="text/javascript">
  var table = $('table');
    
    $('#nombre_header, #appaterno_header, #apmaterno_header, #tipo_header, #usuario_header')
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