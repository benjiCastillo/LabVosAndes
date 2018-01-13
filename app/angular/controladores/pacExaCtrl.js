var app = angular.module('facturacionApp.pacExaCtrl', ['ngStorage']);

// controlador clientes
app.controller('pacExaCtrl', ['$scope','$routeParams','$window','pacientesExamenServices','$sessionStorage', function($scope,$routeParams,$$window, pacientesExamenServices,$sessionStorage){
	

	 $scope.paciente = $sessionStorage.data;
     $scope.examen = {};
     $scope.btnInsertarExa = true;
     $scope.verExamenes = false;
     
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
            console.log($scope.medicos)
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
   //insetar biometria 
    $scope.insertarBiometria = function (biometria){
        console.log(biometria);
        pacientesExamenServices.insertarBiometria(biometria).then(function(){
		    $scope.insertInfo = pacientesExamenServices.response;
            if($scope.insertInfo.message != "0"){
                $("#modal-insertar-biometria").modal("hide");
                 console.log($scope.insertInfo.message);
                //  console.log(informe);
                $scope.tipo = {};
                 $scope.tipo.id_tipo = $scope.insertInfo.message;
                 $scope.tipo.tipo = 'Biometria Hematica';
                 $scope.tipo.id_examen = $scope.biometria.id_examen;
                 console.log($scope.tipo);
                 $scope.insertarTipo($scope.tipo);
                $scope.listarExaPac($scope.paciente.id);
            } 
		});
    }
    //insertar examen general 
    $scope.insertarExamenGeneral = function (biometria){
        pacientesExamenServices.insertarExamenGeneral(biometria).then(function(){
		    $scope.insertExaGen = pacientesExamenServices.response;
            if($scope.insertExaGen.message != "0"){
                $("#modal-insertar-general").modal("hide");
                 console.log($scope.insertExaGen);
                // console.log(informe);
                $scope.tipo = {};
                 $scope.tipo.id_tipo = $scope.insertExaGen.message;
                 $scope.tipo.tipo = biometria.nombre;
                 $scope.tipo.id_examen = biometria.id_examen;
                 console.log($scope.tipo);
                 $scope.insertarTipo($scope.tipo);
                $scope.listarExaPac($scope.paciente.id);
            } 
		});
    }
    //insertar reaccion
    $scope.insertarReaccion = function (reaccion){
        console.log(reaccion)
        pacientesExamenServices.insertarReaccion(reaccion).then(function(){
		    $scope.reaccionR = pacientesExamenServices.response;
            if($scope.reaccionR.message != "0"){
                $("#modal-insertar-reaccion").modal("hide");
                 console.log($scope.reaccionR);
                // console.log(informe);
                $scope.tipo = {};
                 $scope.tipo.id_tipo = $scope.reaccionR.message;
                 $scope.tipo.tipo = $scope.reaccion.nombre;
                 $scope.tipo.id_examen = reaccion.id_examen;
                 console.log($scope.tipo);
                 $scope.insertarTipo($scope.tipo);
                $scope.listarExaPac($scope.paciente.id);
            } 
		});
    }

//listar examen paciente
    $scope.listarExaPac = function(id){
        pacientesExamenServices.listarExamenes(id).then(function(){

            
        })
    }

    $scope.listarExaPac($scope.paciente.id);
    $scope.listarMedicos();

    $scope.showPrint = function(idPaciente, idExamen, tipo){
        // console.log(tipo)
        switch (tipo) {
            case 'Biometria Hematica':
                console.log('este Biometria Hematica');
               window.open ('http://localhost/LabVosAndes/reportes/biometria.php?idPaciente='+idPaciente+'&idExamen='+idExamen);
                break;
            case 'Informe General':
                console.log('este	Informe General');
               window.open('http://localhost/LabVosAndes/reportes/analisis_general_orina.php?idPaciente='+idPaciente+'&idExamen='+idExamen);
                break;
            case 'Informe de Quimica Sanguinea':
                console.log('este i qumi sanguinea');
                window.open('http://localhost/LabVosAndes/reportes/analisis_general.php?idPaciente='+idPaciente+'&idExamen='+idExamen);
                break;
            case 'informe de Microbiologia':
                console.log('este informe de Microbiologia');
               window.open('http://localhost/LabVosAndes/reportes/analisis_general.php?idPaciente='+idPaciente+'&idExamen='+idExamen);
                break;
            case 'Informe de Parasitologia':
                console.log('este Informe de Parasitologia');
                window.open('http://localhost/LabVosAndes/reportes/analisis_general.php?idPaciente='+idPaciente+'&idExamen='+idExamen);
                break; 
             case 'Analisis General':
                console.log('Analisis General');
               window.open('http://localhost/LabVosAndes/reportes/examen_general.php?idPaciente='+idPaciente+'&idExamen='+idExamen);
                break;
             case 'Reaccion de Widal':
                console.log('Reaccion de Widal');
                window.open('http://localhost/LabVosAndes/reportes/reaccion_w.php?idPaciente='+idPaciente+'&idExamen='+idExamen);
                break;                          
        
            default:
                break;
        }
        console.log(idPaciente+' '+idExamen)
        // window.location.href = 'http://localhost/LabVosAndes/reportes/examen_general.php?idPaciente='+idPaciente+'&idExamen='+idExamen;
    }

    /* EDITAR */

        $scope.edtInforme = {};
        $scope.edtReaccion = {};
        $scope.edtBiometria = {};
        $scope.edtGeneral = {};


        $scope.showEdit = function(idPaciente, idExamen, tipo){
        // console.log(tipo)
        switch (tipo) {
            case 'Biometria Hematica':
                console.log('este Biometria Hematica');
                 $scope.listarBio(idExamen)
                    break;
            case 'Informe General':
                $scope.listarInforme(idExamen,tipo);
                console.log('este	Informe General');
                
                    break;
            case 'Informe de Quimica Sanguinea':
                $scope.listarInforme(idExamen,tipo);
                console.log('este i qumi sanguinea');
               
               
                break;
            case 'informe de Microbiologia':
                $scope.listarInforme(idExamen,tipo);
                console.log('este informe de Microbiologia');
               
              
                    break;
            case 'Informe de Parasitologia':
                $scope.listarInforme(idExamen,tipo);
                console.log('este Informe de Parasitologia');
              
               
                    break; 
             case 'Analisis General':
                console.log('Analisis General');
                 $scope.listarGen(idExamen); 
                    break;
             case 'Reaccion de Widal':
                console.log('Reaccion de Widal');
                 $scope.listarRea(idExamen);
                     break;                          
        
            default:
                break;
        }

        // window.location.href = 'http://localhost/LabVosAndes/reportes/examen_general.php?idPaciente='+idPaciente+'&idExamen='+idExamen;
    }

    //Obtener informes
    $scope.listarInforme = function(id, titulo){
      
            pacientesExamenServices.listarInforme(id).then(function(){
            $scope.getInforme = pacientesExamenServices.response;
            console.log($scope.getInforme);
            $scope.getInforme.titulo= titulo;
                $("#editar-informe").modal();
        })
    }
    $scope.editarInforme = function(data){
            pacientesExamenServices.editarInforme(data).then(function(){
            $scope.informeEditado = pacientesExamenServices.response;
            $("#editar-informe").modal("hide");
        })
    }

    //obtener biometria

    $scope.listarBio = function(id){
            pacientesExamenServices.listarBio(id).then(function(){
            $scope.edtBiometria = pacientesExamenServices.response;
            console.log($scope.edtBiometria);
                $("#editar-biometria").modal();
        })
    }
      $scope.editarBio = function(data){
            pacientesExamenServices.editarBio(data).then(function(){
            $scope.informeEditado = pacientesExamenServices.response;
            $("#editar-biometria").modal("hide");
        })
    }
     //obtener general

    $scope.listarGen = function(id){
            pacientesExamenServices.listarGen(id).then(function(){
            $scope.edtGeneral = pacientesExamenServices.response;
            console.log($scope.edtGeneral);
                $("#editar-general").modal();
        })
    }
      $scope.editarGeneral = function(data){
            pacientesExamenServices.editarGeneral(data).then(function(){
            $scope.generalEditado = pacientesExamenServices.response;
            $("#editar-general").modal("hide");
        })
    }

    //obtener reaccion

    $scope.listarRea = function(id){
            pacientesExamenServices.listarRea(id).then(function(){
            $scope.edtReaccion = pacientesExamenServices.response;
            console.log($scope.edtReaccion);
                $("#editar-reaccion").modal();
        })
    }
      $scope.editarReaccion = function(data){
            pacientesExamenServices.editarReaccion(data).then(function(){
            $scope.reaccionEditado = pacientesExamenServices.response;
            console.log($scope.reaccionEditado)
            $("#editar-reaccion").modal("hide");
        })
    }

    /** Eliminar */

    $scope.showDelete = function(idPaciente, idExamen, tipo){
        // console.log(tipo)
        switch (tipo) {
            case 'Biometria Hematica':
                console.log('este Biometria Hematica');
                $scope.eliminarBiometria(idExamen);
                    break;
            case 'Informe General':
                $scope.eliminarInforme(idExamen,tipo);
                console.log('este	Informe General');
                
                    break;
            case 'Informe de Quimica Sanguinea':
                $scope.eliminarInforme(idExamen,tipo);
                console.log('este i qumi sanguinea');
               
               
                break;
            case 'informe de Microbiologia':
                $scope.eliminarInforme(idExamen,tipo);
                console.log('este informe de Microbiologia');
               
              
                    break;
            case 'Informe de Parasitologia':
                $scope.eliminarInforme(idExamen,tipo);
                console.log('este Informe de Parasitologia');
              
               
                    break; 
             case 'Analisis General':
                console.log('Analisis General');
               $scope.eliminarGeneral(idExamen);
                    break;
             case 'Reaccion de Widal':
                console.log('Reaccion de Widal');
                $scope.eliminarReaccion(idExamen);
                     break;                          
        
            default:
                break;
        }
        
        // window.location.href = 'http://localhost/LabVosAndes/reportes/examen_general.php?idPaciente='+idPaciente+'&idExamen='+idExamen;
    }

    $scope.elmInforme = {};
    //Eliminar informes
    $scope.eliminarInforme = function(id, titulo){
            $scope.elmInforme.titulo= titulo;
            $scope.elmInforme.id= id;
                $("#eliminar-informe").modal();
    }
    $scope.deleteInforme = function(data){
            pacientesExamenServices.eliminarInforme(data).then(function(){
            $scope.informeEliminado = pacientesExamenServices.response;
            console.log('datos '+$scope.informeEliminado)
            $("#eliminar-informe").modal("hide");
             $scope.listarExaPac($scope.paciente.id);
        })
    }
    //eliminar Biometria
    $scope.elmBiometria = {};
    $scope.eliminarBiometria = function(id){
            $scope.elmBiometria.id= id;
                $("#eliminar-biometria").modal();
    }

    $scope.deleteBiometria = function(data){
        pacientesExamenServices.eliminarBiometria(data).then(function(){
            $scope.biometriaEliminado = pacientesExamenServices.response;
            console.log($scope.biometriaEliminado)
            $("#eliminar-biometria").modal("hide");
             $scope.listarExaPac($scope.paciente.id);
        })
    }

    //eliminar general
    $scope.elmGeneral = {};
    $scope.eliminarGeneral = function(id){
            $scope.elmGeneral.id= id;
                $("#eliminar-general").modal();
    }

    $scope.deleteGeneral = function(data){
        pacientesExamenServices.eliminarGeneral(data).then(function(){
            $scope.generalEliminado = pacientesExamenServices.response;
            console.log($scope.generalEliminado)
            $("#eliminar-general").modal("hide");
             $scope.listarExaPac($scope.paciente.id);
        })
    }
    //eliminar reaccion
    $scope.elmReaccion = {};
    $scope.eliminarReaccion = function(id){
            $scope.elmReaccion.id= id;
                $("#eliminar-reaccion").modal();
    }

    $scope.deleteReaccion = function(data){
        pacientesExamenServices.eliminarReaccion(data).then(function(){
            $scope.reaccionEliminado = pacientesExamenServices.response;
            console.log($scope.reaccionEliminado)
            $("#eliminar-reaccion").modal("hide");
             $scope.listarExaPac($scope.paciente.id);
        })
    }


}])

