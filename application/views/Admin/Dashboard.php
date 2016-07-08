<!--<div class="col-xs-12 col-md-12 col-lg-12"  style="height: 9%;"></div>-->
<div class="marca_250"></div>
<div class="col-md-12 col-lg-12 col-xs-12" flex id="content" layout="column" layout-fill layout-align="top center" ng-controller="Dashboard" ng-cloak>
    
    <div class="col-md-12 col-xs-12" style="margin-top: 5%">

        <div class="col-md-3 col-xs-6">
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
        <div class="col-md-3 col-xs-6">
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
    </div>
    
     <div layout="row" class="col-md-12 col-xs-12 col-lg-12" style="margin-top:20%; position: relative;" ng-cloak>

        <div layout="column" class="col-md-12 col-xs-12 col-lg-8 col-lg-offset-1 chart-container highcharts-container" style="position: relative;">
            <div class="panel panel-info" style="position: relative;">
                <!--<div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>-->
                <!--<div class="panel-body ">-->
                    <div id="container3" style="min-width: 310px; height: 400px; max-width: 800px; max-height:400px;position: relative;"></div>
                <!--</div>-->
            </div>
        </div>

    </div>


    <div layout="row" class="col-md-12 col-xs-12 col-lg-12" style="margin-top:40%; position: relative;" ng-cloak>

        <div layout="column" class="col-md-12 col-xs-12 col-lg-8 col-lg-offset-1 chart-container highcharts-container" style="position: relative;">
            <div class="panel panel-info" style="position: relative;">
                <!--<div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>-->
                <!--<div class="panel-body ">-->
                    <center><div flex id="container2" style="position: relative;"></div></center>
                <!--</div>-->
            </div>
        </div>

    </div>
    <div class="col-md-12 col-xs-12" style="margin-top:40%">
    <div layout="row" >
     
        <div class="col-md-12 col-xs-12" flex > 
          <h3>Seleccione una Sucursal</h3>           
            <md-select flex md-on-open="cargarSucursal()" md-on-close="actualizarGrafica()" name="Sucursal" id="Sucursal"  placeholder="Sucursal" ng-model="lib.CodSucu" required>      
                <md-option  ng-repeat="tcon in sucursal_t" ng-value="tcon.id" >{{tcon.Descrip}}</md-option>
            </md-select>
        </div>

        <div class="col-md-4 col-xs-12" flex>
           <!--  <md-button flex id="generar" class="md-raised md-primary" type="submit" data-target="libro" ng-click="Actualizar()">Generar 
            </md-button> -->
        </div>
        <div class="col-md-4 col-xs-12"></div>
    </div>
    <div layout="row" class="col-md-12 col-xs-12 col-lg-12" style="margin-top:10%" ng-cloak>

        <div layout="column" class="col-md-12 col-xs-12 col-lg-8 col-lg-offset-1">
            <div class="panel panel-info">
                <!--<div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>-->
                <!--<div class="panel-body">-->
                    <center><div flex id="container"></div></center>
                <!--</div>-->
            </div>
        </div>

    </div> 
    </div>

   
</div>



