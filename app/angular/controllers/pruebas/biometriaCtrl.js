var app = angular.module('vosandesApp.biometriaCtrl', []);

app.controller('biometriaCtrl', ['$scope', '$routeParams', '$window', 'biometriaServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, biometriaServices, medicosServices, $sessionStorage, moment) {

    //biometria
    $scope.biometria = new Object();
    $scope.biometria.hematies = "";
    $scope.biometria.hematocrito = "";
    $scope.biometria.hemoglobina = "";
    $scope.biometria.leucocitos = "";
    $scope.biometria.vsg = "";
    $scope.biometria.vcm = "";
    $scope.biometria.hbcm = "";
    $scope.biometria.chbcm = "";
    $scope.biometria.comentario_hema = "";
    $scope.biometria.cayados = "";
    $scope.biometria.neutrofilos = "";
    $scope.biometria.basofilo = "";
    $scope.biometria.eosinofilo = "";
    $scope.biometria.linfocito = "";
    $scope.biometria.monocito = "";
    $scope.biometria.prolinfocito = "";
    $scope.biometria.cel_inmaduras = "";
    $scope.biometria.comentario_leuco = "";


    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.biometriaLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;
    console.log($scope.dataQuery);
    // $scope.dataQueryMed.user = $scope.user.user;
    // $scope.dataQueryMed.data = {};
    // $scope.dataQueryMed.data.token = $scope.user.data.token


    $scope.listar = function (data) {
        $scope.loadData = true;
        biometriaServices.listar(data).then(function () {
            $scope.response = biometriaServices.response;
            console.log($scope.response);
            $scope.loadData = false;

            if ($scope.response.error == 1) {
                $scope.notData = true;
            } else {
                $scope.pacientesCargado = true;
                if ($scope.response.data == 0) {
                    $scope.notData = true;
                } else {
                    $scope.listBiometria = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.biometriaLoad = true;
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-insertar-biometria").modal();
        //console.log($scope.dataQueryMed);
    }
    $scope.insertar = function (biometria) {
        biometria.prueba_id = $scope.prueba.id;
        biometria.token = $scope.user.data.token;
        biometria.user = $scope.user.user;
        // console.log(biometria);
        biometriaServices.insertar(biometria).then(function () {
            var response = biometriaServices.response;
            console.log(response);
            // $("#modal-insertar-biometria").modal("hide");
            // $scope.listar($scope.dataQuery);
        });

    }


    // $scope.mostrarEliminar = function (prueba) {
    //     $("#modal-pruebas-delete").modal();
    //     $scope.dataPrueba = prueba;
    // }

    // $scope.eliminar = function (dataPrueba) {
    //     // console.log(dataPrueba)
    //     var prueba = new Object();
    //     prueba.id = dataPrueba.id;
    //     prueba.user = $scope.user.user;
    //     prueba.token = $scope.user.data.token;
    //     pruebasServices.eliminar(prueba).then(function () {
    //         $scope.response = pruebasServices.response;
    //         $("#modal-pruebas-delete").modal("hide");
    //         $scope.listar($scope.dataQuery);
    //     });
    // }
    // // obtenerMedicos
    // $scope.listarMedicos = function (data) {
    //     medicosServices.listar(data).then(function () {
    //         $scope.medicos = medicosServices.response.data;
    //         // console.log($scope.medicos.length)
    //         if ($scope.medicos.length == 0) {
    //             alert("No existen médicos registrados, registre médicos para registrar un prueba")
    //         }
    //     });
    // }

    // $scope.crearPruebas = function (prueba) {
    //     $sessionStorage.prueba = prueba;
    //     $window.location.href = '#/paciente/pruebas/create';
    // }

    // $scope.listarMedicos($scope.dataQueryMed)



}])