var app = angular.module('facturacionApp.informeCtrl', []);

// controlador clientes
app.controller('informeCtrl', ['$scope','$routeParams','informeServices', function($scope,$routeParams, informeServices){
	
	var pag = $routeParams.pag

	$scope.activar('Minforme','', 'informeServices', 'Lista')
	$scope.informe = {}
	$scope.informeSel = {}
	$scope.accion = ""
	$scope.informeEditado = {}
	$scope.fecha={}

	//variable para mandar a la vista lo recuperado de la promise
	$scope.informe = {
		'cargando':true
	}

	$scope.moverA = function(pag){

		$scope.informe = {
			'cargando' : true
		}
		
		informeServices.cargarPagina(pag).then(function(){
			$scope.informe = informeServices
			// console.log($scope.informe)
		});
	
	}

	$scope.moverA(pag);

	//Mostrar Modal de Edicion y Creacion

	$scope.mostrarModal = function( informe ){

		
		var fecha = formatDate(informe);
		console.log(fecha)
		// informe = {
		// 	'fecha_a':fecha
		// }
		informe.fecha_a = fecha
		if(informe === 1){
			$scope.accion = "Insertar"
		}else{
			$scope.accion = "Editar"
		}
		// console.log(informe)
		angular.copy(informe, $scope.informeSel)
		

		$("#modal-informe").modal();

		$scope.informeEditado.respuesta={
				'cargado':false
		}


	}



	function formatDate(informe){
		var nuevaFecha = new Date(informe.fecha_a)

		return nuevaFecha ;
	}

	//Funcion para guardar

	// $scope.guardar = function( informe,frminforme){

	// 	$scope.informeEditado = informeServices
	// 	$scope.informeEditado = {
	// 		'respuesta':{
	// 				'err':true,
	// 				'cargado':false
	// 			}
	// 		}
	// 	informeServices.guardar( informe ).then(function(){

	// 		$scope.informeEditado = informeServices
	// 		$scope.informeEditado.respuesta={
	// 			'cargado':true
	// 		}

	// 				setTimeout(function(){

	// 					$("#modal-informe").modal("hide");
	// 					$scope.informeSel = {}	
	// 					frminforme.autoValidateFormOptions.resetForm();

	// 				},1000)
	// 	})

	// }

	//eliminar

		// $scope.mostrarEliminar = function( informe ){
		// // console.log(informe)

		// 	angular.copy(informe, $scope.informeSel)

		// 	$("#modal-informe-eliminar").modal();

		// 	$scope.informeEditado.respuesta={
		// 			'cargado':false
		// 	}

		// }

		// $scope.eliminar = function( informe){
		// 	console.log(informe)

		// 	$scope.informeEditado = informeServices
		// 	$scope.informeEditado = {
		// 	'respuesta':{
		// 			'err':true,
		// 			'cargado':false
		// 		}
		// 	}
		// 	informeServices.eliminar( informe ).then(function(){

		// 	$scope.informeEditado = informeServices
		// 	$scope.informeEditado.respuesta={
		// 		'cargado':true
		// 	}

		// 			setTimeout(function(){

		// 				$("#modal-informe-eliminar").modal("hide");
		// 				$scope.informeSel = {}	
		// 				//frminforme.autoValidateFormOptions.resetForm();

		// 			},1000)
		// 	})

		// }


}])