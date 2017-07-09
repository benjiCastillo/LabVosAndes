var app = angular.module('facturacionApp.examenCtrl', []);

// controlador clientes
app.controller('examenCtrl', ['$scope','$routeParams','examenServices', function($scope,$routeParams,examenServices){
	
	// var pag = $routeParams.pag;
	 $scope.examen = "Examen";
	// $scope.paciente.visible = false;
    // $scope.paciente.respuesta = "";
	// $scope.nro = 1;
   


	$scope.listar = function(){
        
			examenServices.listar().then(function(){
				$scope.response = examenServices.response;
				
				$scope.examenes = $scope.response.message;
                console.log($scope.examenes);
			});
    }

    $scope.listar();
    
	// $scope.insertarModal = function(){
	// 		$("#modal-paciente").modal();
    // }
	// $scope.insertar= function(paciente){
	// 	console.log(paciente);
	// 	 pacientesServices.insertar(paciente).then(function(){
	// 	    $scope.response = pacientesServices.response;
    //         console.log($scope.response);
    //         $("#modal-paciente").modal("hide");
    //          $scope.listar();
	// 	});
	// }
    
    // $scope.mostrarEditar = function(paciente){
    //     // console.log(paciente);
    //     $scope.pacienteMod = paciente;
	// 	console.log(paciente)
    //     $("#modal-editar-paciente").modal();
    // }

    // $scope.modificar = function(pacienteMod){
	// 	console.log()
    //     pacientesServices.modificar(pacienteMod).then(function(){
	// 	    $scope.response = pacientesServices.response;
    //         console.log($scope.response);
    //         $("#modal-editar-paciente").modal("hide");
    //          $scope.listar();
	// 	});        
    // }

	// $scope.mostrarEliminar = function(paciente){
    //     // console.log(paciente);
    //     $scope.pacienteElim = paciente;
	// 	console.log(paciente)
    //     $("#modal-paciente-eliminar").modal();
    // }

	// $scope.eliminar = function(paciente){
	// 	console.log(paciente)
    //     pacientesServices.eliminar(paciente).then(function(){
	// 	    $scope.response = pacientesServices.response;
    //         console.log($scope.response);
    //         $("#modal-paciente-eliminar").modal("hide");
    //          $scope.listar();
	// 	});        
    // }

}])


