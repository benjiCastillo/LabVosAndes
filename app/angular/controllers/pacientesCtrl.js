var app = angular.module('vosandesApp.pacientesCtrl', ['ngStorage']);

// controlador clientes
app.controller('pacientesCtrl', ['$scope', '$routeParams', '$window', 'pacientesServices', '$sessionStorage', function ($scope, $routeParams, $window, pacientesServices, $sessionStorage) {

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;

    var pag = $routeParams.pag;
    $scope.paciente = {};
    $scope.paciente.visible = false;
    $scope.pacientes = [];
    $scope.nro = 1;
    $scope.noExistenPacientes = false;
    $scope.cargandoPacientes = true;
    $scope.pacientesCargado = false;

    $scope.listar = function (user) {

        $scope.paciente.visible = true;
        pacientesServices.listar(user).then(function () {
            $scope.response = pacientesServices.response;
            $scope.cargandoPacientes = false;

            if ($scope.response.error == 1) {
                $scope.noExistenPacientes = true;
                $scope.pacientesCargado = false;
            } else {
                $scope.pacientesCargado = true;
                $scope.noExistenPacientes = false;
                $scope.pacientes = $scope.response.data;
            }

        });
    }

    $scope.listar(user);

    $scope.insertarModal = function () {
        $scope.pacienteInsertar = {};
        $("#modal-paciente").modal();
    }
    $scope.insertar = function (paciente) {

        paciente.user = $scope.user.user;
        paciente.token = $scope.user.data.token;
        pacientesServices.insertar(paciente).then(function () {
            $scope.response = pacientesServices.response;
            $("#modal-paciente").modal("hide");
            $scope.listar($scope.user);
        });
    }

    $scope.mostrarEditar = function (paciente) {
        $scope.pacienteMod = paciente;
        $("#modal-editar-paciente").modal();
    }

    $scope.modificar = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        pacientesServices.modificar(pacienteMod).then(function () {
            $scope.response = pacientesServices.response;
            $("#modal-editar-paciente").modal("hide");
            $scope.listar($scope.user);
        });
    }

    $scope.mostrarEliminar = function (paciente) {
        $scope.pacienteElim = paciente;
        $("#modal-paciente-eliminar").modal();
    }

    $scope.eliminar = function (paciente) {
        paciente.user = $scope.user.user;
        paciente.token = $scope.user.data.token;
        pacientesServices.eliminar(paciente).then(function () {
            $scope.response = pacientesServices.response;

            $("#modal-paciente-eliminar").modal("hide");
            $scope.listar($scope.user);
        });
    }

    $scope.crearExamen = function (paciente) {
        $sessionStorage.paciente = paciente;
        $window.location.href = '#/paciente/pruebas/';
    }

}])


