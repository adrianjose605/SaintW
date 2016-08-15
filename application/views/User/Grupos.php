<div class="marca"></div>
<div style="position: relative;" ng-controller="GUsuarios" layout="column" flex id="content" ng-cloak>
    <div class="container" style="width:95%">
        <h1 >Grupos de usuario</h1>

        <h3>Busqueda</h3>

            <form class="form-inline" name="formBusquedaGrupos" role="form" novalidate>
                <div class="form-group">
                    <md-input-container flex>
                        <label>Descripcion</label>
                        <input ng-model="busqueda.query" name="query_busqueda" type="text">                
                    </md-input-container>            
                </div>
                <div class="form-group">
                    <md-switch ng-model="busqueda.estatus" ng-change="recargar()">
                        Solo Activos
                    </md-switch>
                </div>
                <div class="form-group">    
                    <md-button id="buscar" class="md-raised md-primary" ng-click="recargar()">Buscar</md-button>
                </div>
                <div class="form-group">    
                    <md-button id="nuevo" class="md-raised md-primary" data-toggle="modal"  data-target="#nuevo_grupo">Nuevo </md-button>
                </div>
                
            </form>

<!-- modal de nuevo grupo -->
            <div id="nuevo_grupo" class="modal fade" role="dialog">
                <div class="modal-dialog">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nuevo Grupo de usuarios</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formGrupoN" role="form" novalidate>
                                <div class="form-group porcentaje100">
                                    <md-input-container flex>
                                        <label>Descripcion</label>
                                        <input ng-model="permiso2.Descripcion"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="usuario_noticia" type="text">

                                    </md-input-container>
                                </div>
                                
                                   <div class="form-group">
                                    <md-switch ng-model="permiso2.Lib_Consol">
                                       Libro de Ventas Consolidado
                                    </md-switch>
                                </div> 
                                   <div class="form-group">
                                    <md-switch ng-model="permiso2.Lib_Sucu">
                                            Libro de Ventas por sucursal
                                    </md-switch>
                                </div> 
                                  
                                   <div class="form-group">
                                    <md-switch ng-model="permiso2.Facturacion">
                                        Facturacion
                                    </md-switch>
                                </div> 
                              <div class="form-group">
                                    <md-switch ng-model="permiso2.Usuarios">
                                       usuarios
                                    </md-switch>
                                </div> 
                                <div class="form-group">
                                    <md-switch ng-model="permiso2.Permisos">
                                       Permisos
                                    </md-switch>
                                </div>
                                <div class="form-group">
                                    <md-switch ng-model="permiso2.Empresas">
                                        Empresas
                                    </md-switch>
                                </div><div class="form-group">
                                    <md-switch ng-model="permiso2.Sucursales">
                                        Sucursales
                                    </md-switch>
                                </div><div class="form-group">
                                    <md-switch ng-model="permiso2.Mensajes">
                                        Mensajes
                                    </md-switch>
                                </div><div class="form-group">
                                    <md-switch ng-model="permiso2.Contactos">
                                        Contactos
                                    </md-switch>
                                </div>
                                <div class="form-group">
                                    <md-switch ng-model="permiso2.Estatus">
                                        Estatus
                                    </md-switch>
                                </div>

                            </form>                        </div>
                        <div class="modal-footer">


                            <md-button class="md-raised md-primary" ng-click="registrar_grupo(true)">Registrar</md-button>
                            <md-button   ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>

                </div>
            </div>


<!--TABLA -->

            <div ng-show="contador != 0" tasty-table bind-resource-callback="getResourceG" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody id="tabla">
                        <tr ng-repeat="row in rows" class="centrado">

                            <td>{{ row.Descripcion}}</td>
                            <td><span class="glyphicon" ng-class="( (row.Lib_Sucu==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td><span class="glyphicon" ng-class="( (row.Lib_Consol==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td><span class="glyphicon" ng-class="( (row.Facturacion==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                          
                            <td><span class="glyphicon" ng-class="( (row.Usuarios==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>


                            <td><span class="glyphicon" ng-class="( (row.Permisos==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>

                                                       
                            <td><span class="glyphicon" ng-class="( (row.Empresas==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>  
                             <td><span class="glyphicon" ng-class="( (row.Sucursales==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>        
                            
                            <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')"  aria-hidden="true" title="ACTIVO" style="color:green"></span></td>

                            <td><span class="glyphicon" ng-class="( (row.Mensajes==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td> 

                            <td><span class="glyphicon" ng-class="( (row.Contactos==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>

                            

                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-orange btn-xs" href=""  ng-click="getGrupos(row.Opciones)" data-toggle="modal" data-target="#modificar_grupo"><span class="glyphicon glyphicon-search"></span></a>
                                </div>
                            </td>


                        </tr>
                    </tbody>
                </table>
                <div tasty-pagination></div>
            </div>


    </div>





<!--MODAL DE EDICION-->
            <div id="modificar_grupo" class="modal fade" >
                <div class="modal-dialog modal-wide-md">
                    <!-- Modal content-->
                    <div class="modal-content ">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Grupo de usuario</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formGrupoM" role="form" novalidate>
                                 <div class="form-group porcentaje100">
                                    <md-input-container flex>
                                        <label>Descripcion</label>
                                        <input ng-model="permiso.Descripcion"  pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="usuario_noticia" type="text">

                                    </md-input-container>
                                </div>
                                
                                   <div class="form-group">
                                    <md-switch ng-model="permiso.Lib_Consol">
                                       Libro de Ventas Consolidado
                                    </md-switch>
                                </div> 
                                   <div class="form-group">
                                    <md-switch ng-model="permiso.Lib_Sucu">
                                            Libro de Ventas por sucursal
                                    </md-switch>
                                </div> 
                                  
                                   <div class="form-group">
                                    <md-switch ng-model="permiso.Facturacion">
                                           Facturacion
                                    </md-switch>
                                </div>
                                <div class="form-group">
                                    <md-switch ng-model="permiso.Usuarios">
                                      Usuarios
                                    </md-switch>
                                </div> 
                                <div class="form-group">
                                    <md-switch ng-model="permiso.Permisos">
                                        Permisos
                                    </md-switch>
                                </div>
                                   <div class="form-group">
                                    <md-switch ng-model="permiso.Empresas">
                                        Empresas
                                    </md-switch>
                                </div> <div class="form-group">
                                    <md-switch ng-model="permiso.Sucursales">
                                        Sucursales
                                    </md-switch>
                                </div>
                                  <div class="form-group">
                                    <md-switch ng-model="permiso.Mensajes">
                                        Mensajes
                                    </md-switch>
                                </div>  <div class="form-group">
                                    <md-switch ng-model="permiso.Contactos">
                                        Contactos
                                    </md-switch>
                                </div>
                                <div class="form-group">
                                    <md-switch ng-model="permiso.Estatus">
                                        Estatus
                                    </md-switch>
                                </div>


                            </form>
                            <div class="modal-footer">
                                <md-button class="md-raised md-primary" ng-click="registrar_grupo()">Guardar</md-button>

                                <md-button class=" md-raised btn-material-orange" ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


</div>


<script src="<?php echo base_url(); ?>public/js/Administrador/Usuarios.js"></script>




