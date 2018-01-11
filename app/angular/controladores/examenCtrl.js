var app = angular.module('facturacionApp.examenCtrl', []);

// controlador clientes
app.controller('examenCtrl', ['$scope', '$routeParams', 'examenServices', function ($scope, $routeParams, examenServices) {

    $scope.examen = "Examen";
    $scope.examenes = [];
    $scope.cargandoExamenes = true;
    $scope.examenesCargado = false;
    $scope.noExistenExamenes = false;


    $scope.listar = function () {
        examenServices.listar().then(function () {
            $scope.cargandoExamenes = false;
            $scope.examenes = examenServices.response;
            if ($scope.examenes.message[0].respuesta) {
                console.log('respuesta');
                $scope.examenes = [];
                $scope.examenesCargado = false;
                $scope.noExistenExamenes = true;
            } else {
                $scope.examenesCargado = true;
                $scope.examenes = $scope.examenes.message;
                $scope.noExistenExamenes = false;
            }
            console.log($scope.examenes);
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

    $scope.listar();


}])


