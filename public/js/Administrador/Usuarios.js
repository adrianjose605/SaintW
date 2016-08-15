angular.module('saint')

.controller('GUsuarios', ['$scope','$http','$mdToast', us])



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


//////////////////////////////////GRUPOS DE USUARIOS////////////////////////////////////////////////
// obtener info de un grupo para los swich
	$scope.getGrupos= function(id){
		console.log('/User/GUsuarios/verG/'+id);
		$http.get('User/GUsuarios/verG/'+id).
			success(function(data, status, headers, config) {				
					data.Permisos=data.Permisos=='1';
					data.Lib_Sucu=data.Lib_Sucu=='1';
					data.Lib_Consol=data.Lib_Consol=='1';
					data.Facturacion=data.Facturacion=='1';
					data.Estatus=data.Estatus=='1';
					data.Usuarios=data.Usuarios=='1';
					data.Empresas=data.Empresas=='1';
					data.Sucursales=data.Sucursales=='1';
			data.Mensajes=data.Mensajes=='1';
			data.Contactos=data.Contactos=='1';
					$scope.permiso=data;					
					//console.log($scope.alerta_nueva);
					var $j = jQuery.noConflict();
	                $j("#modificar_grupo").modal("show");				
			}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});
	}

$scope.getResourceG = function (params, paramsObj) {	
		if(!paramsObj){
			console.log('Cambio  de Asignacion');
			paramsObj=$scope.paginador;
			console.log(paramsObj);
		}

		
		$scope.paginador=paramsObj;
		console.log('Antes de la Carga Inicial');
		

		var urlApi = 'User/GUsuarios/tabla_principal_grupos/'+paramsObj.count+'/'+paramsObj.page+'/';
	
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


	$scope.registrar_grupo=function(tipo){	
		var url='',obj={};
			if(tipo){
			url='User/GUsuarios/nuevo_grupo';
			obj=$scope.permiso2;
		}else{
			
			url='User/GUsuarios/modificar_grupo';
			obj=$scope.permiso;
			}
			
			
			
			console.log(obj);
			
		$scope.submitted = true;
			$http.post(url, obj).
			success(function(data, status, headers, config) {
				if(data.status){
					hacerToast('success',data.mensaje,$mdToast);
					$scope.recargar();
				}
				else
					hacerToast('error',data.mensaje,$mdToast);   
			}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});
		

	};

///////////////////////USUARIOS///////////////////////////////////////////////////////
// obtener info de un usuario para los swich
$scope.getUsuarios= function(id){
	$scope.cargarGrupos();		
	$scope.cargarEmpresas();
	  console.log('User/LUsuarios/verU/'+id);
		$http.get('User/LUsuarios/verU/'+id).
			success(function(data, status, headers, config) {				
					data.Estatus=data.Estatus=='1';
					
					//console.log(data);
					$scope.usuarioN=data;	
					console.log(data);				
					//console.log($scope.alerta_nueva);
					var $j = jQuery.noConflict();
	                $j("#modificar_usuario").modal("show");				
			}).
			error(function(data, status, headers, config) {
				console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});
	}

		$scope.recargar=function(){
			$scope.paginador.valor=!$scope.paginador.valor;
		}


	

	$scope.getResourceU = function (params, paramsObj) {	
		if(!paramsObj){
			console.log('Cambio  de Asignacion');
			paramsObj=$scope.paginador;
			console.log(paramsObj);
		}

		
		$scope.paginador=paramsObj;
		console.log('Antes de la Carga Inicial');
		

		var urlApi = 'User/LUsuarios/tabla_principal_usuarios/'+paramsObj.count+'/'+paramsObj.page+'/';
	
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




	$scope.registrar_usuario=function(tipo){
		
		var url='',obj={};
			if(tipo){
			url='User/LUsuarios/nuevo_usuario';
			obj=$scope.user2;
			//console.log(obj);
		}else{
			
			url='User/LUsuarios/modificar_usuarios';
			
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
				//console.log(status);
				hacerToast('error','Error '+status,$mdToast);
			});
		

	};



	$scope.registrar_alerta=function(){	
		var url='',obj={},obj2={};

			url='User/GUsuarios/modificar_usuarios';

			obj=$scope.alerta_nueva;
			obj2=$scope.alerta_nueva;
			if(obj2["estatus"]){
				obj2["estatus"]=1;
			}
			
			
			
		$scope.submitted = true;
		
			$http.post(url, obj).
			success(function(data, status, headers, config) {
				if(data.status){
					hacerToast('success',data.mensaje,$mdToast);
					$scope.recargar();
				}
				else
					hacerToast('error',data.mensaje,$mdToast);   
			}).
			error(function(data, status, headers, config) {
				console.log(status);
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
$scope.cargarEmpresas=function(){
		return $http.get('Sys/Empresas/ver_sel').
		success(function(data, status, headers, config) {				
			$scope.empresa_t=data;
			
			 console.log($scope.empresa_t);
		}).
		error(function(data, status, headers, config) {
			console.log(status);
			hacerToast('error','Ocurrio un Error al Cargar los Tipos de Jugadas');
		});
	}
}
 