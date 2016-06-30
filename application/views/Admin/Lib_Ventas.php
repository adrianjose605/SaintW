<div class="marca"></div>
<div style="position: relative;"  ng-controller="Lib" layout="column" flex id="content" >
    <div class="container " style="width:95%" >
	 <h1>Libro de Venta por Sucursal</h1>
     <br>
     <br>
     <br>
     <br>
<table align="center">
   <tr>
        <td>
         <md-select md-on-open="cargarSucursal()" name="provincia" id="provincia"  placeholder="Sucursal" ng-model="lib.CodSucu" required>      
                <md-option ng-repeat="tcon in sucursal_t" ng-value="tcon.id">{{tcon.Descrip}}</md-option>
            </md-select>
     <div class="errors" ng-messages="libro.lib.$error" ng-if="libro.lib.$dirty">
        <div ng-message="required">Required</div>
    </div>
   </td>
    </tr>
    <tr>
    <td align="center" colspan="7">
    <hr />
    <div class="form-group">    
                <md-button id="generar" class="md-raised md-primary" type="submit" data-target="libro" ng-click="Generar()">Generar 
                </md-button>
     </div>
       </td>
    </tr>
</table>

    </div>
</div>

<script src="<?php echo base_url(); ?>public/js/Administrador/Lib_Ventas.js"></script>