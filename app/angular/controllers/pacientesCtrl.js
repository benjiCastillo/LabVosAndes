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
    $scope.buscador = '';
    $scope.response = {
        data: [],
        total: 0,
        pages: 0,
        current_page: 1,
        limit: 0
    };

    $scope.listar = function (query) {
        var defaults = { fullname: "", page: 1 };
        var params = Object.assign(defaults, query);
        console.log("params", params);
        $scope.paciente.visible = true;
        pacientesServices.listar(params).then(function () {
            $scope.response = pacientesServices.response;
            $scope.cargandoPacientes = false;

            if ($scope.response.data.length == 0) {
                $scope.noExistenPacientes = true;
                $scope.pacientesCargado = false;
            } else {
                $scope.pacientesCargado = true;
                $scope.noExistenPacientes = false;
                $scope.pacientes = $scope.response.data;
                $scope.response.current_page = parseInt($scope.response.current_page);
            }

            console.log("$scope.response", $scope.response)
        });
    }

    $scope.listar();

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

    $scope.search = function () {
        $scope.listar({ "fullname": $scope.buscador, 'page': 1 });
    }

    $scope.toPage = function (page, action) {
        if (action == 'add') {
            page = parseInt(page) + 1;
        }
        else if (action == 'subs') {
            page = parseInt(page) - 1;
        }
        if (page == 0)
            page = 1;
        console.log(page, $scope.response.pages)
        if (page > $scope.response.pages)
            page = $scope.response.pages;

        $scope.listar({ "fullname": $scope.buscador, page: page });
    }

}])


