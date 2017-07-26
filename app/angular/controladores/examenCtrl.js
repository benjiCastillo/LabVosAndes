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
    

}])


