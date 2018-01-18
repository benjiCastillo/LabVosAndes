var app = angular.module('facturacionApp.examenCtrl', []);

// controlador clientes
app.controller('examenCtrl', ['$scope', '$routeParams', '$window', 'examenServices', '$sessionStorage', function ($scope, $routeParams, $window, examenServices, $sessionStorage) {

    $scope.examen = "Examen";
    $scope.examenes = [];



    // $scope.cargandoExamenes = true;
    // $scope.examenesCargado = false;
    // $scope.noExistenExamenes = false;
    $scope.paciente = $sessionStorage.data;
    $scope.idExamen = $routeParams.id;
    console.log($scope.idExamen);
    $scope.nombreMed = $routeParams.name;
    $scope.apellidoMed = $routeParams.ape;
    $scope.fechaExa = $routeParams.fecha;

    $scope.formatDate = function (fecha) {
        var date = new Date(fecha);
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: 'true' };
        return date.toLocaleDateString('es-ES', options);
    }
    // $scope.listar = function () {
    //     examenServices.listar().then(function () {
    //         $scope.cargandoExamenes = false;
    //         $scope.examenes = examenServices.response;
    //         if ($scope.examenes.message[0].respuesta) {
    //             console.log('respuesta');
    //             $scope.examenes = [];
    //             $scope.examenesCargado = false;
    //             $scope.noExistenExamenes = true;
    //         } else {
    //             $scope.examenesCargado = true;
    //             $scope.examenes = $scope.examenes.message;
    //             $scope.noExistenExamenes = false;
    //         }
    //         console.log($scope.examenes);
    //     });

    // }
    /*  MODALES */
    //modal insertar Examen General
    $scope.modalInsertarExamenGeneral = function (examenGeneral) {
        $("#modal-insertar-general").modal();
        $scope.examenGeneral.nombre = examenGeneral;
        $scope.examenGeneral.id_examen = $scope.idExamen;
    }
    //modal insertar informe 
    $scope.modalInsertarInfo = function (nombreInforme) {
        console.log(nombreInforme);
        $("#modal-insertar-informe").modal();
        $scope.informe.nombre = nombreInforme;
        $scope.informe.id_examen = $scope.idExamen;
    }
    //modal insentar biometria 
    $scope.modalInsertarBio = function (nombre) {
        console.log(nombre);
        $("#modal-insertar-biometria").modal();
        $scope.biometria.id_examen = $scope.idExamen;
    }
    //modal reaccion de widal
    $scope.modalInsertarReaccion = function (nombre) {
        console.log(nombre);
        $("#modal-insertar-reaccion").modal();
        $scope.reaccion.id_examen = $scope.idExamen;
    }
    /*INSERTAR PRUEBAS*/
    //insertar informe
    //model
    $scope.informe = {
        nombre: 'informe',
        informe: ''
    };
    $scope.testInfoError = false;
    $scope.testInfoSuccess = false;
    $scope.insertarInforme = function (informe) {
        $scope.testInfoError = false;
        $scope.testInfoSuccess = false;
        examenServices.insertarInforme(informe).then(function () {

            $scope.insertInfo = examenServices.response;

            console.log($scope.insertInfo);
            if ($scope.insertInfo.error == 0) {
                $scope.testInfoSuccess = true;
                $("#modal-insertar-informe").modal("hide");
                console.log("correcto")
            } else {
                $scope.testInfoError = true;
                console.log("error al insertar")
            }
        });
    }


    //insetar biometria 
    /*model */
    $scope.biometria = {
        hematies: '',
        hematocrito: '',
        hemoglobina: '',
        leucocito: '',
        vsg: '',
        vcm: '',
        hbcm: '',
        chbcm: '',
        comentario1: '',
        cayados: '',
        neutrofilos: '',
        basofilo: '',
        eosinofilo: '',
        linfocito: '',
        monocito: '',
        prolinfocito: '',
        celinmaduras: '',
        comentario2: '',
        nombre: 'Biometria'
    };
    $scope.testBioError = false;
    $scope.testBioSuccess = false;
    //function insert Biometria
    $scope.insertarBiometria = function (biometria) {
        $scope.testBioError = false;
        $scope.testBioSuccess = false;
        examenServices.insertarBiometria(biometria).then(function () {
            $scope.insertInfo = examenServices.response;
            console.log($scope.insertInfo);
            if ($scope.insertInfo.error == 0) {
                $scope.testBioSuccess = true;
                setTimeout(function () {
                    $("#modal-insertar-biometria").modal("hide");
                }, 2000);
            } else {
                $scope.testBioError = true;
                setTimeout(function () {
                    $("#modal-insertar-biometria").modal("hide");
                }, 2000);
            }
        });
    }
    //insertar examen general 
    /*model */
    $scope.examenGeneral = {
        color: '',
        cantidad: '',
        olor: '',
        aspecto: '',
        espuma: '',
        sedimento: '',
        densidad: '',
        reaccion: '',
        proteinas: '',
        glucosa: '',
        cetona: '',
        bilirrubina: '',
        sangre: '',
        nitritos: '',
        urubilinogeno: '',
        eritocito: '',
        piocitos: '',
        leucocitos: '',
        cilindros: '',
        celulas: '',
        cristales: '',
        otros1: '',
        otros2: ''

    };
    $scope.testGenError = false;
    $scope.testGenSuccess = false;
    $scope.insertarExamenGeneral = function (biometria) {
        $scope.testGenError = false;
        $scope.testGenSuccess = false;
        examenServices.insertarExamenGeneral(biometria).then(function () {
            $scope.insertExaGen = examenServices.response;
            console.log($scope.insertExaGen);
            if ($scope.insertExaGen.error == 0) {
                $scope.testGenSuccess = true;
                console.log("datos insertados correctamente")
                //  $("#modal-insertar-general").modal("hide");
            } else {
                console.log("error")
                $scope.testGenError = true;
            }
        });
    }
    //insertar reaccion
    //model
    $scope.reaccion = {
        nombre: 'Reaccion de Widal',
        pA20: '',
        pA40: '',
        pA80: '',
        pA160: '',
        pA320: '',
        pA400: '',
        pB20: '',
        pB40: '',
        pB80: '',
        pB160: '',
        pB320: '',
        pB400: '',
        s20: '',
        s40: '',
        s80: '',
        s160: '',
        s320: '',
        s400: '',
        f20: '',
        f40: '',
        f80: '',
        f160: '',
        f320: '',
        f400: '',
        comentario: ''
    };
    $scope.testReacError = false;
    $scope.testReacSuccess = false;

    $scope.insertarReaccion = function (reaccion) {
        $scope.testReacError = false;
        $scope.testReacSuccess = false;
        console.log(reaccion)
        examenServices.insertarReaccion(reaccion).then(function () {
            $scope.reaccionR = examenServices.response;
            console.log($scope.reaccionR);
            if ($scope.reaccionR.error == 0) {
                //  $("#modal-insertar-reaccion").modal("hide");
                $scope.testReacSuccess = true;
            } else {
                $scope.testReacError = true;
            }
        });
    }

    $scope.showPrint = function (idPaciente, idExamen, tipo) {
        // console.log(tipo)
        switch (tipo) {
            case 'Biometria Hematica':
                console.log('este Biometria Hematica');
                window.open('http://localhost/LabVosAndes/reportes/biometria.php?idPaciente=' + idPaciente + '&idExamen=' + idExamen);
                break;
            case 'Informe General':
                console.log('este	Informe General');
                window.open('http://localhost/LabVosAndes/reportes/analisis_general_orina.php?idPaciente=' + idPaciente + '&idExamen=' + idExamen);
                break;
            case 'Informe de Quimica Sanguinea':
                console.log('este i qumi sanguinea');
                window.open('http://localhost/LabVosAndes/reportes/analisis_general.php?idPaciente=' + idPaciente + '&idExamen=' + idExamen);
                break;
            case 'informe de Microbiologia':
                console.log('este informe de Microbiologia');
                window.open('http://localhost/LabVosAndes/reportes/analisis_general.php?idPaciente=' + idPaciente + '&idExamen=' + idExamen);
                break;
            case 'Informe de Parasitologia':
                console.log('este Informe de Parasitologia');
                window.open('http://localhost/LabVosAndes/reportes/analisis_general.php?idPaciente=' + idPaciente + '&idExamen=' + idExamen);
                break;
            case 'Analisis General':
                console.log('Analisis General');
                window.open('http://localhost/LabVosAndes/reportes/examen_general.php?idPaciente=' + idPaciente + '&idExamen=' + idExamen);
                break;
            case 'Reaccion de Widal':
                console.log('Reaccion de Widal');
                window.open('http://localhost/LabVosAndes/reportes/reaccion_w.php?idPaciente=' + idPaciente + '&idExamen=' + idExamen);
                break;

            default:
                break;
        }
        console.log(idPaciente + ' ' + idExamen)
        // window.location.href = 'http://localhost/LabVosAndes/reportes/examen_general.php?idPaciente='+idPaciente+'&idExamen='+idExamen;
    }

    // $scope.listar();


}])


