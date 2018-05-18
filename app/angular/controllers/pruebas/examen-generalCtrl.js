var app = angular.module('vosandesApp.examenGeneralCtrl', []);

app.controller('examenGeneralCtrl', ['$scope', '$routeParams', '$window', 'examenGeneralServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, examenGeneralServices, medicosServices, $sessionStorage, moment) {

    //biometria
    $scope.examenGeneral = new Object();
    $scope.examenGeneral = {
        color: "",
        cantidad: "",
        olor: "",
        aspecto: "",
        espuma: "",
        sedimento: "",
        densidad: "",
        reaccion: "",
        proteinas: "",
        glucosa: "",
        cetona: "",
        bilirrubina: "",
        sangre: "",
        nitritos: "",
        urubilinogeno: "",
        eritrocitos: "",
        piocitos: "",
        leucocitos: "",
        cilindros: "",
        celulas: "",
        cristales: "",
        otros: "",
        exa_bac_sed: "",

    }




    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/examen-general-pruebas/printGeneralPruebas/' + $scope.prueba.id;
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
        examenGeneralServices.listar(data).then(function () {
            $scope.response = examenGeneralServices.response;
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
                    $scope.listGeneral = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.biometriaLoad = true;
                    createEmbed("general");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-insertar-general").modal();
    }

    $scope.insertar = function (general) {
        general.prueba_id = $scope.prueba.id;
        general.token = $scope.user.data.token;
        general.user = $scope.user.user;
        // console.log(general);
        examenGeneralServices.insertar(general).then(function () {
            var response = examenGeneralServices.response;
            console.log(response);
            $("#modal-insertar-general").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (general) {
        $scope.edtBiometria = general;
        $("#modal-edit-general").modal();
    }

    $scope.edit = function (general) {
        general.user = $scope.user.user;
        general.token = $scope.user.data.token;
        console.log(general)
        examenGeneralServices.modificar(general).then(function () {
            $scope.response = examenGeneralServices.response;
            console.log($scope.response);
            $("#modal-edit-general").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-delete-general").modal();
        $scope.dataGeneral = prueba;
    }

    $scope.eliminar = function (dataBiometria) {

        var biometria = new Object();
        biometria.id = dataBiometria.id;
        biometria.user = $scope.user.user;
        biometria.token = $scope.user.data.token;
        examenGeneralServices.eliminar(biometria).then(function () {
            $scope.response = examenGeneralServices.response;
            $("#modal-delete-general").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('general')
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
