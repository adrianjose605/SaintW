<div class="marca_250"></div>
<div style="position: relative;" ng-controller="Contactos" layout="column" flex id="content" ng-cloak>
    <div class="container" style="width:95%">
        <h1 >Clientes</h1>

        <h3>Busqueda</h3>

            <form class="form-inline" name="formBusquedaUsuarios" role="form" novalidate>
                <div class="form-group">
                    <md-input-container flex ng-class="md-primary">
                        <label class="">Descripcion / Rif</label>
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




            <div ng-show="contador != 0" tasty-table bind-resource-callback="getResourceC" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody id="tabla">
                        <tr ng-repeat="row in rows" class="centrado">
                           <td>{{ row.Descripcion}}</td>                           
                             <td>{{ row.Direccion}}</td>     
                            <td>{{ row.Telefono}}</td>
                            <td>{{ row.Correo}}</td>                                  
                                                        
                            <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-orange btn-xs" href=""  ng-click="getCliente(row.Opciones)" data-toggle="modal" data-target="#modificar_cliente"><span class="glyphicon glyphicon-search"></span></a>
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
                            <h4 class="modal-title">Nuevo cliente</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formUsuarioN" role="form" validate>
                            <div class="form-group">
                                    <md-input-container flex>
                                        <label>Cedula o Rif</label>
                                        <input maxlength="60" ng-model="user2.CodClie" ng-readonly="false"  type="text" name="nombre_usuario">
                                        <ng-messages for="formUsuarioN.CodClie.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar documento de identificacion</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input maxlength="100" ng-model="user2.Descrip" ng-readonly="false" type="text" name="nombre_usuario">
                                        <ng-messages for="formUsuarioN.Descrip.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>

                                    </md-input-container>
                                </div>
                                   <div class="form-group">
                                    <md-input-container flex>
                                        <label>Direccion</label>
                                        <input ng-model="user2.Direc1" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="detalle_noticia" type="text">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Correo</label>
                                        <input ng-model="user2.Email"  pattern="^[a-zA-Z0-9áéíóúñ@_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="correo" type="mail">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Telefono</label>
                                        <input ng-model="user2.Telef"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="correo" type="phone">

                                    </md-input-container>
                                </div>
                               
                              
                                 <div class="form-group">
                                    <md-switch ng-model="user2.Activo">
                                        Activo
                                    </md-switch>
                                </div>

                            </form>                        </div>
                        <div class="modal-footer">


                            <md-button class="md-raised md-primary" ng-click="registrar_cliente(true)">Registrar</md-button>
                            <md-button   ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>

                </div>
            </div>




            <!--MODAL DE EDICION-->
            <div id="modificar_cliente" class="modal fade" >
                <div class="modal-dialog modal-wide-md">
                    <!-- Modal content-->
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Usuario registrado</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formUsuarioM" role="form" validate>
                             
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Descripcion</label>
                                        <input maxlength="100" ng-model="usuarioN.Descrip" type="text" name="nombre_usuario">
                                        <ng-messages for="formNoticiaM.Descrip.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>

                                    </md-input-container>
                                </div>
                                
                               <div class="form-group">
                                    <md-input-container flex>
                                        <label>Correo</label>
                                        <input ng-model="usuarioN.Email" type="email">                            
                                    </md-input-container>
                                </div>
                                 <div class="form-group">
                                    <md-input-container flex>
                                        <label>Telefono</label>
                                        <input ng-model="usuarioN.Telef">                            
                                    </md-input-container>
                                </div>
                          
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Direccion</label>
                                        <input type="textarea" ng-model="usuarioN.Direc1">                            
                                    </md-input-container>
                                </div>
                            
                                <div class="form-group">
                                    <md-switch ng-model="usuarioN.Activo">
                                        Activo
                                    </md-switch>
                                </div>
                            
                                

                            </form>
                            <div class="modal-footer">
                                <md-button class="md-raised md-primary" ng-click="registrar_cliente()">Guardar</md-button>

                                <md-button class="btn-material-red" ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>


</div>
   <!-- <div id="footer"></div>
-->
<script src="<?php echo base_url(); ?>public/js/Administrador/Cliente.js"></script>










