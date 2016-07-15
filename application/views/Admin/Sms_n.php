<div class="marca_250"></div>
<div class="col-md-12 col-lg-12 col-xs-12" flex id="content" layout="column" layout-fill layout-align="top center" ng-controller="Sms" ng-cloak>
    
    <div class="col-md-12 col-xs-12 " style="margin-top: 5%"  >
        <div class="col-md-12 col-xs-12">  
        <div class="col-md-6 col-xs-12 ">
            <div class="panel panel-success ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"><i class="fa fa-user fa-5x"></i></div>
                        <div class="col-md-9 text-right"><h4>Sms. {{cant_clts}} Contactos</h4>
                        <md-checkbox class="md-secondary" ng-model="person.selected"></md-checkbox></div>
                    </div>
                </div>
   <!--  <md-switch
        ng-model="activated"
        aria-label="Toggle Progress Circular Indicators">
      <h5>On</h5>
    </md-switch> -->
                <div class="panel-body" style="height:300px;  overflow:auto;">
                    <strong>Contactos</strong>
                    <div ng-class="{'visible' : !activated}">
                       <!-- <md-progress-linear    ng-disabled="!activated"></md-progress-linear> --></div>
                        <md-list-item ng-repeat="person in people" ng-click="goToPerson(person.name, $event)" class="noright">
                            <img alt="{{ person.name }}" ng-src="{{ person.img }}" class="md-avatar" />
                            <p>{{ person.name }}</p><p>{{ person.n }}</p>
                            <md-checkbox class="md-secondary" ng-model="person.selected"></md-checkbox>
                            <md-icon md-svg-icon="communication:email"  ng-click="doSecondaryAction($event)" aria-label="Send Email" class="md-secondary md-hue-3" ></md-icon>
                            <md-icon class="md-secondary" ng-click="doSecondaryAction($event)" aria-label="Chat" md-svg-icon="communication:message"></md-icon>
                        </md-list-item>
                    </md-list>
                
                </div>
            </div>
        </div> 
        <div class="col-md-3 col-xs-12">
            <div class="panel panel-success ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"><i class="fa fa-comment fa-5x"></i></div>
                        <div class="col-md-9 text-right"><h4>Nuevo mensaje </h4></div>
                    </div>
                </div>
                <div class="panel-body">
                    <strong>Enviados</strong>
                    <textarea style="width: 100%; height: 30%"></textarea>
                    <md-button  style="width: 90%;" id="nuevo" class="md-raised md-primary" data-toggle="modal"  data-target="#nuevo_grupo">Enviar</md-button>
                
                </div>
            </div>

        </div>
        </div>
        <div class="col-md-12 col-xs-12">  

       	<div class=" col-md-3 col-xs-12">
            <div class="panel panel-success ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"><i class="fa fa-comments fa-5x"></i></div>
                        <div class="col-md-9 text-right"><h4>Mensajes recientes </h4></div>
                    </div>
                </div>
                <div class="panel-body">
                    <strong>MENSAJE</strong>
                    <textarea style="width: 100%; height: 30%"></textarea>
                    <md-button  style="width: 90%;" id="nuevo" class="md-raised md-primary" data-toggle="modal"  data-target="#nuevo_grupo">Cargar</md-button>
                
                </div>
            </div>
        </div><div class="col-md-6 col-xs-12">
            <div class="panel panel-success ">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"><i class="fa fa-eye fa-5x"></i></div>
                        <div class="col-md-9 text-right"><h4>Previsualizacion </h4></div>
                    </div>
                </div>
                <div class="panel-body">
                    <strong>MENSAJE NUEVO</strong>
                    <textarea style="width: 100%; height: 30%"></textarea>
                    <md-button  style="width: 90%;" id="nuevo" class="md-raised md-primary" data-toggle="modal"  data-target="#nuevo_grupo">Enviar</md-button>
                
                </div>
            </div>
        </div>
        </div>

    </div>
    </div>
    
<script src="<?php echo base_url(); ?>public/js/Administrador/Sms.js"></script>