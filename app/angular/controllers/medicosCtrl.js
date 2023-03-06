var app = angular.module('vosandesApp.medicosCtrl', []);

// controlador clientes
app.controller('medicosCtrl', ['$scope', '$routeParams', 'medicosServices', function ($scope, $routeParams, medicosServices) {

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;

    var pag = $routeParams.pag
    $scope.medicos = [];
    $scope.nro = 1;
    $scope.noExistenMedicos = false;
    $scope.cargandoMedicos = true;
    $scope.medicosCargado = false;
    $scope.buscadorMedico = '';
    $scope.response = {
        data: [],
        total: 0,
        pages: 0,
        current_page: 1,
        limit: 0
    };

    $scope.listar = function (query) {
        var defaults = { nombre: "", page: 1 };
        var params = Object.assign(defaults, query);
        console.log("params", params);

        $scope.pacientesMedicos = true;
        medicosServices.all(query).then(function () {
            $scope.response = medicosServices.response;
            $scope.cargandoMedicos = false;
            console.log("$scope.response", $scope.response)
            if ($scope.response.data.length == 0) {
                $scope.noExistenMedicos = true;
                $scope.medicosCargado = false;
            } else {
                $scope.medicosCargado = true;
                $scope.noExistenMedicos = false;
                $scope.medicos = $scope.response.data;
            }
        });
    }

    $scope.listar();

    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-medico").modal();
    }

    $scope.insertar = function (medico) {
        medico.user = $scope.user.user;
        medico.token = $scope.user.data.token;
        medicosServices.insertar(medico).then(function () {
            $scope.response = medicosServices.response;
            $("#modal-medico").modal("hide");
            $scope.listar($scope.user);
        });
    }

    $scope.mostrarEditar = function (medico) {
        $scope.medico = medico
        $("#modal-editar-medico").modal();
    }

    $scope.modificar = function (medicoMod) {
        medicoMod.user = $scope.user.user;
        medicoMod.token = $scope.user.data.token;
        medicosServices.modificar(medicoMod).then(function () {
            $scope.response = medicosServices.response;

            $("#modal-editar-medico").modal("hide");
            $scope.listar($scope.user);
        });
    }

    $scope.mostrarEliminar = function (medico) {
        $scope.medico = medico;
        $("#modal-medico-eliminar").modal();
    }

    $scope.eliminar = function (medico) {
        medico.user = $scope.user.user;
        medico.token = $scope.user.data.token;
        medicosServices.eliminar(medico).then(function () {
            $scope.response = medicosServices.response;

            $("#modal-medico-eliminar").modal("hide");
            $scope.listar($scope.user);
        });
    }

    $scope.search = function () {
        $scope.listar({ "nombre": $scope.buscadorMedico, 'page': 1 });
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

        $scope.listar({ "nombre": $scope.buscadorMedico, page: page });
    }

}])