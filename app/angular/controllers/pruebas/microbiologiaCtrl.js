var app = angular.module('vosandesApp.microbiologiaCtrl', []);

app.controller('microbiologiaCtrl', ['$scope', '$routeParams', '$window', 'microbiologiaServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, microbiologiaServices, medicosServices, $sessionStorage, moment) {

    //microbiologia
    $scope.microbiologia = new Object();
    $scope.microbiologia = {
        celulas_epitelio_vaginal: "",
        leucocitos: "",
        piocitos: "",
        celulas_clave: "",
        tricomona_vaginalis: "",
        flora_bacteriana: "",
        hifas_micoticas: "",
        prueba_koh: "",
        coco_bacilos_gram_positivos: "",
        cocos_gram_positivos: "",
        bacilos_gram_positivos: "",
        bacilos_gram_negativos: "",
        hifas_esporas_micoticas: "",
    }

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/microbiologia-pruebas/printmicrobiologiaPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.microbiologiaLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;



    $scope.listar = function (data) {
        $scope.loadData = true;
        microbiologiaServices.listar(data).then(function () {
            $scope.response = microbiologiaServices.response;
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
                    $scope.listmicrobiologia = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.microbiologiaLoad = true;
                    createEmbed("microbiologia");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-insertar-microbiologia").modal();
    }
    $scope.insertar = function (microbiologia) {
        microbiologia.prueba_id = $scope.prueba.id;
        microbiologia.token = $scope.user.data.token;
        microbiologia.user = $scope.user.user;
        console.log(microbiologia);
        microbiologiaServices.insertar(microbiologia).then(function () {
            var response = microbiologiaServices.response;
            console.log(response);
            $("#modal-insertar-microbiologia").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (microbiologia) {
        $scope.edtmicrobiologia = microbiologia;
        $("#modal-edit-microbiologia").modal();
    }

    $scope.edit = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        microbiologiaServices.modificar(pacienteMod).then(function () {
            $scope.response = microbiologiaServices.response;
            console.log($scope.response);
            $("#modal-edit-microbiologia").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-microbiologia-delete").modal();
        $scope.datamicrobiologia = prueba;
    }

    $scope.eliminar = function (datamicrobiologia) {

        var microbiologia = new Object();
        microbiologia.id = datamicrobiologia.id;
        microbiologia.user = $scope.user.user;
        microbiologia.token = $scope.user.data.token;
        microbiologiaServices.eliminar(microbiologia).then(function () {
            $scope.response = microbiologiaServices.response;
            $("#modal-microbiologia-delete").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('microbiologia')
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