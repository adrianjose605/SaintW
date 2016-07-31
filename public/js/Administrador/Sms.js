angular.module('saint')

.controller('Sms', ['$scope','$http','$mdDialog','$interval','$mdToast', us])
function us($scope,$http, $interval,$mdDialog,$mdToast){

  $('#progress1').show();
	$('#progress3').show();
  $('#progress2').hide();
$scope.clts= function (){
  $scope.activated=true;
 
     $('#progress1').show();
     $('#progress2').hide();
  $http.get("Admin/Sms/clientes/")
      .success(function(data){
        $scope.people = data;

        $scope.cant_clts = data.length;
        
        //console.log($scope.people[2]['selected']);
         /* for (var i = 0; i <= $scope.people.length; i++) {
          //    $scope.people[i].selected=false;      
          }*/
         $scope.activated=false;
       
            $('#progress1').hide();
     
      });
    };
      $scope.sms_recent= function (){
      $http.get("Admin/Sms/recent/")
      .success(function(data){
        $scope.sms = data;
          $('#progress3').hide();
            
      });
    };
$(window).load(function() {
 $scope.clts();
 $scope.sms_recent();
});
   $scope.select_all= function (){
    
    for (var i = 0; i < $scope.people.length; i++) {
       $scope.people[i]['selected']=$scope.people[i]['selected']==false;
    }
   
   };   

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
    $('#progress2').show();
    $('#sms_n').hide();
$scope.sms_cts=[];
$scope.post=[{}];var j=0;




    for (var i = 0; i < $scope.people.length; i++) {
            if($scope.people[i]['selected']==true){
              $scope.sms_cts[j]={'id':'0', 'cel':$scope.people[i]['n'],'nom':$scope.people[i]['name']}; 
              j++;
            } 

           }

   if($scope.sms_cts.length>0){
        
   
    if($scope.sms_cts.length>=300){
     hacerToast('error','Son mas de 300 mensajes, esto puede tardar un poco. ',$mdToast);
    }

    $scope.post[0]=$scope.sms_cts;
    $scope.post[1]=$scope.mensaje;
     


    $http.post("Admin/Sms/send_sms/",JSON.stringify($scope.post))
      .success(function(data){
       $('#progress2').hide();
       $('#sms_n').show();
        hacerToast('success','Mensaje Enviado con exito',$mdToast);
         $scope.sms_recent();

      }).error(function(data,status){
        $('#progress2').hide();
        $('#sms_n').show();
        hacerToast('error','Error '+status,$mdToast);
         $scope.sms_recent();
      });
             
       }else{
        hacerToast('error','Sin destinatario',$mdToast);
        $('#progress2').hide();
        $('#sms_n').show();

       }        
 
  }
}