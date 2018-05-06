var app = angular.module('vosandesApp.pruebasCtrl', []);

app.controller('pruebasCtrl', ['$scope', '$routeParams', '$window', 'pruebasServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, pruebasServices, medicosServices, $sessionStorage, moment) {

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.dataQuery = new Object();
    $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $notMedico = true;

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
            // console.log($scope.response);
            $scope.loadData = false;

            if ($scope.response.error == 1) {
                $scope.notData = true;
            } else {
                $scope.pacientesCargado = true;

                $scope.listPruebas = $scope.response.data;
                $scope.msgPruebas = $scope.response.message;
            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-pruebas-add").modal();
        console.log($scope.dataQueryMed);
    }
    $scope.insertar = function (medico) {
        if (!isNaN(medico)) {
            var data = new Object();
            data.token = $scope.user.data.token;
            data.user = $scope.user.user;
            data.medico_id = parseInt(medico);
            data.paciente_id = $scope.paciente.id;
            data.fecha = moment(new Date().toISOString()).format('YYYY-MM-DD HH:mm:ss');
            // data.fecha = new Date().toLocaleString();
            // console.log(data);

            pruebasServices.insertar(data).then(function () {
                var response = pruebasServices.response;
                //  console.log(response);
                $("#modal-pruebas-add").modal("hide");
                $scope.listar($scope.dataQuery);
            });
        } else {
            alert("Elija un médico o registre médicos para registrar un prueba")
        }

    }


    $scope.mostrarEliminar = function (prueba) {
        $("#modal-pruebas-delete").modal();
        $scope.dataPrueba = prueba;
    }

    $scope.eliminar = function (dataPrueba) {
        // console.log(dataPrueba)
        var prueba = new Object();
        prueba.id = dataPrueba.id;
        prueba.user = $scope.user.user;
        prueba.token = $scope.user.data.token;
        pruebasServices.eliminar(prueba).then(function () {
            $scope.response = pruebasServices.response;
            $("#modal-pruebas-delete").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }
    // obtenerMedicos
    $scope.listarMedicos = function (data) {
        medicosServices.listar(data).then(function () {
            $scope.medicos = medicosServices.response.data;
            // console.log($scope.medicos.length)
            if ($scope.medicos.length == 0) {
                alert("No existen médicos registrados, registre médicos para registrar un prueba")
            }
        });
    }

    $scope.crearPruebas = function (prueba) {
        $sessionStorage.prueba = prueba;
        $window.location.href = '#/paciente/pruebas/create';
    }


    $scope.listarMedicos($scope.dataQueryMed)



}])
