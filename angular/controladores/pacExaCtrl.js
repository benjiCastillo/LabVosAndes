var app = angular.module('facturacionApp.pacExaCtrl', ['ngStorage']);

// controlador clientes
app.controller('pacExaCtrl', ['$scope','$routeParams','$window','pacientesExamenServices','$sessionStorage', function($scope,$routeParams,$$window, pacientesExamenServices,$sessionStorage){
	

	 $scope.paciente = $sessionStorage.data;
     $scope.examen = {};
     $scope.btnInsertarExa = true;
     $scope.verExamenes = true;
     
     $scope.verExamenesPaciente = false;
     $scope.cargandoDatosExamenes = false;
     $scope.noExistenExamenes = false;
     
     $scope.informe = {};
     $scope.examenGeneral = {}; 
     $scope.informe.nombre = "Informe";
     $scope.biometria = {};
     $scope.biometria.nombre = "Biometria"; 
     $scope.reaccion = {};
     $scope.reaccion.nombre = "Reaccion de Widal";

     $scope.alterSexo = function(){
        if($scope.paciente.sexo == "M"){
            $scope.paciente.sexo = "Masculino";
        }else if($scope.paciente.sexo == "F"){
            $scope.paciente.sexo = "Femenino";
        }
     }
     $scope.alterSexo();

     //listar medico
     $scope.listarMedicos = function(){
        pacientesExamenServices.listarMedicos().then(function(){
		    $scope.medicos = pacientesExamenServices.response;
		});
     }
    // escucha el select del medico       
    $scope.$watch("medico", function(newValue, oldValue) {
        if (newValue === oldValue) {
            return;
        }
        if(newValue){
            console.log(newValue);
            $scope.btnInsertarExa = false;
        }
    });
    //insertar examen
     $scope.insertarExamen = function(){
        $scope.examen.id_medico = $scope.medico;
        $scope.examen.id_paciente = $scope.paciente.id ;
        pacientesExamenServices.insertarExamen($scope.examen).then(function(){
		    $scope.responseInsertExa = pacientesExamenServices.response;
            console.log($scope.responseInsertExa);
            if($scope.responseInsertExa.message != 0){
                $scope.verExamenes = true;
                $sessionStorage.idExamen = $scope.responseInsertExa.message; 
            }
		});
     }
         /*  MODALES */
     //modal insertar Examen General
     $scope.modalInsertarExamenGeneral = function(examenGeneral){
        $("#modal-insertar-general").modal();
        $scope.examenGeneral.nombre = examenGeneral;
        $scope.examenGeneral.id_examen =  $sessionStorage.idExamen;
    }
    //modal insertar informe 
    $scope.modalInsertarInfo = function(nombreInforme){
        console.log(nombreInforme);
        $("#modal-insertar-informe").modal();
        $scope.informe.nombre = nombreInforme;
        $scope.informe.id_examen =  $sessionStorage.idExamen;
    }
        //modal insentar biometria 
    $scope.modalInsertarBio = function(nombre){
        console.log(nombre);
        $("#modal-insertar-biometria").modal();
        $scope.biometria.id_examen =  $sessionStorage.idExamen;
    }
    //modal reaccion de widal
    $scope.modalInsertarReaccion = function(nombre){
        console.log(nombre);
        $("#modal-insertar-reaccion").modal();
        $scope.reaccion.id_examen =  $sessionStorage.idExamen;
    }

    /* INSERTAR DATOS */

    // insertar Examen General
    $scope.insertarExamenGeneral = function(examenGeneral){
        pacientesExamenServices.insertarTipo(datos).then(function(){
		    $scope.insertTipo = pacientesExamenServices.response;
                console.log($scope.insertTipo);
		});

    }
    //insetar tipo
    $scope.insertarTipo = function (datos){
        pacientesExamenServices.insertarTipo(datos).then(function(){
		    $scope.insertTipo = pacientesExamenServices.response;
                console.log($scope.insertTipo);
		});
    }
//insertar informe
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
                $scope.listarExaPac($scope.paciente.id);
            } 
		});
    }
//listar examen paciente
    $scope.listarExaPac = function(id){
        $scope.cargandoDatosExamenes = true;
        pacientesExamenServices.listarExaPac(id).then(function(){
            $scope.examenPaciente = pacientesExamenServices.response.message;
            console.log($scope.examenPaciente);
            $scope.cargandoDatosExamenes = false;
            if($scope.examenPaciente[0].respuesta){
                if($scope.examenPaciente[0].respuesta == 0){
                    $scope.noExistenExamenes = true;
                    console.log($scope.examenPaciente[0].respuesta)
                }
            }else{
                $scope.verExamenesPaciente = true;
                $scope.noExistenExamenes = false;    
            }
            
        })

    }
    $scope.listarExaPac($scope.paciente.id);
     $scope.listarMedicos();



}])


