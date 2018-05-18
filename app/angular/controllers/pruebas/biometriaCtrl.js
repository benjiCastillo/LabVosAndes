var app = angular.module('vosandesApp.biometriaCtrl', []);

app.controller('biometriaCtrl', ['$scope', '$routeParams', '$window', 'biometriaServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, biometriaServices, medicosServices, $sessionStorage, moment) {

    //biometria
    $scope.biometria = new Object();
    $scope.biometria = {
        hematies: "",
        hematocrito: "",
        hemoglobina: "",
        leucocitos: "",
        vsg: "",
        vcm: "",
        hbcm: "",
        chbcm: "",
        comentario_hema: "",
        cayados: "",
        neutrofilos: "",
        basofilo: "",
        eosinofilo: "",
        linfocito: "",
        monocito: "",
        prolinfocito: "",
        cel_inmaduras: "",
        comentario_leuco: ""
    }

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/biometria-pruebas/printBiometriaPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.biometriaLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;



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
                if ($scope.response.data == null) {
                    $scope.notData = true;
                } else {
                    $scope.notData = false;
                    $scope.listBiometria = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.biometriaLoad = true;
                    createEmbed("biometria");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-insertar-biometria").modal();
    }
    $scope.insertar = function (biometria) {
        biometria.prueba_id = $scope.prueba.id;
        biometria.token = $scope.user.data.token;
        biometria.user = $scope.user.user;
        console.log(biometria);
        biometriaServices.insertar(biometria).then(function () {
            var response = biometriaServices.response;
            console.log(response);
            $("#modal-insertar-biometria").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (biometria) {
        $scope.edtBiometria = biometria;
        $("#modal-edit-biometria").modal();
    }

    $scope.edit = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        biometriaServices.modificar(pacienteMod).then(function () {
            $scope.response = biometriaServices.response;
            console.log($scope.response);
            $("#modal-edit-biometria").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-biometria-delete").modal();
        $scope.dataBiometria = prueba;
    }

    $scope.eliminar = function (dataBiometria) {

        var biometria = new Object();
        biometria.id = dataBiometria.id;
        biometria.user = $scope.user.user;
        biometria.token = $scope.user.data.token;
        biometriaServices.eliminar(biometria).then(function () {
            $scope.response = biometriaServices.response;
            $("#modal-biometria-delete").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('biometria')
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