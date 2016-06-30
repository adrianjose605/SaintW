
<div style="position: relative;" ng-controller="Dashboard" layout="column" flex id="content" >
  <div class="container" style="width:95%">
    <div class="page-header">
      <h1>DashBoard <small><i class="fa fa-bar-chart" aria-hidden="true"></i></small></h1>
    </div>
<div>
    <table align="left">
   <tr >
      <td>
        <md-select md-on-open="cargarSucursal()" name="provincia" id="provincia"  placeholder="Sucursal" ng-model="lib.CodSucu" required>      
            <md-option ng-repeat="tcon in sucursal_t" ng-value="tcon.id">{{tcon.Descrip}}</md-option>
        </md-select>
      </td>
      <td>  
            <md-button id="generar" class="md-raised md-primary" type="submit" data-target="libro" ng-click="Actualizar()">Generar 
                </md-button>
     
    </td>
   </tr>
    <tr>
    <td align="center" colspan="7">
    <hr />
   
       </td>
    </tr>
</table>
</div>
<br>
    <div class="row">
      <div class="col-md-3">
        <div class="panel panel-success">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-3"><i class="fa fa-credit-card fa-5x"></i></div>
              <div class="col-md-9 text-right"><h4>{{ credito[0].totalCredito | currency : 'Bs '}}</h4></div>
            </div>
          </div>
          <div class="panel-body">
            <strong>TOTAL CREDITO</strong>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-3"><i class="fa fa-dollar fa-5x"></i></div>
              <div class="col-md-9 text-right"><h4>{{ facturado[0].totalFacturado | currency : 'Bs '}}</h4></div>
            </div>
          </div>
          <div class="panel-body">
            <strong>TOTAL FACTURADO</strong>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-info">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-3"><i class="fa fa-file-text fa-5x"></i></div>
              <div class="col-md-9 text-right"><h4>{{ facturas[0].total}}</h4></div>
            </div>
          </div>
          <div class="panel-body">
            <strong>TOTAL FACTURAS</strong>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="panel panel-warning">
          <div class="panel-heading"><i class="fa fa-camera-retro fa-5x"></i> fa-5x</div>
          <div class="panel-body">
            Panel content
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-info">
          <div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>
          <div class="panel-body">
            <div id="container"></div>
          </div>
        </div>
      </div>
     <!-- <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading text-center"><strong>TEXTO DE PRUEBA</strong></div>
          <div class="panel-body">
            LOREM IPSUM
          </div>
        </div>
      </div>-->
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-info">
          <div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>
          <div class="panel-body">
            <div id="container2"></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading text-center"><strong>TEXTO DE PRUEBA</strong></div>
          <div class="panel-body">
            LOREM IPSUM
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-info">
          <div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>
          <div class="panel-body">
            <div id="container3"></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading text-center"><strong>TEXTO DE PRUEBA</strong></div>
          <div class="panel-body">
            LOREM IPSUM
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-8">
        <div class="panel panel-info">
          <div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>
          <div class="panel-body">
            <div id="container4"></div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-info">
          <div class="panel-heading text-center"><strong>TEXTO DE PRUEBA</strong></div>
          <div class="panel-body">
            LOREM IPSUM
          </div>
        </div>
      </div>
    </div>
  

  <div class="row">
    <div class="col-md-8">
      <div class="panel panel-info">
        <div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>
        <div class="panel-body">
          <div id="container5"></div>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel panel-info">
        <div class="panel-heading text-center"><strong>TEXTO DE PRUEBA</strong></div>
        <div class="panel-body">
          LOREM IPSUM
        </div>
      </div>
    </div>
   </div>
  </div>
</div>


<script src="<?php echo base_url(); ?>public/js/Administrador/Dashboard.js"></script>