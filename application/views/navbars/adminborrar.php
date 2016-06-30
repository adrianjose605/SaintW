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

<script type="text/javascript">
    angular
  .module('sidenavDemo1', ['ngMaterial'])
  .controller('AppCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.toggleLeft = buildDelayedToggler('left');
    $scope.toggleRight = buildToggler('right');
    $scope.isOpenRight = function(){
      return $mdSidenav('right').isOpen();
    };
    /**
     * Supplies a function that will continue to operate until the
     * time is up.
     */
    function debounce(func, wait, context) {
      var timer;
      return function debounced() {
        var context = $scope,
            args = Array.prototype.slice.call(arguments);
        $timeout.cancel(timer);
        timer = $timeout(function() {
          timer = undefined;
          func.apply(context, args);
        }, wait || 10);
      };
    }
    /**
     * Build handler to open/close a SideNav; when animation finishes
     * report completion in console
     */
    function buildDelayedToggler(navID) {
      return debounce(function() {
        // Component lookup should always be available since we are not using `ng-if`
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug("toggle " + navID + " is done");
          });
      }, 200);
    }
    function buildToggler(navID) {
      return function() {
        // Component lookup should always be available since we are not using `ng-if`
        $mdSidenav(navID)
          .toggle()
          .then(function () {
            $log.debug("toggle " + navID + " is done");
          });
      }
    }
  })
  .controller('LeftCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.close = function () {
      // Component lookup should always be available since we are not using `ng-if`
      $mdSidenav('left').close()
        .then(function () {
          $log.debug("close LEFT is done");
        });
    };
  })
  .controller('RightCtrl', function ($scope, $timeout, $mdSidenav, $log) {
    $scope.close = function () {
      // Component lookup should always be available since we are not using `ng-if`
      $mdSidenav('right').close()
        .then(function () {
          $log.debug("close RIGHT is done");
        });
    };
  });
</script>
<section layout="row" flex>
    <md-sidenav
        class="md-sidenav-left"
        md-component-id="left"
        md-is-locked-open="$mdMedia('gt-md')"
        md-disable-backdrop
        md-whiteframe="4">
      <md-toolbar class="md-theme-indigo">
        <h1 class="md-toolbar-tools">Sidenav Left</h1>
      </md-toolbar>
      <md-content layout-padding ng-controller="LeftCtrl">
        <md-button ng-click="close()" class="md-primary" hide-gt-md>
          Close Sidenav Left
        </md-button>
        <p hide show-gt-md>
          This sidenav is locked open on your device. To go back to the default behavior,
          narrow your display.
        </p>
      </md-content>
    </md-sidenav>
   
    
 
 
 
    


 <div class="marca" ></div>