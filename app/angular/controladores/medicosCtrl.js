var app = angular.module('facturacionApp.medicosCtrl', []);

// controlador clientes
app.controller('medicosCtrl', ['$scope','$routeParams','medicosServices', function($scope,$routeParams, medicosServices){
	
	var pag = $routeParams.pag
	$scope.medicos = [];
    $scope.medicos.respuesta = "";
	$scope.nro = 1;
    $scope.noExistenMedicos = false;
    $scope.cargandoMedicos = true;
    $scope.medicosCargado = false;
	
    $scope.listar = function(){
        $scope.pacientesMedicos = true;
			medicosServices.listar().then(function(){
                
				$scope.response = medicosServices.response;
                $scope.cargandoMedicos = false;
                console.log($scope.response)
                if ($scope.response.error == 1){
                    console.log('no hay medicos');
                    $scope.noExistenMedicos = true;
                    $scope.medicosCargado = false;
                }else{
                    $scope.medicosCargado = true;
                    $scope.noExistenMedicos = false;
                    $scope.medicos = $scope.response.message;
                }
			});
    }

    $scope.listar();
    
	$scope.insertarModal = function(){
            $scope.medico = {};
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