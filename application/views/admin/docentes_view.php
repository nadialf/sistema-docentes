<div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#1b" data-toggle="tab">
            <i class="fa fa-list"></i>     Nuevo docente
          </a>
        </li>
        <li data-toggle="tab">
          <a href="#3b" data-toggle="tab">
            <i class="fa fa-table"></i>     Docentes registrados
          </a>
        </li>
        <li data-toggle="tab">
          <a href="#2b" data-toggle="tab">
            <i class="glyphicon glyphicon-search"></i>     Busqueda de docentes
          </a>
        </li>
      </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">
        
        <div class="tab-pane active" id="1b">
          <?=  form_open(base_url().'actividades/agregar')?>
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
                <span class="input-group-addon">Usuario</span>
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
        </div>


        <div class="tab-pane" id="3b">
        </br>
          <table class="table">
            <thead>
              <tr>
                <th>No. Control</th>
                <th>Nombre(s)</th>
                <th>Apellido paterno</th>
                <th>Apellido materno</th>
                <th>Tipo de trabajador</th>
                <th>Usuario</th>
                <th>Contraseña</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <!--<?php foreach($query as $row): ?>
              <tr>
                <td><?php echo $row->nombrePersona.' '.$row->apaPersona.' '.$row->amaPersona; ?></td>
                <td><?php echo $row->callePersona.' #'.$row->numDirPersona; ?></td>
                <td><?php echo $row->coloniaPersona; ?></td>
                <td><?php echo $row->celPersona; ?></td>
                <td><?php echo $row->correoPersona; ?></td>
                <td><?php echo $row->sexo; ?></td>
                <td>
                  <?php
                    $then = date('Ymd', strtotime($row->fechaNa));
                    $diff = date('Ymd') - $then;
                    echo substr($diff, 0, -4);
                  ?>
                </td>
                <td>
                  <a href='#' onclick="editar('<?=base_url()?>paciente/modificar/<?=$row->idpersona?>');"><i class='glyphicon glyphicon-pencil'></i></a>
                </td>
                <td>
                  <a href='#' onclick="elimina('<?=base_url()?>paciente/deletePaciente/<?=$row->idpersona?>');"><i class='glyphicon glyphicon-trash'></i></a>
                </td>
              </tr>
            <?php endforeach; ?> -->
          </table>

        </div>



        <div class="tab-pane" id="2b">
          <h4 style="padding-left:2%;">Búsqueda de docentes</h4>
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre del docente">
            <br/>
          </div>
          <table class="table table-hover table-responsive" id="tableSearch">
          </table>
        </div>

      </div>

    </div>

  </div>

  <!-- CONTENT-WRAPPER SECTION END-->