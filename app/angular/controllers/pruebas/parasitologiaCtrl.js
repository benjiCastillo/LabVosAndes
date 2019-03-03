var app = angular.module('vosandesApp.parasitologiaCtrl', []);

app.controller('parasitologiaCtrl', ['$scope', '$routeParams', '$window', 'parasitologiaServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, parasitologiaServices, medicosServices, $sessionStorage, moment) {

    //parasitologia
    $scope.parasitologia = new Object();
    $scope.parasitologia = {
        subtitulo: "",
        consistencia: "",
        color: "",
        restos_alimenticios: "",
        leucocitos: "",
        comentario: "",
        sangre_oculta: "",
        muestra1: "",
        muestra2: "",
        muestra3: "",
    }

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/parasitologia-pruebas/printParasitologiaPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.parasitologiaLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;

    $scope.listar = function (data) {
        $scope.loadData = true;
        parasitologiaServices.listar(data).then(function () {
            $scope.response = parasitologiaServices.response;
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
                    $scope.listparasitologia = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.parasitologiaLoad = true;
                    createEmbed("parasitologia");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-insertar-parasitologia").modal();
    }
    $scope.insertar = function (parasitologia) {
        parasitologia.prueba_id = $scope.prueba.id;
        parasitologia.token = $scope.user.data.token;
        parasitologia.user = $scope.user.user;
        console.log(parasitologia);
        parasitologiaServices.insertar(parasitologia).then(function () {
            var response = parasitologiaServices.response;
            console.log(response);
            $("#modal-insertar-parasitologia").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (parasitologia) {
        $scope.edtparasitologia = parasitologia;
        $("#modal-edit-parasitologia").modal();
    }

    $scope.edit = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        parasitologiaServices.modificar(pacienteMod).then(function () {
            $scope.response = parasitologiaServices.response;
            console.log($scope.response);
            $("#modal-edit-parasitologia").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-parasitologia-delete").modal();
        $scope.dataparasitologia = prueba;
    }

    $scope.eliminar = function (dataparasitologia) {

        var parasitologia = new Object();
        parasitologia.id = dataparasitologia.id;
        parasitologia.user = $scope.user.user;
        parasitologia.token = $scope.user.data.token;
        parasitologiaServices.eliminar(parasitologia).then(function () {
            $scope.response = parasitologiaServices.response;
            $("#modal-parasitologia-delete").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('parasitologia')
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