var app = angular.module('facturacionApp.pacExaCtrl', ['ngStorage']);

// controlador clientes
app.controller('pacExaCtrl', ['$scope','$routeParams','$window','pacientesExamenServices','$sessionStorage', function($scope,$routeParams,$$window, pacientesExamenServices,$sessionStorage){
	

	 $scope.paciente = $sessionStorage.data;
     $scope.examen = {};
     $scope.btnInsertarExa = true;
     $scope.verExamenes = true;
     $scope.informe = {} 
     $scope.informe.nombre = "Informe";

     $scope.alterSexo = function(){
        if($scope.paciente.sexo == "M"){
            $scope.paciente.sexo = "Masculino";
        }else if($scope.paciente.sexo == "F"){
            $scope.paciente.sexo = "Femenino";
        }
     }
     $scope.alterSexo();

     $scope.listarMedicos = function(){
        pacientesExamenServices.listarMedicos().then(function(){
		    $scope.medicos = pacientesExamenServices.response;
            // console.log($scope.medicos);
		});

     }
    //    escucha el select del medico       
    $scope.$watch("medico", function(newValue, oldValue) {
        if (newValue === oldValue) {
            return;
        }
        if(newValue){
            console.log(newValue);
            $scope.btnInsertarExa = false;
        }
    });



    
     $scope.insertarExamen = function(){
        $scope.examen.id_medico = $scope.medico;

        $scope.examen.id_paciente = $scope.paciente.id ;
        // console.log($scope.examen)
        pacientesExamenServices.insertarExamen($scope.examen).then(function(){
		    $scope.responseInsertExa = pacientesExamenServices.response;
            console.log($scope.responseInsertExa);
            if($scope.responseInsertExa.message != 0){
                $scope.verExamenes = true;
                $sessionStorage.idExamen = $scope.responseInsertExa.message; 
            }
		});
     }

    //modal insetar informe 
    $scope.modalInsertarInfo = function(nombreInforme){

        console.log(nombreInforme);

        $("#modal-insertar-informe").modal();
        $scope.informe.nombre = nombreInforme;
        $scope.informe.id_examen =  $sessionStorage.idExamen;
    }
    
    $scope.insertarTipo = function (datos){
        pacientesExamenServices.insertarTipo(datos).then(function(){
		    $scope.insertTipo = pacientesExamenServices.response;
                console.log($scope.insertTipo);
		});
       
    }

    $scope.insertarInforme = function (informe){

        pacientesExamenServices.insertarInforme(informe).then(function(){
		    $scope.insertInfo = pacientesExamenServices.response;
            if($scope.insertInfo.message != "0"){
                $("#modal-insertar-informe").modal("hide");
                 console.log($scope.insertInfo.message);
                //  console.log(informe);
                $scope.tipo = {};
                 $scope.tipo.id_tipo = $scope.insertInfo.message;
                 $scope.tipo.tipo = informe.nombre;
                 $scope.tipo.id_examen = informe.id_examen;
                 console.log($scope.tipo);
                 $scope.insertarTipo($scope.tipo);
            } 
		});
       
    }

     $scope.listarMedicos();
}])


