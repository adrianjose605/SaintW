angular.module('saint', ['ngMaterial', 'ngMessages', 'ngTasty', 'ui.bootstrap','datePicker']).
        controller('ToastCtrl', function($scope, $mdToast) {
            $scope.closeToast = function() {
                $mdToast.hide();
            };
        })
        .controller('AppCtrl', ['$scope', '$mdSidenav', function($scope, $mdSidenav) {
                $scope.oneAtATime = true;
                $scope.toggleSidenav = function(menuId) {
                    $mdSidenav(menuId).toggle();
                    
                };
             
                $scope.navigateTo = function(url) {
                    window.location=(base_url+url);
                };
            }]).config(function($mdThemingProvider) {
  $mdThemingProvider.theme('default')
    .primaryPalette('light-blue', {
      'default': '800', // by default use shade 400 from the pink palette for primary intentions
      'hue-1': '100', // use shade 100 for the <code>md-hue-1</code> class
      'hue-2': '800', // use shade 600 for the <code>md-hue-2</code> class
      'hue-3': 'A100' // use shade A100 for the <code>md-hue-3</code> class
    })
    .accentPalette('orange',{
        'default': '600'
    });
});
function hacerToast(type, msg, toast) {

    toast.show({
        controller: 'ToastCtrl',
        template: '<md-toast class="md-toast ' + type + '"> <span flex>' + msg + '</span> <md-button ng-click="closeToast();">OK</md-button></md-toast>',
        hideDelay: 6000,
        position: 'top rigt'
    });
};
