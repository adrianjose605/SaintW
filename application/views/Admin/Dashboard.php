<!--<div class="col-xs-12 col-md-12 col-lg-12"  style="height: 9%;"></div>-->
<div class="marca_250"></div>
<div class="col-md-12 col-lg-12 col-xs-12" flex id="content" ng-controller="Dashboard" ng-cloak>
    
<div class="col-md-12 col-xs-12 col-lg-12" style="margin-top: 5%">

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
    
<div  class="col-md-12 col-xs-12 col-lg-12" style="position: relative;" ng-cloak>

<div class="col-md-12 col-xs-12 col-lg-12">
    <div class="col-md-4 col-xs-12 col-lg-4" flex > 
          <h4>Seleccione una Sucursal</h4>           
            <md-select flex md-on-open="cargarSucursal()" md-on-close="" placeholder="Sucursal" ng-model="lib2.CodSucu" required>      
                <md-option  ng-repeat="tcon in sucursal_t2" ng-value="tcon.id" >{{tcon.Descrip}}</md-option>
            </md-select>
    </div>
        <div class="col-xs-6 col-md-4  col-lg-4">
            <h4>Dia a consultar</h4>
            <md-datepicker style="background-color: transparent" ng-model="Fecha_1" md-placeholder="Enter date"></md-datepicker>
        </div>
</div>
   <div class="col-md-12 col-xs-12 col-lg-12">
        <div layout="column" class="col-md-12 col-xs-12 col-lg-8 col-lg-offset-1 chart-container highcharts-container" style="position: relative;">
            <div class="panel panel-info" style="position: relative;">
                <!--<div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>-->
                <!--<div class="panel-body ">-->
                    <div id="container3" style="min-width: 310px; height: 400px; max-width: 800px; max-height:400px;position: relative;"></div>
                <!--</div>-->
            </div>
        </div>
    </div>
</div>


<div class="col-md-12 col-xs-12 col-lg-12" style="position: relative;" ng-cloak>
    <div class="col-md-12 col-xs-12 col-lg-12">
         <div class="col-xs-6 col-md-4  col-lg-4">
            <h4>Fecha inicial</h4>
            <md-datepicker style="background-color: transparent" ng-model="Fechai_2" md-placeholder="Enter date"></md-datepicker>
        </div>
        <div class="col-xs-6  col-md-4   col-lg-4">
            <h4>Fecha final</h4>
            <md-datepicker style="background-color: transparent" ng-model="Fechaf_2" md-placeholder="Enter date"></md-datepicker>
        </div>
    </div>
        <div layout="column" class="col-md-12 col-xs-12 col-lg-8 col-lg-offset-1 chart-container highcharts-container" style="position: relative;">
            <div class="panel panel-info" style="position: relative;">
                <!--<div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>-->
                <!--<div class="panel-body ">-->
                    <center><div flex id="container2" style="position: relative;"></div></center>
                <!--</div>-->
            </div>
        </div>

</div>

<div class="col-md-12 col-xs-12 col-lg-12 " style="">
    <div class="col-md-12 col-xs-12 col-lg-12 ">
     
        <div class="col-md-6 col-xs-12 col-lg-3" flex > 
          <h4>Seleccione una Sucursal</h4>           
            <md-select flex md-on-open="cargarSucursal()" md-on-close="actualizarGrafica()" name="Sucursal" id="Sucursal"  placeholder="Sucursal" ng-model="lib.CodSucu" required>      
                <md-option  ng-repeat="tcon in sucursal_t" ng-value="tcon.id" >{{tcon.Descrip}}</md-option>
            </md-select>
        </div>

        
    </div>
    <div class="col-md-12 col-xs-12 col-lg-12" ng-cloak>

        <div layout="column" class="col-md-12 col-xs-12 col-lg-8 col-lg-offset-1">
            <div class="panel panel-info">
               <!-- <div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div> -->
                <!-- <div class="panel-body"> -->
                    <center><div flex id="container"></div></center>
                <!-- </div> -->
            </div>
        </div>

    </div> 
</div>

   
</div>



