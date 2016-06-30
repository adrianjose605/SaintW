<div class="marca"></div>
  <div style="position: relative;" ng-controller="Suc" layout="column" flex id="content" >
    <div class="container" style="width:95%">
        <h1 >Sucursales</h1>

        <h3>Busqueda</h3>

            <form class="form-inline" name="formBusquedaSucursal" role="form" novalidate>
                <div class="form-group">
                    <md-input-container flex ng-class="md-primary">
                        <label class="">Descripcion</label>
                        <input ng-model="busqueda.query" name="query_busqueda" type="text">                
                    </md-input-container>            
                </div>

                <div class="form-group">
                    <md-switch ng-model="busqueda.estatus" ng-change="recargar()">
                        Solo Activos
                    </md-switch>
                </div>

                <div class="form-group">    
                    <md-button id="buscar" type="submit" class="md-raised md-primary" ng-click="recargar()">Buscar</md-button>
                </div>

                <div class="form-group">    
                    <md-button id="nuevo" class="md-raised md-primary" data-toggle="modal"  data-target="#nueva_sucursal">Nuevo </md-button>
                </div>
            
                
            </form>




            <div ng-show="contador != 0" tasty-table bind-resource-callback="getResourceS" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody id="tabla">
                        <tr ng-repeat="row in rows" class="centrado">
                            <td>{{ row.Nombre}}</td> 
                            <td>{{ row.Direccion}}</td>
                            <td>{{ row.Telefono}}</td>                                                        
                         
                            <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-orange btn-xs" href=""  ng-click="getSucursal(row.Opciones)" data-toggle="modal" data-target="#modificar_sucursal"><span class="glyphicon glyphicon-search"></span></a>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <div tasty-pagination></div>
            </div>

<!--NUEVO MODAL-->
            <div id="nueva_sucursal" class="modal fade" role="dialog">
                <div class="modal-dialog">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nueva Sucursal</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formSucursalN" role="form" validate>
                              <div class="form-group">
                                    <md-input-container flex>

                                    <md-select name="empresa" md-on-open="cargarEmpresas()" placeholder="Empresa" ng-model="suc.CodEmp" required>      
                                        <md-option ng-repeat="tcon in empresa_t" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.tipos.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un tipo de Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input maxlength="50" ng-model="suc.Descrip" type="text" name="Nnombre">
                                    <div ng-messages="formSucursalN.Nnombre.$error" ng-show="formSucursalN.Nnombre.$dirty">
                                        <div ng-message="required">Campo requerido</div>
                                        <div ng-message="md-maxlength">cantidad de digitos excedida</div>
                                        <div ng-message="pattern">Caractér Invalido</div>
                                    </div>

                                    </md-input-container>
                                </div>
                               <div class="form-group">
                                    <md-input-container flex>
                                        <label>Direcion</label>
                                        <input ng-model="suc.Direccion"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="Ndireccion" type="text" required="true">
                                    <div ng-messages="formSucursalN.Ndireccion.$error" ng-show="formSucursalN.Ndireccion.$dirty">
                                        <div ng-message="required">Campo requerido</div>
                                        <div ng-message="md-maxlength">cantidad de digitos excedida</div>
                                        <div ng-message="pattern">Caractér Invalido</div>
                                    </div>
                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Telefono</label>
                                        <input ng-model="suc.Telefono"  ng-readonly="false" pattern="[0-9]{1,20}" name="Ntelefono" type="phone" maxlength="20" required="true" > 
                                        <div ng-messages="formSucursalN.Ntelefono.$error" ng-show="formSucursalN.Ntelefono.$dirty">
                                        <div ng-message="required">Campo requerido</div>
                                        <div ng-message="md-maxlength">cantidad de digitos excedida</div>
                                        <div ng-message="pattern">Caractér Invalido</div>
                                    </div>
                                    </md-input-container>
                                </div>
                                                               
                                
                                 <div class="form-group">
                                    <md-switch ng-model="suc.Estatus">
                                        Activo
                                    </md-switch>
                                </div>

                            </form>                        </div>
                        <div class="modal-footer">


                            <md-button class="md-raised md-primary" ng-click="registrar_sucursal(true)">Registrar</md-button>
                            <md-button   ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>

                </div>
            </div>




            <!--MODAL DE EDICION-->
            <div id="modificar_sucursal" class="modal fade" >
                <div class="modal-dialog modal-wide-md">
                    <!-- Modal content-->
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Sucursales registradas</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formSucursalM" role="form" validate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input maxlength="50" ng-model="suc2.Descrip" type="text" name="Mnombre" required="true">             
                                    <div ng-messages="formSucursalM.Mnombre.$error">
                                        <div ng-message="required">Campo requerido</div>
                                        <div ng-message="md-maxlength">That's too long!</div>
                                    </div>

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                    <label>Direcion</label>
                                    <input ng-model="suc2.Direccion"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="Mdireccion" type="text" required="true">
                                    <div ng-messages="formSucursalM.Mdireccion.$error">
                                        <div ng-message="required">Campo requerido</div>
                                        <div ng-message="pattern">Caractér Invalido</div>
                                    </div>

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Telefono</label>
                                        <input maxlength="20" ng-model="suc2.Telefono"  ng-readonly="false" pattern="[0-9]{1,20}" name="Mtelefono" type="phone">
                                    <div ng-messages="formSucursalM.Mtelefono.$error" ng-show="formSucursalM.Mtelefono.$dirty">
                                        <div ng-message="required">Campo requerido</div>
                                        <div ng-message="md-maxlength">cantidad de digitos excedida</div>
                                        <div ng-message="pattern">Caractér Invalido</div>
                                    </div>

                                    </md-input-container>
                                </div>
                                                               
                                
                                 <div class="form-group">
                                    <md-switch ng-model="suc2.Estatus">
                                        Activo
                                    </md-switch>
                                </div>

                            </form>
                            <div class="modal-footer">
                                <md-button class="md-raised md-primary" ng-click="registrar_sucursal()">Guardar</md-button>

                                <md-button class="btn-material-red" ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


</div>


<script src="<?php echo base_url(); ?>public/js/Sys/Sucursal.js"></script>










