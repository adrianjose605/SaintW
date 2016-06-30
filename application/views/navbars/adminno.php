<div layout="column" ng-cloak>
<md-toolbar layout="row"  class="md-theme-indigo md-hue-2 md-whiteframe-z1" >
    <div class="md-toolbar-tools">
        <md-button ng-click="toggleSidenav('left')" class="md-icon-button">
            <span class="glyphicon glyphicon-align-justify"></span>
        </md-button>
         <img src="public/img/MiniImagen1.png" width="90" height="70" >       
         <img src="public/img/SAINT.PNG">
    </div >
   
    <div class="md-toolbar-tools" style="padding-left: 60%">
        
        <md-button href="<?php echo base_url(); ?>usuarios/cerrar" class="md-icon-button" aria-label="More" style="padding-top: 10%">        
        <md-icon class="center" md-svg-src="public/icons/logout.svg" style="padding-top: 6%"></md-icon>

        </md-button>
          <h4 style="padding-top: 6%"><?php echo $nombre; ?></h4>
    </div>
 
</md-toolbar>

<section layout="row" flex>
    <md-sidenav layout="column" class="md-sidenav-left  md-whiteframe-z4" md-is-locked-open="$mdMedia('gt-lg')" md-disable-backdrop md-whiteframe="4" md-component-id="left" style="height:88%">
        <md-content layout-padding="">
            <accordion close-others="oneAtATime">

                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Inicio</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('Admin/Saa_libs/Dashboard')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> DashBoard <i class="fa fa-tachometer" aria-hidden="true"></i></p>
                        </md-list-item>
                        
                    </md-list>

                </accordion-group>
                    
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Ventas</p>
                    </accordion-heading> 
                      <?php if($LV==1): ?>
         
                    <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('Admin/Saa_libs/Lib_ventas')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Libro de ventas <i class="fa fa-file-pdf-o" aria-hidden="true"></i></p>
                        </md-list-item>
                        
                    </md-list>
                       <?php endif ?>
                           <?php if($Facturacion==1): ?>
         
                      <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('Admin/Saa_libs/Ventas')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Facturacion <i class="fa fa-file-pdf-o" aria-hidden="true"></i></p>
                        </md-list-item>
                           <?php endif ?>
         
                    </md-list>
                     
                </accordion-group>
               
            <?php if($Usuarios==1 || $Permisos==1): ?>
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Control de Acceso</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                    <?php if($Usuarios==1): ?>
                        <md-list-item ng-click="navigateTo('User/LUsuarios')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Usuarios de acceso</p>
                        </md-list-item>
                    <?php endif ?>
                    <?php if($Permisos==1): ?>
                        <md-list-item ng-click="navigateTo('User/GUsuarios')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Grupos de usuarios</p>
                        </md-list-item>
                    <?php endif ?>
                    </md-list>

                </accordion-group>
            <?php endif ?>
            <?php if($Empresas==1 || $Sucursales==1): ?>
                  <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Control de empresas</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                    <?php if($Empresas==1): ?>
                        <md-list-item ng-click="navigateTo('Sys/Empresas')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Registro de Empresas</p>
                        </md-list-item>
                    <?php endif ?>
                    <?php if($Sucursales==1): ?> 
                        <md-list-item ng-click="navigateTo('Sys/Sucursales')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span> Sucursales</p>
                        </md-list-item>
                    <?php endif ?>
                    </md-list>

                </accordion-group>
            <?php endif ?> 
            </accordion>
            <h4>Rango de Fecha a Consultar</h4>
            <md-datepicker ng-model="desde" md-placeholder="Desde"></md-datepicker>
            <md-datepicker ng-model="hasta" md-placeholder="Hasta"></md-datepicker>
            <div class="text-center">
                <md-button class="md-raised md-primary">Consultar</md-button>
            </div>
        </md-content>

      
    </md-sidenav>

   <md-content flex layout-padding>
 <div layout="column" layout-fill layout-align="top center">
        <p>
        The left sidenav will 'lock open' on a medium (>=960px wide) device.
        </p>
        <p>
        The right sidenav will focus on a specific child element.
        </p>
        <div>
          <md-button ng-click="toggleLeft()"
            class="md-primary" hide-gt-md>
            Toggle left
          </md-button>
        </div>
        <div>
          <md-button ng-click="toggleRight()"
            ng-hide="isOpenRight()"
            class="md-primary">
            Toggle right
          </md-button>
        </div>
      </div>
      <div flex></div>
    </md-content>
        </section>
</div>
    
