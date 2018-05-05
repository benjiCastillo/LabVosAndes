var app = angular.module('vosandesApp.pruebasCtrl', []);

app.controller('pruebasCtrl', ['$scope', '$routeParams', '$window', 'pruebasServices', 'medicosServices', '$sessionStorage','moment', function ($scope, $routeParams, $window, pruebasServices, medicosServices, $sessionStorage,moment) {

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.dataQuery = new Object();
    $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;

    $scope.dataQuery.user = $scope.user;
    $scope.dataQuery.paciente = $scope.paciente;
    $scope.dataQueryMed.user = $scope.user.user;
    $scope.dataQueryMed.data = {};
    $scope.dataQueryMed.data.token = $scope.user.data.token

    $scope.listar = function (data) {
        //  console.log(data)
        $scope.paciente.visible = true;
        pruebasServices.listar(data).then(function () {
            $scope.response = pruebasServices.response;
            console.log($scope.response);
            $scope.loadData = false;

            if ($scope.response.error == 1) {
                $scope.notData = true;
                $scope.pacientesCargado = false;
            } else {
                $scope.pacientesCargado = true;
                $scope.notData = false;
                $scope.listaExamenes = $scope.response.data;
            }

        });
    }



    $scope.listar($scope.dataQuery);

    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-pruebas-add").modal();
        console.log($scope.dataQueryMed);
        $scope.listarMedicos($scope.dataQueryMed)
    }
    $scope.insertar = function (medico) {
        if (!isNaN(medico)) {
            var data = new Object();
            data.token = $scope.user.data.token;
            data.user = $scope.user.user;
            data.medico_id = parseInt(medico);
            data.paciente_id = $scope.paciente.id;
            data.fecha =   moment().format('YYYY-MM-DD HH:mm:ss');
            console.log(data);

            pruebasServices.insertar(data).then(function () {
                var response = pruebasServices.response;
                console.log(response);
                $("#modal-pruebas-add").modal("hide");
                $scope.listar($scope.dataQuery);
            });
        } else {
            console.log("elija un medico")
        }

    }

    // obtenerMedicos
    $scope.listarMedicos = function (data) {
        medicosServices.listar(data).then(function () {
            $scope.response = medicosServices.response;
            console.log($scope.response);
            $scope.medicos = $scope.response.data;
            // $scope.loadData = false;

            // if ($scope.response.error == 1) {
            //     $scope.notData = true;
            //     $scope.pacientesCargado = false;
            // } else {
            //     $scope.pacientesCargado = true;
            //     $scope.notData = false;
            //     $scope.listaExamenes = $scope.response.data;
            // }

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

    function getDate() {
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0!

        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        return dd + '/' + mm + '/' + yyyy;
    }

}])
