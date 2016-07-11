angular.module('saint')

.controller('Lib', ['$scope','$http',us])



	function us($scope,$http,$mdToast){
 $scope.pdfName = 'Relativity: The Special and General Theory by Albert Einstein';
  $scope.pdfUrl = 'public/pdf/relativity.pdf';
  $scope.scroll = 0;
  $scope.loading = 'loading';
  $scope.lib={};

$scope.Fechai = new Date();
$scope.FechaF = new Date();



$scope.Generar= function(){
    window.open(base_url+'Pdfs/generar?id='+$scope.lib['CodSucu']);
  }





  $scope.getNavStyle = function(scroll) {
    if(scroll > 100) return 'pdf-controls fixed';
    else return 'pdf-controls';
  }

  $scope.onError = function(error) {
    console.log(error);
  }

  $scope.onLoad = function() {
    $scope.loading = '';
  }

  $scope.onProgress = function(progress) {
    console.log(progress);
  }

$scope.cargarSucursal=function(){
    return $http.get('Sys/Sucursales/ver_sel').
    success(function(data, status, headers, config) {       
      $scope.sucursal_t=data;
      
       console.log($scope.sucursal_t);
    }).
    error(function(data, status, headers, config) {
      console.log(status);
      hacerToast('error','Ocurrio un Error al Cargar los Tipos de Jugadas');
    });
  }
		}