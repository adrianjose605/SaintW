angular.module('saint')

.controller('Contactos', ['$scope','$http','$mdToast', us])



	function us($scope,$http,$mdToast){
	$scope.user={};
	$scope.permiso={};$scope.permiso2={};
	$scope.user={};$scope.user2={}; $scope.Pass={clave:''}; $scope.per={descripcion:''};
	
	$scope.busqueda={estatus:true,query:''};
	$scope.paginador={valor:true};
	$scope.grupo_t=[];
	$scope.contador=0;
	$scope.submitted = false;

	$scope.resetForm = function(){
		$scope.user=angular.copy({});
		$scope.user2=angular.copy({});
		$scope.usuarioN=angular.copy({});
		$scope.Pass=angular.copy({});
		$scope.permiso=angular.copy({});
		$scope.permiso2=angular.copy({});
		$scope.submitted=false;
	}

			$scope.cargarP=function(){
			$http.get('User/GUsuarios/verG/'+id).
				success(function(data, status, headers, config) {				
					
					$scope.per=data;	

					}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});				
					
	}





///////////////////////Clientes///////////////////////////////////////////////////////
// obtener info de un usuario para los swich
$scope.getCliente= function(id){
	
	 
		$http.get('Admin/Clientes/ver/'+id).
			success(function(data, status, headers, config) {				
					data.Activo=data.Activo=='1';
					
					//console.log(data);
					$scope.usuarioN=data;	
					console.log(data);				
					//console.log($scope.alerta_nueva);
					var $j = jQuery.noConflict();
	                $j("#modificar_cliente").modal("show");				
			}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});
	}

		$scope.recargar=function(){
			$scope.paginador.valor=!$scope.paginador.valor;
		}


	

	$scope.getResourceC = function (params, paramsObj) {	
		if(!paramsObj){
			console.log('Cambio  de Asignacion');
			paramsObj=$scope.paginador;
			console.log(paramsObj);
		}

		
		$scope.paginador=paramsObj;
		console.log('Antes de la Carga Inicial');
		

		var urlApi = 'Admin/Clientes/tabla_principal_clientes/'+paramsObj.count+'/'+paramsObj.page+'/';
	
		if(paramsObj.sortBy){
			urlApi+=paramsObj.sortBy+'/'+paramsObj.sortOrder;    
		}

		return $http.post(urlApi,$scope.busqueda).then(function (response) {
			
			
			$scope.contador=response.data.pagination.size;
			
			return {
				'rows': response.data.rows,
				'header': response.data.header,
				'pagination': response.data.pagination,
				'sortBy': response.data['sort-by'],
				'sortOrder': response.data['sort-order']
			}
		});
	};




	$scope.registrar_cliente=function(tipo){
		
		var url='',obj={};
			if(tipo){
			url='Admin/Clientes/nuevo_clt';
			obj=$scope.user2;
			//console.log(obj);
		}else{
			
			url='Admin/Clientes/modificar_clt';
			
				obj=$scope.usuarioN;
				//console.log(obj);
			}

	
			
		$scope.submitted = true;
			$http.post(url, obj).
			success(function(data, status, headers, config) {
				if(data.estatus){
					hacerToast('success',data.mensaje,$mdToast);
					$scope.recargar();
				}else{
					hacerToast('error',data.mensaje,$mdToast);  
					console.log(status+data.status);
				} 
			}).
			error(function(data, status, headers, config) {
				
				hacerToast('error','Error '+status,$mdToast);
			});
		

	};




$scope.cargarGrupos=function(){
		return $http.get('User/LUsuarios/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.grupo_t=data;
			
			 console.log($scope.grupo_t);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Tipos de Jugadas');
		});
	}	

}
 