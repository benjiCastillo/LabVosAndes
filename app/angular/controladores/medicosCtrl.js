var app = angular.module('facturacionApp.medicosCtrl', []);

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


    $scope.listar = function (user) {
        $scope.pacientesMedicos = true;
        medicosServices.listar(user).then(function () {

            $scope.response = medicosServices.response;
            $scope.cargandoMedicos = false;

            if ($scope.response.error == 1) {
    
                $scope.noExistenMedicos = true;
                $scope.medicosCargado = false;
            } else {
                $scope.medicosCargado = true;
                $scope.noExistenMedicos = false;
                $scope.medicos = $scope.response.data;
            }
        });
    }

    $scope.listar($scope.user);

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


}])