<div ng-controller="Ctrl" layout="column" style="height:95%;" ng-cloak>
<md-toolbar layout="row"  class="md-theme-indigo md-hue-2 md-whiteframe-z1" >
<div class="col-xs-6">
    <div class="md-toolbar-tools">
        <md-button ng-click="toggleSidenav('left')" class="md-icon-button">
            <span class="glyphicon glyphicon-align-justify"></span>
        </md-button>
           <img src="public/img/MiniImagen1.png" width="12%" style="padding-top: 2%;">       
            <img src="public/img/SAINT.PNG" height="55%">
    </div >
</div>
<div class="col-xs-3 col-xs-offset-3">
     <div class="md-toolbar-tools">
        
        <md-button href="<?php echo base_url(); ?>usuarios/cerrar" class="md-icon-button" aria-label="More" style=" padding-top: 2%; width: 15%; height: 15%;" >        
        <md-icon class="center" md-svg-src="public/icons/logout.svg" ></md-icon>

        </md-button>
          <h4 ><?php echo $nombre; ?></h4>
    </div>

</div>
 
 
</md-toolbar>
  <section layout="row" flex>
    <md-sidenav
        class="md-sidenav-left md-whiteframe-z4"
        md-component-id="left"
        md-is-locked-open="$mdMedia('gt-md')"
        md-disable-backdrop
        md-whiteframe="4">
      <md-toolbar class="md-theme-indigo">
        <h1 class="md-toolbar-tools">Panel de opciones</h1>
      </md-toolbar>
      <md-content layout-padding ng-controller="LeftCtrl">
        <accordion close-others="oneAtATime">

                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Inicio</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('Admin/Saa_libs/Dashboard')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-tachometer fa-2x" aria-hidden="true"></i>  DashBoard</p>
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
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Libro de ventas </p>
                        </md-list-item>
                        
                    </md-list>
                       <?php endif ?>
                           <?php if($Facturacion==1): ?>
         
                      <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('Admin/Saa_libs/Ventas')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-list-alt fa-2x" aria-hidden="true"></i> Facturacion </p>
                        </md-list-item>
                           <?php endif ?>
         
                    </md-list>
                     
                </accordion-group> 
                <?php if($Sms==1 || $Contac==1): ?>
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Mensajeria</p>
                    </accordion-heading> 
                      <?php if($Sms==1): ?>
         
                    <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('Admin/Sms/nuevo')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-paper-plane fa-2x" aria-hidden="true"></i> Mensajes </p>
                        </md-list-item>
                        
                    </md-list>
                       <?php endif ?>
                           <?php if($Contac==1): ?>
         
                      <md-list class="listdemoListControls">
                        <md-list-item ng-click="navigateTo('Admin/Saa_libs/Ventas')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-user fa-2x" aria-hidden="true"></i> Contactos </p>
                        </md-list-item>
                           <?php endif ?>
         
                    </md-list>
                     
                </accordion-group>
               <?php endif ?>
            <?php if($Usuarios==1 || $Permisos==1): ?>
                <accordion-group>
                    <accordion-heading>
                        <p><span class="glyphicon glyphicon-menu-down" style="margin-right: 10px;"></span> Control de Acceso</p>
                    </accordion-heading> 
                    <md-list class="listdemoListControls">
                    <?php if($Usuarios==1): ?>
                        <md-list-item ng-click="navigateTo('User/LUsuarios')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i> Usuarios de acceso</p>
                        </md-list-item>
                    <?php endif ?>
                    <?php if($Permisos==1): ?>
                        <md-list-item ng-click="navigateTo('User/GUsuarios')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-users fa-2x" aria-hidden="true"></i> Grupos de usuarios</p>
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
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-key fa-2x" aria-hidden="true"></i> Registro de Empresas</p>
                        </md-list-item>
                    <?php endif ?>
                    <?php if($Sucursales==1): ?> 
                        <md-list-item ng-click="navigateTo('Sys/Sucursales')">
                            <p><span class="glyphicon glyphicon-menu-right" style="margin-right: 10px;"></span><i class="fa fa-university fa-2x" aria-hidden="true"></i> Sucursales</p>
                        </md-list-item>
                    <?php endif ?>
                    </md-list>

                </accordion-group>
            <?php endif ?> 
            </accordion>


      </md-content>
    </md-sidenav>



    <md-content flex layout-padding>
