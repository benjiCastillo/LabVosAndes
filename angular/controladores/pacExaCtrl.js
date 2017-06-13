var app = angular.module('facturacionApp.pacExaCtrl', ['ngStorage']);

// controlador clientes
app.controller('pacExaCtrl', ['$scope','$routeParams','$window','pacientesServices','$sessionStorage', function($scope,$routeParams,$$window, pacientesServices,$sessionStorage){
	
	// var pag = $routeParams.pag;
	 $scope.paciente = $sessionStorage.data;;
	// $scope.paciente.visible = false;
    // $scope.paciente.respuesta = "";
	// $scope.nro = 1;
   


	// $scope.listar = function(){
        
    //         console.log($scope.paciente.visible);
    //         $scope.paciente.visible = true;
	// 		pacientesServices.listar().then(function(){
	// 			$scope.response = pacientesServices.response;
	// 			console.log($scope.response);
	// 			$scope.pacientes = $scope.response;
	// 		});
    // }

    // $scope.listar();
    
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

    // $scope.crearExamen = function(paciente){
    //     console.log(paciente);
    //     $sessionStorage.data = paciente;
    //     // $window.location.href = '#/admin';
    // }

}])


