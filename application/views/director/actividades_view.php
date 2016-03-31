 <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#3b" data-toggle="tab">
            <i class="fa fa-table"></i>     Actividades registradas
          </a>
        </li>
        <li data-toggle="tab">
          <a href="#2b" data-toggle="tab">
            <i class="glyphicon glyphicon-search"></i>     Busqueda de actividad
          </a>
        </li>
      </ul>

      <div style="background-color:#e5e5e5; height:3px;"></div>

      <div class="tab-content clearfix">
        
        <div class="tab-pane active" id="3b">
          <h4 style="padding-left:2%;">Actividades registradas</h4>
          <table class="table">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Lugar</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <?php foreach($query as $row): ?>
              <tr>
                <td><?php echo $row->Nombre; ?></td>
                <td><?php echo $row->Tipo; ?></td>
                <td><?php echo $row->Lugar; ?></td>
                <td><?php echo $row->Fecha_Inicio; ?></td>
                <td><?php echo $row->Fecha_Fin; ?></td>
              </tr>
            <?php endforeach; ?>
          </table>

        </div>



        <div class="tab-pane" id="2b">
          <h4 style="padding-left:2%;">Búsqueda de actividad</h4>
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre de la actividad">
            <br/>
          </div>
          <table class="table table-hover table-responsive" id="tableSearch">
          </table>
        </div>

      </div>

    </div>

  </div>

  <!-- CONTENT-WRAPPER SECTION END-->