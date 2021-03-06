<div class="marca"></div>
<div style="position: relative;"  ng-controller="Lib" layout="column" flex id="content" >
    <div class="container " style="width:99%; background: rgba(255, 229, 204, 0.1); height: 81%" >
	 <h1>Libro de Venta por Sucursal</h1>
    

   <div class="col-xs-12">
    <div class="col-xs-4">
      <h4>Sucursal a consultar</h4>
         <md-select md-on-open="cargarSucursal()" name="provincia" id="provincia"  placeholder="Sucursal" ng-model="lib.CodSucu" required>      
                <md-option ng-repeat="tcon in sucursal_t" ng-value="tcon.id">{{tcon.Descrip}}</md-option>
            </md-select>
     <div class="errors" ng-messages="libro.lib.$error" ng-if="libro.lib.$dirty">
        <div ng-message="required">Required</div>
    </div>
   </div>
   <div class="col-xs-4">
       <h4>Fecha inicial</h4>
    <md-datepicker style="background-color: transparent" ng-model="Fechai" md-placeholder="Enter date"></md-datepicker>
   </div>
    <div class="col-xs-4">
       <h4>Fecha final</h4>
    <md-datepicker style="background-color: transparent" ng-model="Fechaf" md-placeholder="Enter date"></md-datepicker>
   </div>
    </div>
   <div class="col-xs-12">
    <div class="col-xs-6 col-xs-offset-3">
    <center>

    <div class="form-group" >    
                <md-button id="generar" class="md-raised md-primary" type="submit" data-target="libro" ng-click="Generar()">Generar 
                </md-button>
     </div>
     </center> 
       </div>
    </div>
    </div>


    </div>


<script src="<?php echo base_url(); ?>public/js/Administrador/Lib_Ventas.js"></script>
