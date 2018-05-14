var app = angular.module('vosandesApp.reaccionwCtrl', []);

app.controller('reaccionwCtrl', ['$scope', '$routeParams', '$window', 'reaccionwServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, reaccionwServices, medicosServices, $sessionStorage, moment) {

    //reaccionw
    $scope.reaccionw = new Object();
    $scope.reaccionw = {
        paraA1: "",
        paraA2: "",
        paraA3: "",
        paraA4: "",
        paraA5: "",
        paraA6: "",
        paraB1: "",
        paraB2: "",
        paraB3: "",
        paraB4: "",
        paraB5: "",
        paraB6: "",
        somaticoO1: "",
        somaticoO2: "",
        somaticoO3: "",
        somaticoO4: "",
        somaticoO5: "",
        somaticoO6: "",
        flagelarH1: "",
        flagelarH2: "",
        flagelarH3: "",
        flagelarH4: "",
        flagelarH5: "",
        flagelarH6: "",
        comentario: ""
    }

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/reaccion-w-pruebas/printReaccionPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.reaccionwLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;

    $scope.listar = function (data) {
        $scope.loadData = true;
        reaccionwServices.listar(data).then(function () {
            $scope.response = reaccionwServices.response;
            console.log($scope.response);
            $scope.loadData = false;

            if ($scope.response.error == 1) {
                $scope.notData = true;
            } else {
                $scope.pacientesCargado = true;
                if ($scope.response.data == null) {
                    $scope.notData = true;
                } else {
                    $scope.notData = false;
                    $scope.listreaccionw = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.reaccionwLoad = true;
                    createEmbed("reaccionw");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $("#modal-insertar-reaccionw").modal();
    }
    $scope.insertar = function (reaccionw) {
        reaccionw.prueba_id = $scope.prueba.id;
        reaccionw.token = $scope.user.data.token;
        reaccionw.user = $scope.user.user;
        console.log(reaccionw);
        reaccionwServices.insertar(reaccionw).then(function () {
            var response = reaccionwServices.response;
            console.log(response);
            $("#modal-insertar-reaccionw").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (reaccionw) {
        $scope.edtreaccionw = reaccionw;
        $("#modal-edit-reaccionw").modal();
    }

    $scope.edit = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        reaccionwServices.modificar(pacienteMod).then(function () {
            $scope.response = reaccionwServices.response;
            console.log($scope.response);
            $("#modal-edit-reaccionw").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-reaccionw-delete").modal();
        $scope.datareaccionw = prueba;
    }

    $scope.eliminar = function (datareaccionw) {

        var reaccionw = new Object();
        reaccionw.id = datareaccionw.id;
        reaccionw.user = $scope.user.user;
        reaccionw.token = $scope.user.data.token;
        reaccionwServices.eliminar(reaccionw).then(function () {
            $scope.response = reaccionwServices.response;
            $("#modal-reaccionw-delete").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('reaccionw')
        });
    }

    function newElement(type) {
        var pdf = document.createElement("embed");
        pdf.setAttribute("src", $scope.PATH);
        pdf.setAttribute("width", "100%");
        pdf.setAttribute("id", "pdf-" + type);
        pdf.setAttribute("height", "400px");
        var div_element = document.getElementById("section-pdf");
        div_element.appendChild(pdf);
    }

    function createEmbed(type) {
        if (document.getElementById('pdf-' + type)) {
            deleteElement(type)
            newElement(type);
        } else {
            newElement(type);
        }
    }

    function deleteElement(type) {
        var el = document.getElementById('pdf-' + type);
        el.parentNode.removeChild(el);
    }

}])