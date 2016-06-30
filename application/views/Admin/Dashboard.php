<!--<div class="col-xs-12 col-md-12 col-lg-12"  style="height: 9%;"></div>-->
<div class="marca_250"></div>
<br>
<div class="col-md-12 col-lg-12 col-xs-12" flex id="content" layout="column" layout-fill layout-align="top center" ng-controller="Dashboard">
    <div layout="row" class="col-md-12">
        <div class="col-md-4 col-xs-12" flex >
            <md-select flex md-on-open="cargarSucursal()" name="provincia" id="provincia"  placeholder="Sucursal" ng-model="lib.CodSucu" required>      
                <md-option ng-repeat="tcon in sucursal_t" ng-value="tcon.id">{{tcon.Descrip}}</md-option>
            </md-select>
        </div>

        <div class="col-md-4 col-xs-12" flex>
            <md-button flex id="generar" class="md-raised md-primary" type="submit" data-target="libro" ng-click="Actualizar()">Generar 
            </md-button>
        </div>
        <div class="col-md-4 col-xs-12"></div>
    </div><br><br>
    <div class="col-md-12">

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
    </div>
    <br><br><br><br><br><br>
    
    
    <div layout="row" class="col-md-12 col-xs-12 col-lg-12">

        <div layout="column" class="col-md-12 col-xs-12 col-lg-8 col-lg-offset-1">
            <div class="panel panel-info">
                <!--<div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>-->
                <!--<div class="panel-body">-->
                    <center><div flex id="container"></div></center>
                <!--</div>-->
            </div>
        </div>

    </div> 
<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <div layout="row" class="col-md-12 col-xs-12 col-lg-12">

        <div layout="column" class="col-md-12 col-xs-12 col-lg-8 col-lg-offset-1">
            <div class="panel panel-info">
                <!--<div class="panel-heading text-center"><strong>VENTAS POR SUCURSAL</strong></div>-->
                <!--<div class="panel-body ">-->
                    <center><div flex id="container2"></div></center>
                <!--</div>-->
            </div>
        </div>

    </div>
</div>



