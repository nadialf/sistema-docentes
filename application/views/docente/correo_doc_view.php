 <div class="content-wrapper" style="background-color: #e5e5e5; margin-top:0px;">
   
    <br>
    <div id="exTab3" class="tab">
      
      <ul  class="nav nav-pills">
        <li class="active" data-toggle="tab">
          <a href="#3b" data-toggle="tab">
            <i class="fa fa-table"></i>     Todos los correos
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
        </br>
        <div class="tab-pane active row" id="3b">
        <form id="formulario" action="<?=base_url()?>index.php/correo/agregarCorreo" method="post" accept-charset="utf-8">
          <div class="col-md-3"></div>
          <div class="col-md-4">
            Para
             <input type="text" name="para"class="form-control" id="para" placeholder="Destinatario">
          </div>
          <div class="col-md-4">
            De
             <input type="text" name="de" class="form-control" id="de" placeholder="Remitente">
          </div>
          <div class="col-md-3">
          </div>
          <div class="col-md-4">
            Asunto
             <input type="text" name="asunto" class="form-control" id="asunto" placeholder="Asunto">
          </div>
          <input type="submit"  value="Enviar" class="btn btn-primary btn-lg pull-right" style="margin-top:20px; margin-bottom:20px; margin-right:40px;">
            <br><br>
            </form>
        </div>



        <div class="tab-pane" id="2b">
          <h4 style="padding-left:2%;">Búsqueda</h4>
          <br/>
          <div class="col-xs-4">
            <input type="text" class="form-control autocompletar"  name="autocompletar" id="autocompletar" onpaste="return false"  aria-describedby="sizing-addon2" placeholder="Nombre del remitente">
            <br/>
          </div>
          <table class="table table-hover table-responsive" id="tableSearch">
          </table>
        </div>

      </div>

    </div>

  </div>

  <!-- CONTENT-WRAPPER SECTION END-->