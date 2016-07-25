angular.module('saint')

.controller('Sms', ['$scope','$http','$mdDialog','$interval', us])
function us($scope,$http,$mdToast, $mdDialog,$interval){
		//$scope.people={selected:false};
 /*$scope.people = [
    { name: 'Janet Perkins',n:'4249342034', img: 'public/img/persona.png' },
    { name: 'Mary Johnson', n:'4148764436',img: 'public/img/persona.png' },
    { name: 'Peter Carlsson',n:'4261944366', img: 'public/img/persona.png' },
    { name: 'Peter Carlsson', n: '4165889536',img: 'public/img/persona.png' },
    { name: 'Peter Carlsson', n: '4249108775',img: 'public/img/persona.png' },
    { name: 'Peter Carlsson', n: '4249715487',img: 'public/img/persona.png'}
  ];*/
  $scope.activated=true;
  $http.get("Admin/Sms/clientes/")
      .success(function(data){
        $scope.people = data;

        $scope.cant_clts = data.length;
        console.log($scope.people);
        console.log($scope.people[2]['selected']);
          for (var i = 0; i <= $scope.people.length; i++) {
          //    $scope.people[i].selected=false;      
          }
         //$scope.activated=false;
      });
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
  $scope.enviar = function() {
$scope.sms_cts=[{}];
$scope.post=[{}];var j=0;
    for (var i = 0; i < $scope.people.length; i++) {
            if($scope.people[i]['selected']==true){
              $scope.sms_cts[j]={'id':'0', 'cel':$scope.people[i]['n'],'nom':$scope.people[i]['name']}; 
              j++;
            } 

           }
    $scope.post[0]=$scope.sms_cts;
    $scope.post[1]=$scope.mensaje;
    
    $http.post("Admin/Sms/send_sms/",JSON.stringify($scope.post))
      .success(function(data){
        console.log(data);
      });
              //console.log($scope.mensaje); 
              //console.log($scope.sms_cts); 
 
  }
}