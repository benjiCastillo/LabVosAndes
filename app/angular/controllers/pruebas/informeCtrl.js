var app = angular.module('vosandesApp.informeCtrl', []);

app.controller('informeCtrl', ['$scope', '$routeParams', '$window', 'informeServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, informeServices, medicosServices, $sessionStorage, moment) {

    //informe
    $scope.informe = new Object();
    $scope.informe = {
        grupo_sanguineo: "",
        factor_rh: "",
        prueba_inmunologica_embarazo:"",
        other:""
    }

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/informe-pruebas/printInformePruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.informeLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;



    $scope.listar = function (data) {
        $scope.loadData = true;
        informeServices.listar(data).then(function () {
            $scope.response = informeServices.response;
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
                    $scope.listInforme = $scope.response.data;
                    console.log("datos desde el backend")
                    console.log($scope.listInforme);
                    $scope.msgPruebas = $scope.response.message;
                    $scope.informeLoad = true;
                    createEmbed("informe");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-insertar-informe").modal();
    }
    $scope.insertar = function (informe) {
        informe.prueba_id = $scope.prueba.id;
        informe.token = $scope.user.data.token;
        informe.user = $scope.user.user;
        console.log(informe);
        informeServices.insertar(informe).then(function () {
            var response = informeServices.response;
            console.log(response);
            $("#modal-insertar-informe").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (informe) {
        $scope.edtinforme = informe;
        $("#modal-edit-informe").modal();
    }

    $scope.edit = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        informeServices.modificar(pacienteMod).then(function () {
            $scope.response = informeServices.response;
            console.log($scope.response);
            $("#modal-edit-informe").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-informe-delete").modal();
        $scope.datainforme = prueba;
    }

    $scope.eliminar = function (datainforme) {

        var informe = new Object();
        informe.id = datainforme.id;
        informe.user = $scope.user.user;
        informe.token = $scope.user.data.token;
        informeServices.eliminar(informe).then(function () {
            $scope.response = informeServices.response;
            $("#modal-informe-delete").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('informe')
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