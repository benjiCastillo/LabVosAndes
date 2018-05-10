var app = angular.module('vosandesApp.createpruebasCtrl', []);

app.controller('createpruebasCtrl', ['$scope', '$routeParams', '$window', 'pruebasServices', 'medicosServices', '$sessionStorage', function ($scope, $routeParams, $window, pruebasServices, medicosServices, $sessionStorage ) {

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
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


    $scope.crearPruebas = function (prueba) {
        $window.location.href = '#/paciente/pruebas/create/' + prueba;
    }

}])
