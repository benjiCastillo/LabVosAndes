var app = angular.module('facturacionApp.examenCtrl', []);

// controlador clientes
app.controller('examenCtrl', ['$scope', '$routeParams', '$window', 'examenServices', '$sessionStorage', function ($scope, $routeParams, $window, examenServices, $sessionStorage) {

    $scope.examen = "Examen";
    $scope.examenes = [];


    //booleans para la visibilidad del listado de examen
    $scope.cargandoExamenes = true;
    $scope.examenesCargado = false;
    $scope.noExistenExamenes = false;
    //datos de paciente, medico id del examen 
    $scope.paciente = $sessionStorage.data;
    $scope.idExamen = $routeParams.id;
    $scope.nombreMed = $routeParams.name;
    $scope.apellidoMed = $routeParams.ape;
    $scope.fechaExa = $routeParams.fecha;
    //function que recibe una fecha en formato devuelto de base de datos
    //y retorna un formato largo
    $scope.formatDate = function (fecha) {
        var date = new Date(fecha);
        var options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: 'true' };
        return date.toLocaleDateString('es-ES', options);
    }
    $scope.formatName = function (name) {
        switch (name) {
            case 'examen_general':
                return 'Examen General';
                break;
            case 'biometria':
                return 'Biometria';
                break;
            case 'reaccion_w':
                return 'Reaccion de Widal';
                break;
            case 'examen_general':
                return 'Examen General';
                break;

            default:
                break;
        }
    }
    //function que lista las pruebas de los examenes
    $scope.listar = function (id) {
        examenServices.listar(id).then(function () {
            $scope.cargandoExamenes = false;
            $scope.examenes = examenServices.response;
            console.log($scope.examenes)
            if ($scope.examenes.error == 0) {
                $scope.examenes = $scope.examenes.message;
                $scope.examenesCargado = true;
                $scope.noExistenExamenes = false;
            } else {
                $scope.noExistenExamenes = true;
                $scope.examenesCargado = false;
            }

        });

    }
    $scope.listar($scope.idExamen);

    /*  MODALES */
    /*INSERTAR*/
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
    //modal insertar biometria 
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
                $scope.listar($scope.idExamen);
            } else {
                $scope.testInfoError = true;
            }
            setTimeout(function () {
                $("#modal-insertar-informe").modal("hide");
            }, 1000);
        });
    }


    /*BIOMETRIA*/
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
                $scope.listar($scope.idExamen);
            } else {
                $scope.testBioError = true;
            }
            setTimeout(function () {
                $("#modal-insertar-biometria").modal("hide");
            }, 1000);
        });
    }
    //editar Biometria
    $scope.listarBio = function (id) {
        console.log("editar bio")
        examenServices.listarBio(id).then(function () {
            $scope.edtBiometria = examenServices.response;
            $scope.edtBiometria = $scope.edtBiometria.message;
            $("#editar-biometria").modal();
        })
    }
    $scope.editarBio = function (data) {
        examenServices.editarBio(data).then(function () {
            $scope.informeEditado = examenServices.response;
            $("#editar-biometria").modal("hide");
        })
    }

    /*EXAMEN GENERAL*/
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
    //insertar examen general
    $scope.insertarExamenGeneral = function (biometria) {
        $scope.testGenError = false;
        $scope.testGenSuccess = false;
        examenServices.insertarExamenGeneral(biometria).then(function () {
            $scope.insertExaGen = examenServices.response;
            console.log($scope.insertExaGen);
            if ($scope.insertExaGen.error == 0) {
                $scope.testGenSuccess = true;
                $scope.listar($scope.idExamen);
            } else {
                $scope.testGenError = true;
            }
            setTimeout(function () {
                $("#modal-insertar-general").modal("hide");
            }, 1000);
        });
    }
    //editar general
    $scope.listarGen = function (id) {
        examenServices.listarGen(id).then(function () {
            $scope.edtGeneral = examenServices.response;
            console.log($scope.edtGeneral);
            $scope.edtGeneral = $scope.edtGeneral.message;
            $("#editar-general").modal();
        })
    }
    $scope.editarGeneral = function (data) {
        examenServices.editarGeneral(data).then(function () {
            $scope.generalEditado = examenServices.response;
            $("#editar-general").modal("hide");
        })
    }
    /*REACCION DE WIDAL*/
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
    //insertar
    $scope.insertarReaccion = function (reaccion) {
        $scope.testReacError = false;
        $scope.testReacSuccess = false;
        console.log(reaccion)
        examenServices.insertarReaccion(reaccion).then(function () {
            $scope.reaccionR = examenServices.response;
            console.log($scope.reaccionR);
            if ($scope.reaccionR.error == 0) {
                $scope.testReacSuccess = true;
                $scope.listar($scope.idExamen);
            } else {
                $scope.testReacError = true;
            }
            setTimeout(function () {
                $("#modal-insertar-reaccion").modal("hide");
            }, 1000);
        });
    }
    //editar reaccion
    $scope.listarRea = function (id) {
        examenServices.listarRea(id).then(function () {
            $scope.edtReaccion = examenServices.response;
            $scope.edtReaccion = $scope.edtReaccion.message;
            console.log($scope.edtReaccion);
            $("#editar-reaccion").modal();
        })
    }
    $scope.editarReaccion = function (data) {
        examenServices.editarReaccion(data).then(function () {
            $scope.reaccionEditado = examenServices.response;
            console.log($scope.reaccionEditado)
            $("#editar-reaccion").modal("hide");
        })
    }

    /*ELIMINAR */
    //eliminar Biometria
    $scope.elmBiometria = {};
    $scope.eliminarBiometria = function (id) {
        $scope.elmBiometria.id = id;
        $("#eliminar-biometria").modal();
    }

    $scope.deleteBiometria = function (data) {
        examenServices.eliminarBiometria(data).then(function () {
            $scope.biometriaEliminado = examenServices.response;
            console.log($scope.biometriaEliminado)
            $("#eliminar-biometria").modal("hide");
            $scope.listar($scope.idExamen);
        })
    }

    //eliminar general
    $scope.elmGeneral = {};
    $scope.eliminarGeneral = function (id) {
        $scope.elmGeneral.id = id;
        $("#eliminar-general").modal();
    }

    $scope.deleteGeneral = function (data) {
        examenServices.eliminarGeneral(data).then(function () {
            $scope.generalEliminado = examenServices.response;
            console.log($scope.generalEliminado)
            $("#eliminar-general").modal("hide");
            $scope.listar($scope.idExamen);
        })
    }
    //eliminar reaccion
    $scope.elmReaccion = {};
    $scope.eliminarReaccion = function (id) {
        $scope.elmReaccion.id = id;
        $("#eliminar-reaccion").modal();
    }

    $scope.deleteReaccion = function (data) {
        examenServices.eliminarReaccion(data).then(function () {
            $scope.reaccionEliminado = examenServices.response;
            console.log($scope.reaccionEliminado)
            $("#eliminar-reaccion").modal("hide");
            $scope.listar($scope.idExamen);
        })
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

    $scope.editarPrueba = function (idPrueba, nombrePrueba) {
        switch (nombrePrueba) {
            case 'biometria':
                $scope.listarBio(idPrueba);
                break;
            case 'examen_general':
                $scope.listarGen(idPrueba);
                break;
            case 'reaccion_w':
                $scope.listarRea(idPrueba);
                break;
            default:
                break;
        }
        console.log(idPrueba + " " + nombrePrueba)
    }

    $scope.eliminarPrueba = function (idPrueba, nombrePrueba) {
        switch (nombrePrueba) {
            case 'biometria':
                $scope.eliminarBiometria(idPrueba);
                break;
            case 'examen_general':
                $scope.eliminarGeneral(idPrueba);
                break;
            case 'reaccion_w':
                $scope.eliminarReaccion(idPrueba);
                break;
            default:
                break;
        }
        console.log(idPrueba + " " + nombrePrueba)
    }

}])


