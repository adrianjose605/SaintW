<div class="marca"></div>
<div style="position: relative;" ng-controller="GUsuarios" layout="column" flex id="content" ng-cloak>
    <div class="container" style="width:95%">
        <h1 >Usuarios</h1>

        <h3>Busqueda</h3>

            <form class="form-inline" name="formBusquedaUsuarios" role="form" novalidate>
                <div class="form-group">
                    <md-input-container flex ng-class="md-primary">
                        <label class="">Nombre / Abrev</label>
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




            <div ng-show="contador != 0" tasty-table bind-resource-callback="getResourceU" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody id="tabla">
                        <tr ng-repeat="row in rows" class="centrado">
                        <td>{{ row.Usuario}}</td>
                            <td>{{ row.Nombre}}</td>
                            <td>{{ row.Apellido}}</td>
                            <td>{{ row.Fecha_registro}}</td>
                            <td>{{ row.Privilegios}}</td>                                  
                            <td>{{ row.Empresa}}</td>                                  
                            <td><span class="glyphicon" ng-class="( (row.Estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-material-orange btn-xs" href=""  ng-click="getUsuarios(row.Opciones)" data-toggle="modal" data-target="#modificar_noticia"><span class="glyphicon glyphicon-search"></span></a>
                                </div>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <div tasty-pagination style="width:100%"></div>
            </div>

<!--NUEVO MODAL-->
            <div id="nuevo_usuario" class="modal fade" role="dialog">
                <div class="modal-dialog">                
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" ng-click="resetForm();" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Nuevo usuario</h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-inline" name="formUsuarioN" role="form" validate>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Usuario</label>
                                        <input ng-model="user2.Usuario" type="text" name="Usuario" required  pattern="[a-zA-Z]+">
                                          <div ng-messages="formUsuarioN.Usuario.$error">
                                            <div ng-message="required">Ingrese su Usuario.</div>
                                             <div ng-message="md-maxlength">Maximo 20 caracteres</div>
                                          </div>
                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input maxlength="30" ng-model="user2.Nombre" ng-readonly="false" pattern="[a-zA-Z]+" type="text" name="nombre_usuario">
                                        <ng-messages for="formUsuarioN.Nombre.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Nombre</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>

                                    </md-input-container>
                                </div>
                                   <div class="form-group">
                                    <md-input-container flex>
                                        <label>Apellido</label>
                                        <input ng-model="user2.Apellido" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="detalle_noticia" type="text">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Correo</label>
                                        <input ng-model="user2.Correo"  pattern="^[a-zA-Z0-9áéíóúñ@_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="correo" type="mail">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Telefono</label>
                                        <input ng-model="user2.Telefono"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="correo" type="phone">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>

                                    <md-select name="empresa" md-on-open="cargarEmpresas()" placeholder="Empresa" ng-model="user2.id_Empresa" required>      
                                        <md-option ng-repeat="tcon in empresa_t" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="formUsuarioN.tipos.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un tipo de Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>

                                    <md-select name="tipos" md-on-open="cargarGrupos()" placeholder="Grupo de Usuario" ng-model="user2.id_Grupo" required>      
                                        <md-option ng-repeat="tcon in grupo_t" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="formUsuarioN.tipos.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un tipo de Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                                </div>

                                
                                 <div class="form-group">
                                    <md-input-container flex>
                                        <label>Contaseña</label>
                                        <input ng-model="user2.Clave"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="pass" type="password" >
                                    </md-input-container>
                                </div>
                                 <div class="form-group">
                                    <md-switch ng-model="user2.Estatus">
                                        Activo
                                    </md-switch>
                                </div>

                            </form>                        </div>
                        <div class="modal-footer">


                            <md-button class="md-raised md-primary" ng-click="registrar_usuario(true)">Registrar</md-button>
                            <md-button   ng-click="resetForm();" data-dismiss="modal">Cerrar</md-button>
                        </div>
                    </div>

                </div>
            </div>




            <!--MODAL DE EDICION-->
            <div id="modificar_usuario" class="modal fade" >
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
                                        <label>Usuario</label>
                                        <input ng-model="usuarioN.Usuario"  ng-readonly="true" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="usuario_noticia" type="text">

                                    </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-input-container flex>
                                        <label>Nombre</label>
                                        <input maxlength="30" ng-model="usuarioN.Nombre" pattern="[a-zA-Z]+" type="text" name="nombre_usuario">
                                        <ng-messages for="formNoticiaM.nombre_usuario.$error" role="alert" ng-if="submitted">
                                            <ng-message when="required">Debe indicar un Titulo</ng-message>
                                            <ng-message when="pattern">El titulo deben ser caracteres</ng-message>  
                                        </ng-messages>

                                    </md-input-container>
                                </div>
                                   <div class="form-group">
                                    <md-input-container flex>
                                        <label>Apellido</label>
                                        <input ng-model="usuarioN.Apellido"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="detalle_noticia" type="text">

                                    </md-input-container>
                                </div>
                               <div class="form-group">
                                    <md-input-container flex>
                                        <label>Correo</label>
                                        <input ng-model="usuarioN.Correo" type="email">                            
                                    </md-input-container>
                                </div>
                                 <div class="form-group">
                                    <md-input-container flex>
                                        <label>Telefono</label>
                                        <input ng-model="usuarioN.Telefono">                            
                                    </md-input-container>
                                </div>
                              <div class="form-group">
                                    <md-input-container flex>

                                    <md-select name="empresa" md-on-open="cargarEmpresas()" placeholder="Empresa" ng-model="usuarioN.id_Empresa" required>      
                                        <md-option ng-repeat="tcon in empresa_t" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.tipos.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un tipo de Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                                </div>
                                 <div class="form-group">
                                <md-input-container flex>

                                    <md-select name="tipos" md-on-open="cargarGrupos()" placeholder="Grupo de Usuario" ng-model="usuarioN.id_Grupo" required>      
                                        <md-option ng-repeat="tcon in grupo_t" ng-value="tcon.id">{{tcon.val}}</md-option>
                                    </md-select>
                                    <ng-messages for="modificar.tipos.$error" role="alert" ng-if="submitted">
                                        <ng-message when="required">Debe seleccionar un tipo de Jugada</ng-message>                        
                                    </ng-messages>

                                </md-input-container>
                                </div>
                                <div class="form-group">
                                    <md-switch ng-model="usuarioN.Estatus">
                                        Activo
                                    </md-switch>
                                </div>
                                 <div class="form-group">
                                    <md-input-container flex>
                                        <label>Contaseña</label>
                                        <input ng-model="usuarioN.Clave"  ng-readonly="false" pattern="^[a-zA-Z0-9áéíóúñ_]+( [a-zA-Z0-9áéíóúñ _]+)*$" name="pass" type="password" >
                                    </md-input-container>
                                </div>
                                

                            </form>
                            <div class="modal-footer">
                                <md-button class="md-raised md-primary" ng-click="registrar_usuario()">Guardar</md-button>

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
<script src="<?php echo base_url(); ?>public/js/Administrador/Usuarios.js"></script>










