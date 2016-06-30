<div class="marca"></div>
  <div style="position: relative;" ng-controller="Emp" layout="column" flex id="content" >
    <div class="container" style="width:95%">
        <h1 >Empresas</h1>

        <h3>Busqueda</h3>

            <form class="form-inline" name="formBusquedaUsuarios" role="form" novalidate>
                <div class="form-group">
                    <md-input-container flex ng-class="md-primary">
                        <label class="">Nombre</label>
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
                    <md-button id="nuevo" class="md-raised md-primary" data-toggle="modal"  data-target="#nuevo_usuario">Nuevo </md-button>
                </div>
            
                
            </form>




            <div ng-show="contador != 0" tasty-table bind-resource-callback="getResourceE" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody id="tabla">
                        <tr ng-repeat="row in rows" class="centrado">
                            <td>{{ row.Rif}}</td> 
                            <td>{{ row.Nombre}}</td>
                            <td>{{ row.Descripcion}}</td>
                            <td>{{ row.Telefono}}</td>
                            <td>{{ row.Fecha_registro}}</td>                                  
                                                           
                            <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-orange btn-xs" href=""  ng-click="getEmpresas(row.Opciones)" data-toggle="modal" data-target="#modificar_empresa"><span class="glyphicon glyphicon-search"></span></a>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <div tasty-pagination></div>
            </div>

<!--NUEVO MODAL-->
            <div id="nuevo_usuario" class="modal fade" role="dialog">
                <div class="modal-dialog">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nueva Empresa</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formEmpresaN" role="form" validate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Rif</label>
                                        <input ng-model="emp.Rif" type="text" name="Usuario">
                                         <ng-messages for="formEmpresaN.Usuario.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Usuario</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>
                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input maxlength="50" ng-model="emp.Nombre" type="text" name="nombre_empresa">
                                        <ng-messages for="formEmpresaN.Nombre.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>

                                    </md-input-container>
                                </div>
                                
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Descripcion</label>
                                        <input ng-model="emp.Descripcion"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="correo" type="text">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Direcion</label>
                                        <input ng-model="emp.Direccion"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="text" type="phone">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Telefono</label>
                                        <input ng-model="emp.Telefono"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="text" type="phone">

                                    </md-input-container>
                                </div>
                                                               
                                
                                 <div class="form-group">
                                    <md-switch ng-model="emp.Estatus">
                                        Activo
                                    </md-switch>
                                </div>

                            </form>                        </div>
                        <div class="modal-footer">


                            <md-button class="md-raised md-primary" ng-click="registrar_empresa(true)">Registrar</md-button>
                            <md-button   ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>

                </div>
            </div>




            <!--MODAL DE EDICION-->
            <div id="modificar_empresa" class="modal fade" >
                <div class="modal-dialog modal-wide-md">
                    <!-- Modal content-->
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Usuario registrado</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formEmpresaM" role="form" validate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Rif</label>
                                        <input ng-model="emp2.Rif" type="text" name="Usuario">
                                         <ng-messages for="formEmpresaM.Usuario.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Usuario</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>
                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input maxlength="50" ng-model="emp2.Nombre" type="text" name="nombre_empresa">
                                        <ng-messages for="formEmpresaM.Nombre.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>

                                    </md-input-container>
                                </div>
                                
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Correo</label>
                                        <input ng-model="emp2.Descripcion"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="correo" type="text">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Direcion</label>
                                        <input ng-model="emp2.Direccion"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="text" type="phone">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Telefono</label>
                                        <input ng-model="emp2.Telefono"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="text" type="phone">

                                    </md-input-container>
                                </div>
                                                               
                                
                                 <div class="form-group">
                                    <md-switch ng-model="emp2.Estatus">
                                        Activo
                                    </md-switch>
                                </div>

                            </form>
                            <div class="modal-footer">
                                <md-button class="md-raised md-primary" ng-click="registrar_empresa()">Guardar</md-button>

                                <md-button class="btn-material-red" ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


</div>


<script src="<?php echo base_url(); ?>public/js/Sys/Empresas.js"></script>










