angular.module('saint')

.controller('Sms', ['$scope','$http','$mdDialog','$interval','$mdToast', us])
function us($scope,$http, $interval,$mdDialog,$mdToast){

  $('#progress1').show();
	$('#progress3').show();
  $('#progress2').hide();
  $scope.busqueda={estatus:true,query:''};
$scope.clts= function (){
  $scope.activated=true;
 
     $('#progress1').show();
     $('#progress2').hide();
  $http.get("Admin/Sms/clientes/")
      .success(function(data){
        
        $scope.people = data['rows'];

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
// $scope.clts();
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
              $scope.sms_cts[j]={'id':'0', 'cel':$scope.people[i]['Telefono'],'nom':$scope.people[i]['Descripcion']}; 
              j++;
            } 
    }

   if($scope.sms_cts.length>0){
        
   
    if($scope.sms_cts.length>=300){
     hacerToast('error','Son mas de 300 mensajes, esto puede tardar un poco. ',$mdToast);
    }

    $scope.post[0]=$scope.sms_cts;
    $scope.post[1]=$scope.mensaje;
     

    //console.log(JSON.stringify($scope.post));
    $http.post("Admin/Sms/send_sms/",JSON.stringify($scope.post))
      .success(function(data){
       $('#progress2').hide();
       $('#sms_n').show();
       if(data['status']==200){
        hacerToast('success','Mensaje Enviado con exito',$mdToast);
         $scope.sms_recent();
       }else{
        //console.log(data);
        //console.log('er1');
         hacerToast('error','Error intente mas tarde',$mdToast);
         $scope.sms_recent();
       }
      
        

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

$scope.eliminar=function(){
  $scope.sms_el=[];var j=0;
   $scope.post1=[];
 for (var i = 0; i < $scope.sms.length; i++) {
            if($scope.sms[i]['selected']==true){
              $scope.sms_el[j]={'id':$scope.sms[i]['id']}; 
              j++;
            } 
    }

   if($scope.sms_el.length>0){

    
   $scope.post1[0]=$scope.sms_el;
   $http.post("Admin/Sms/delete_sms/",JSON.stringify($scope.post1))
      .success(function(data){
       
       if(data=='true'){
        hacerToast('success','Mensaje Eliminado',$mdToast);
         $scope.sms_recent();
       }else{
         hacerToast('error','Error '+data,$mdToast);
         $scope.sms_recent();
       }
      
        

      }).error(function(data,status){
      
        hacerToast('error','Error '+status,$mdToast);
         
      });

 

   }
  
}
$scope.recargar=function(){
      $scope.paginador.valor=!$scope.paginador.valor;
    }

$scope.getResourceC = function (params, paramsObj) {  
    if(!paramsObj){
     // console.log('Cambio  de Asignacion');
      paramsObj=$scope.paginador;
      //console.log(paramsObj);
    }

    
    $scope.paginador=paramsObj;
    //console.log('Antes de la Carga Inicial');
    

    var urlApi = 'Admin/Sms/tabla_principal_clientes/200/'+paramsObj.page+'/';
  
    if(paramsObj.sortBy){
      urlApi+=paramsObj.sortBy+'/'+paramsObj.sortOrder;    
    }

    return $http.post(urlApi,$scope.busqueda).then(function (response) {
      
       $('#progress1').hide();
      $scope.contador=response.data.pagination.size;
       $scope.people=response.data.rows;
    
      return {
        'rows': response.data.rows,
        'header': response.data.header,
        'pagination': response.data.pagination,
        'sortBy': response.data['sort-by'],
        'sortOrder': response.data['sort-order']
      }
    });
  };


}


function Textarea_Sin_Enter($char, $mozChar, $id){
   //alert ($char+" "+$mozChar);
   $textarea = document.getElementById($id);
   niveles = -1;
    
   if($mozChar != null) { // Navegadores compatibles con Mozilla
       if($mozChar == 13){
           if(navigator.appName == "Opera") niveles = -2;
           $textarea.value = $textarea.value.slice(0, niveles);
       }
   // navegadores compatibles con IE
   } else if($char == 13) $textarea.value = $textarea.value.slice(0,-2);
}