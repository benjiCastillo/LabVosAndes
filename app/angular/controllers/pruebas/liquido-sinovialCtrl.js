var app = angular.module('vosandesApp.liquidoSinovialCtrl', []);

app.controller('liquidoSinovialCtrl', ['$scope', '$routeParams', '$window', 'liquidoSinovialServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, liquidoSinovialServices, medicosServices, $sessionStorage, moment) {

    //liquidoSinovial
    $scope.liquidoSinovial = new Object();
    $scope.liquidoSinovial = {
        volumen: "",
        proteinas_totales: "",
        glucosa: "",
        celulas: "",
        coagulo_fibrina: "",
        glicemia: "",
        urea: "",
        creatinina: ""
    }

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/liquido-sinovial-pruebas/printliquidoPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.liquidoSinovialLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;



    $scope.listar = function (data) {
        $scope.loadData = true;
        liquidoSinovialServices.listar(data).then(function () {
            $scope.response = liquidoSinovialServices.response;
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
                    $scope.listliquidoSinovial = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.liquidoSinovialLoad = true;
                    createEmbed("liquidoSinovial");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-insertar-liquido-sinovial").modal();
    }
    $scope.insertar = function (liquidoSinovial) {
        liquidoSinovial.prueba_id = $scope.prueba.id;
        liquidoSinovial.token = $scope.user.data.token;
        liquidoSinovial.user = $scope.user.user;
        console.log(liquidoSinovial);
        liquidoSinovialServices.insertar(liquidoSinovial).then(function () {
            var response = liquidoSinovialServices.response;
            console.log(response);
            $("#modal-insertar-liquido-sinovial").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (liquidoSinovial) {
        $scope.edtliquidoSinovial = liquidoSinovial;
        $("#modal-edit-liquido-sinovial").modal();
    }

    $scope.edit = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        liquidoSinovialServices.modificar(pacienteMod).then(function () {
            $scope.response = liquidoSinovialServices.response;
            console.log($scope.response);
            $("#modal-edit-liquido-sinovial").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-liquido-sinovial-delete").modal();
        $scope.dataliquidoSinovial = prueba;
    }

    $scope.eliminar = function (dataliquidoSinovial) {

        var liquidoSinovial = new Object();
        liquidoSinovial.id = dataliquidoSinovial.id;
        liquidoSinovial.user = $scope.user.user;
        liquidoSinovial.token = $scope.user.data.token;
        liquidoSinovialServices.eliminar(liquidoSinovial).then(function () {
            $scope.response = liquidoSinovialServices.response;
            $("#modal-liquido-sinovial-delete").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('liquidoSinovial')
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