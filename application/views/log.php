<div layout="column"  class="" style=" max-width:350px;" >
    <md-toolbar layout="row"  class="col-xs-12" >
        <div class="md-toolbar-tools">
        <img src="public/img/MiniImagen1.png"  width="20%" style="position: absolute;left: 4px;">
            <center style=" width:100%;"><h1 >Bienvenido a Saint Web</h1></center>
        </div>
    </md-toolbar>
   
        <div   class="col-xs-12" style="margin-top: 30px;"   >
        <md-content layout-padding >
           <form method="post" action="usuarios/verificacion"  name="formSesion" role="form" novalidate>
                  <div class="col-xs-12">
                      <div class="col-xs-12">
                      
                <md-input-container style="margin-top: 6%; width: 100%" class="" >
                    <label>Usuario</label>
                    <input required md-no-asterisk name="usuario" ng-model="user.usuario" type="text" required>
                    <div ng-messages="formSesion.usuario.$error"  ng-if="formSesion.usuario.$dirty">
                        <div ng-message="required">Ingrese su Usuario.</div>
                        
                     </div>
                </md-input-container>
                      </div>
                      <div class="col-xs-12 ">
                          <md-input-container class="" style=" width: 100%" >
                    <label>Contraseña</label>
                    <input required name="clave"  ng-model="user.clave" type="password" >
                    <div ng-messages="formSesion.clave.$error" ng-if="formSesion.clave.$dirty">
                        <div ng-message="required">Ingrese su Contraseña.</div>
                    </div>
                         </md-input-container>

                      </div>


                  </div>
                  <div class="col-xs-12">
                      <div class="col-xs-12">
                        <center>   <p class="text-center"  style="color: #FF0000; font-weight: bold;" ><?php echo $this->session->userdata('mensaje')?></p>
                    <md-button style="margin-top: 5%; width: 35%;" type="submit" class="md-raised md-primary" >Ingresar</md-button>
                        </center>
                      </div>
                  </div>
              

                   <!-- <md-button class="md-fab  md-warn md-hue-2" style="margin-left: 20%" href="<?php echo base_url(); ?>usuarios/personas" >
                        <md-icon class="center" md-svg-src="public/icons/formas.svg" style="margin-top: 33%"></md-icon>
                    </md-button>-->
                <div flex layout="row"></div>
                <div flex></div>
                <!--<div flex></div>-->
               
          

             


        </form>
            </md-content>

        </div>
        <div class="col-xs-6" show hide-gt-xs></div>
     <center></center>
   
</div>



