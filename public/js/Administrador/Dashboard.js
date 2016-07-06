angular.module('saint')

.controller('Dashboard', ['$scope','$http', us])

	function us($scope,$http,$mdToast){
         $scope.graf_ventas=angular.copy({});
         $scope.graf_barra=angular.copy({});
        $scope.sucursal_t=null;
        $scope.lib=angular.copy({});

        $scope.resetForm = function(){           
            $scope.lib=angular.copy({});
        }

        $scope.cargarSucursal=function(){
        return $http.get('Sys/Sucursales/ver_sel').
            success(function(data, status, headers, config) {       
            $scope.sucursal_t=data;
      
            //console.log($scope.sucursal_t);
            }).
            error(function(data, status, headers, config) {
            console.log(status);
                hacerToast('error','Ocurrio un Error al Cargar los Tipos de Jugadas');
            });


        }

        $scope.actualizarGrafica=function(){
        console.log("Admin/Saa_libs/serie_ventas/"+$scope.lib.CodSucu);  
         $http.post("Admin/Saa_libs/serie_ventas/",$scope.lib.CodSucu).then(function(response) {
            $scope.graf_ventas = response.data;
           
            Highcharts.chart('container',
            {
                xAxis: {categories: $scope.graf_ventas[1]},
                series: [{data:  $scope.graf_ventas[0]}] , 
                title: {text: 'Total de ventas por mes'},
                tooltip: {headerFormat: '<span style="font-size:10px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} </b> Bs.<br/>'
                }
            });
             console.log( $scope.graf_ventas[1]);
            });
        }
        
        $scope.cargarSucursal();
        console.log($scope.sucursal_t);   

		$http.get("Admin/Saa_libs/totalCredito/")
			.success(function(data){
				$scope.credito = data;
			});

		$http.get("Admin/Saa_libs/totalFacturado/")
			.success(function(data){
				$scope.facturado = data;
			});
		$http.get("Admin/Saa_libs/totalFacturas/")
			.success(function(data){
				$scope.facturas = data;
			});
       
$http.get("Admin/Saa_libs/barra_ventas/").then(function(response) {
     $scope.graf_barra=response.data;
     $http.get("Admin/Saa_libs/barra_ventas_drilldown/").then(function(response2) {
        $scope.graf_barra_drilldown=response2.data;

     
  Highcharts.chart('container2', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Top de ventas'
        },
        subtitle: {
            text: 'Click en la columna de la sucursal que desee evaluar.'
        },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Total de ingresos hasta la fecha'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}Bs.'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:10px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}</b> Bs.<br/>'
        },
        series: [{
            name: 'Ingresos',
            colorByPoint: true,
            data:$scope.graf_barra
        }]
        /*series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Microsoft Internet Explorer',
                y: 56.33,
                drilldown: 'Microsoft Internet Explorer'
            }, {
                name: 'Chrome',
                y: 24.03,
                drilldown: 'Chrome'
            }, {
                name: 'Firefox',
                y: 10.38,
                drilldown: 'Firefox'
            }, {
                name: 'Safari',
                y: 4.77,
                drilldown: 'Safari'
            }, {
                name: 'Opera',
                y: 0.91,
                drilldown: 'Opera'
            }, {
                name: 'Proprietary or Undetectable',
                y: 0.2,
                drilldown: null
            }]
        }]*/

        ,
        drilldown: {
            series: $scope.graf_barra_drilldown/*[{
                name: 'ALTA VISTA',
                id: 'ALTA VISTA',
                data: [
                    ['v11.0',24.13],
                    ['v8.0',17.2],
                    ['v9.0',8.11],
                    ['v10.0',5.33],
                    ['v6.0',1.06],
                    ['v7.0',0.5]
                ]
            }, {
                name: 'Chrome',
                id: 'Chrome',
                data: [
                    ['v40.0',5],
                    ['v41.0',4.32],
                    ['v42.0',3.68],
                    ['v39.0',2.96],
                    ['v36.0',2.53],
                    ['v43.0',1.45],
                    ['v31.0',1.24],
                    ['v35.0',0.85],
                    ['v38.0',0.6],
                    ['v32.0',0.55],
                    ['v37.0',0.38],
                    ['v33.0',0.19],
                    ['v34.0',0.14],
                    ['v30.0',0.14]
                ]
            },]*/
        }
    });
 });
});


    }
            

/*  
    Highcharts.chart('container3', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Browser market shares January, 2015 to May, 2015'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Brands',
            colorByPoint: true,
            data: [{
                name: 'Microsoft Internet Explorer',
                y: 56.33
            }, {
                name: 'Chrome',
                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: 'Firefox',
                y: 10.38
            }, {
                name: 'Safari',
                y: 4.77
            }, {
                name: 'Opera',
                y: 0.91
            }, {
                name: 'Proprietary or Undetectable',
                y: 0.2
            }]
        }]
    });

    Highcharts.chart('container4', {
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Contents of Highsoft\'s weekly fruit delivery'
        },
        subtitle: {
            text: '3D donut in Highcharts'
        },
        plotOptions: {
            pie: {
                innerSize: 100,
                depth: 45
            }
        },
        series: [{
            name: 'Delivered amount',
            data: [
                ['Bananas', 8],
                ['Kiwi', 3],
                ['Mixed nuts', 1],
                ['Oranges', 6],
                ['Apples', 8],
                ['Pears', 4],
                ['Clementines', 4],
                ['Reddish (bag)', 1],
                ['Grapes (bunch)', 1]
            ]
        }]
    });

    Highcharts.chart('container5', {
        title: {
            text: 'Monthly Average Temperature',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: WorldClimate.com',
            x: -20
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'New York',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Berlin',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });		*/ 

    //}


