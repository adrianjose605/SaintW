angular.module('saint').
controller('Login', ['$scope','$http','$mdToast','$mdDialog', '$mdMedia', function($scope,$http,$mdToast,$mdDialog, $mdMedia){
	
	$scope.alerta_nueva={};
	$scope.busqueda={estatus:false,query:''};
	$scope.paginador={valor:true};
	$scope.user={"title":"adrian"};
	$scope.contador=0;
	$scope.submitted = false;

	$scope.status = '  ';
  	$scope.customFullscreen = $mdMedia('xs') || $mdMedia('sm');
$scope.showAdvanced = function(ev) {
    var useFullScreen = ($mdMedia('sm') || $mdMedia('xs'))  && $scope.customFullscreen;
    $mdDialog.show({
      controller: DialogController,
      templateUrl: 'Usuarios/log',
      parent: angular.element(document.body),
      targetEvent: ev,
      clickOutsideToClose:true,
      fullscreen: useFullScreen,

    })

    .then(function(answer) {
      $scope.status = 'You said the information was "' + answer + '".';
    }, function() {
      $scope.status = 'You cancelled the dialog.';
    });
    $scope.$watch(function() {
      return $mdMedia('xs') || $mdMedia('sm');
    }, function(wantsFullScreen) {
      $scope.customFullscreen = (wantsFullScreen === true);
    });
  };






}]);

function DialogController($scope, $mdDialog) {
$scope.user={"usuario":"","clave":""};



//  $scope.hide = function() {
//    $mdDialog.hide();
//  };
//  $scope.cancel = function() {
//    $mdDialog.cancel();
//  };
//  $scope.answer = function(answer) {
//    $mdDialog.hide(answer);
//  };
};