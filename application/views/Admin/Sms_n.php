<div class="marca"></div>
<div class="col-md-12 col-lg-12 col-xs-12" flex id="content" layout="column" layout-fill layout-align="top center" ng-controller="Sms" ng-cloak>
    
    <div class="col-md-12 col-xs-12 " style="margin-top: 5%"  >
        <div class="col-md-12 col-xs-12">  
        <div class="col-md-6 col-xs-12 ">
            <div class="panel panel-success ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"><i class="fa fa-user fa-5x"></i></div>
                        <div class="col-md-9 text-right"><h4>Contactos disponibles</h4></div>
                        <div class="col-md-12 ">

                       
                 <div class="col-md-6">
                    <form class="form-inline" name="formBusquedaUsuarios" role="form" novalidate>
                    <div class="col-md-8">
                      <md-input-container  ng-class="md-primary">
                        <label class="">Descripcion / Rif</label>
                        <input ng-model="busqueda.query" name="query_busqueda" type="text">                
                    </md-input-container>  
                    </div>
                    <div class="col-md-4">
                    <button class="md-fab md-mini md-primary md-button md-ink-ripple" type="button"  aria-label="Use Android"  ng-click="recargar()"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>   
                   </form>       
                </div>
               
                <div class="col-md-6">
                    
                    <div class="col-md-8">
                      <p>Seleccion Múltiple</p>
                    </div>
                    <div class="col-md-2 col-md-offset-1">
                    <md-checkbox class="md-secundary" ng-model="multiple" ng-click="select_all()"></md-checkbox>  
                    </div>
                  </div>
                          </div>

         
           

                    </div>
                </div>
 
    
         <div class="panel-body" style="height:280px;  overflow:auto;">
                    <strong>Contactos </strong>
                    <div id="progress1">
                      <center> <md-progress-circular  md-diameter="80"></md-progress-circular></center>
                    </div>
                     <!--<md-list>
                        <md-list-item ng-repeat="person in people" class="noright">
                            <img alt="{{ person.name }}" ng-src="{{ person.img }}" class="md-avatar" />
                            <p>{{ person.name }}</p><p>{{ person.n}}</p>
                            <md-checkbox class="md-secondary" ng-model="person.selected"></md-checkbox>
                           </md-list-item>
                    </md-list>-->
                 <div ng-show="contador != 0" tasty-table bind-resource-callback="getResourceC" bind-filters="paginador">
                <table class="table table-striped table-condensed" >
                    <thead tasty-thead bind-not-sort-by="notSortBy" class="centrado"></thead>
                    <tbody id="tabla">
                        <tr ng-repeat="row in rows" class="centrado">
                           <td>{{ row.Descripcion}}</td>        
                              
                            <td>{{ row.Telefono}}</td>                                                      
                                                        
                            <td>
                               <md-checkbox class="md-primary" aria-label="Use Android" ng-model="row.selected"></md-checkbox>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <div tasty-pagination></div>
            </div>
                </div>
            </div>
        </div> 
        <div class="col-md-5 col-xs-12 col-lg-4" >
            <div class="panel panel-success">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"><i class="fa fa-comment fa-5x"></i></div>
                        <div class="col-md-9 text-right"><h4>Nuevo mensaje </h4></div>
                    </div>
                </div>
                <div class="panel-body" >
                    <strong>Enviados</strong>
                    <div id="progress2">
                      <center> <md-progress-circular  md-diameter="70"></md-progress-circular></center>
                    </div>

                    <div id="sms_n">
                     <form name="sms_nuevo"> 
                     <textarea id="campo_sms"  ng-model="mensaje" maxlength="160" required md-no-asterisk style="width: 100%; height: 30%" onkeyup="Textarea_Sin_Enter(event.keyCode, event.which, 'campo_sms')"></textarea>
                    
                        <md-button  style="width: 90%;" id="nuevo" class="md-raised md-primary" data-toggle="modal"  ng-click="enviar()">Enviar</md-button>
                   </form>
                    </div>
                </div>
            </div>

        </div>
        </div>
        <div class="col-md-12 col-xs-12">  

       	<div class=" col-md-11 col-xs-12 col-lg-10">
            <div class="panel panel-info ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"><i class="fa fa-comments fa-5x"></i></div>
                        <div class="col-md-9 text-right"><h4>Mensajes recientes </h4></div>
                    </div>
                </div>
                <div class="panel-body col-xs-12" style="height:280px;  overflow:auto;">
                 <strong>Mensaje reciente </strong>
                 <div id="progress3">
                      <center> <md-progress-circular  md-diameter="80"></md-progress-circular></center>
                    </div>
                  <md-list>
                    
                        <md-list-item ng-repeat="mensaje in sms" class="noright">
                       
                           <div class="col-xs-3"><p >{{mensaje.fecha}}</p></div>
                          <div class="col-xs-3"> <p >{{mensaje.prev}}</p></div>
                           <div class=" col-xs-1 col-xs-offset-4"> <span class="glyphicon" ng-class="( (mensaje.estatus==1) ? 'mdi-action-done activo' : 'mdi-action-highlight-remove inactivo')" aria-hidden="true" title="ACTIVO" style="color:green"></span></div>
                           <div class="col-xs-1"> <md-checkbox class="md-secondary" ng-model="mensaje.selected"></md-checkbox></div>
                            
                       </md-list-item>
                       
                    </md-list>
                   
                </div>
                <md-button  style="width: 50 %; margin-left:85%" id="eliminar" class="md-raised md-primary" data-toggle="modal"  ng-click="eliminar()">Eliminar</md-button>
            </div>
        </div>
        </div>

    </div>
    </div>
    
<script src="<?php echo base_url(); ?>public/js/Administrador/Sms.js"></script>