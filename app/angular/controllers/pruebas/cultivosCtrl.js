var app = angular.module('vosandesApp.cultivosCtrl', []);

app.controller('cultivosCtrl', ['$scope', '$routeParams', '$window', 'cultivosServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, cultivosServices, medicosServices, $sessionStorage, moment) {

    //cultivos
    $scope.cultivos = new Object();
    $scope.cultivos = {
        leucocitos: "",
        bacterias: "",
        esputo_as: "",
        esputo_microorganismo_identificado: "",
        ampicilina_sulbactam: "",
        eritromicina: "",
        clindamicina: "",
        tetraciclina: "",
        vancomicina: "",
        recuento_colonias: "",
        agar_mac_conkey: "",
        tincion_gram: "",
        pruebas_bioquimicas: "",
        urocultivo_microorganismo_identificado: "",
        amoxicilina_ac_clavulanico: "",
        gentamicina: "",
        ciprofloxacino: "",
        cefixima: "",
        cotrimoxazol: "",
        nitrofurantoina: ""
    }




    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/cultivos-pruebas/printCultivosPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.cultivosLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;



    $scope.listar = function (data) {
        $scope.loadData = true;
        console.log(data)
        cultivosServices.listar(data).then(function () {
            $scope.response = cultivosServices.response;
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
                    $scope.listcultivos = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.cultivosLoad = true;
                    createEmbed("cultivos");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $("#modal-insertar-cultivos").modal();
    }

    $scope.insertar = function (cultivos) {
        cultivos.prueba_id = $scope.prueba.id;
        cultivos.token = $scope.user.data.token;
        cultivos.user = $scope.user.user;
        // console.log(cultivos);
        cultivosServices.insertar(cultivos).then(function () {
            var response = cultivosServices.response;
            console.log(response);
            $("#modal-insertar-cultivos").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (cultivos) {
        $scope.edtcultivos = cultivos;
        $("#modal-edit-cultivos").modal();
    }

    $scope.edit = function (cultivos) {
        cultivos.user = $scope.user.user;
        cultivos.token = $scope.user.data.token;
        console.log(cultivos)
        cultivosServices.modificar(cultivos).then(function () {
            $scope.response = cultivosServices.response;
            console.log($scope.response);
            $("#modal-edit-cultivos").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-delete-cultivos").modal();
        $scope.datacultivos = prueba;
    }

    $scope.eliminar = function (dataCultivos) {

        var cultivos = new Object();
        cultivos.id = dataCultivos.id;
        cultivos.user = $scope.user.user;
        cultivos.token = $scope.user.data.token;
        cultivosServices.eliminar(cultivos).then(function () {
            $scope.response = cultivosServices.response;
            $("#modal-delete-cultivos").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('cultivos')
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
