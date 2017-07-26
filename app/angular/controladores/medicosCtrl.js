var app = angular.module('facturacionApp.medicosCtrl', []);

// controlador clientes
app.controller('medicosCtrl', ['$scope','$routeParams','medicosServices', function($scope,$routeParams, medicosServices){
	
	var pag = $routeParams.pag
	$scope.medicos = "";
    $scope.medicos.respuesta = "";
	$scope.nro = 1;
   
	$scope.listar = function(){
			medicosServices.listar().then(function(){
				$scope.medicos = medicosServices.response;
                console.log($scope.medicos)
			});
    }

    $scope.listar();
    
	$scope.insertarModal = function(){
			$("#modal-medico").modal();
    }
	
	$scope.insertar = function(medico){
		console.log(medico);
		 medicosServices.insertar(medico).then(function(){
		    $scope.response = medicosServices.response;
            console.log($scope.response);
            $("#modal-medico").modal("hide");
             $scope.listar();
		});

	}
    
    $scope.mostrarEditar = function(medico){
        // console.log(medico);
        $scope.medico = medico
        $("#modal-editar-medico").modal();
    }

    $scope.modificar = function(medicoMod){
		console.log(medicoMod)
        medicosServices.modificar(medicoMod).then(function(){
		    $scope.response = medicosServices.response;
            console.log($scope.response);
            $("#modal-editar-medico").modal("hide");
             $scope.listar();
		});        
    }

	$scope.mostrarEliminar = function(medico){
        // console.log(medico);
        $scope.medico = medico;
		console.log(medico)
        $("#modal-medico-eliminar").modal();
    }

	$scope.eliminar = function(medico){
		console.log(medico)
        medicosServices.eliminar(medico).then(function(){
		    $scope.response = medicosServices.response;
            console.log($scope.response);
            $("#modal-medico-eliminar").modal("hide");
             $scope.listar();
		});        
    }


}])