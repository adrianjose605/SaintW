angular.module('saint')

.controller('Sms', ['$scope','$http','$mdDialog', us])
function us($scope,$http,$mdToast, $mdDialog){
		
 $scope.people = [
    { name: 'Janet Perkins',n:'4249342034', img: 'public/img/persona.png', newMessage: true },
    { name: 'Mary Johnson', n:'4148764436',img: 'public/img/persona.png', newMessage: false },
    { name: 'Peter Carlsson',n:'4261944366', img: 'public/img/persona.png', newMessage: false },
    { name: 'Peter Carlsson', n: '4165889536',img: 'public/img/persona.png', newMessage: false },
    { name: 'Peter Carlsson', n: '4249108775',img: 'public/img/persona.png', newMessage: false },
    { name: 'Peter Carlsson', n: '4249715487',img: 'public/img/persona.png', newMessage: false }
  ];
  $scope.goToPerson = function(person, event) {
    $mdDialog.show(
      $mdDialog.alert()
        .title('Navigating')
        .textContent('Inspect ' + person)
        .ariaLabel('Person inspect demo')
        .ok('Neat!')
        .targetEvent(event)
    );
  };
   $scope.navigateTo = function(to, event) {
    $mdDialog.show(
      $mdDialog.alert()
        .title('Navigating')
        .textContent('Imagine being taken to ' + to)
        .ariaLabel('Navigation demo')
        .ok('Neat!')
        .targetEvent(event)
    );
  };
  $scope.doPrimaryAction = function(event) {
    $mdDialog.show(
      $mdDialog.alert()
        .title('Primary Action')
        .textContent('Primary actions can be used for one click actions')
        .ariaLabel('Primary click demo')
        .ok('Awesome!')
        .targetEvent(event)
    );
  };
  $scope.doSecondaryAction = function(event) {
    $mdDialog.show(
      $mdDialog.alert()
        .title('Secondary Action')
        .textContent('Secondary actions can be used for one click actions')
        .ariaLabel('Secondary click demo')
        .ok('Neat!')
        .targetEvent(event)
    );
  };
}