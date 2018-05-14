var app = angular.module('vosandesApp.quimicaSanguineaCtrl', []);

app.controller('quimicaSanguineaCtrl', ['$scope', '$routeParams', '$window', 'quimicaSanguineaServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, quimicaSanguineaServices, medicosServices, $sessionStorage, moment) {

    //biometria
    $scope.quimicaSanguinea = new Object();
    $scope.quimicaSanguinea = {
        glucemia: "",
        urea: "",
        creatinina: "",
        acido_urico: "",
        colesterol_total: "",
        hdl_colesterol: "",
        ldl_colesterol: "",
        trigliceridos: "",
        f_alcalina: "",
        transaminasa_got: "",
        transaminasa_gpt: "",
        bilirrubina_total: "",
        bilirrubina_directa: "",
        bilirrubina_indirecta: "",
        amilasa: "",
        proteinas_totales: "",
        albumina: "",
        calcio: "",
        cpk: "",
        cpk_mb: "",
        gamaglutamil_transpeptidasa: "",
        prueba_inmunologica_embarazo: "",
    }




    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/quimica-sanguinea-pruebas/printQuimicaPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.quimicaLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;



    $scope.listar = function (data) {
        $scope.loadData = true;
        console.log(data)
        quimicaSanguineaServices.listar(data).then(function () {
            $scope.response = quimicaSanguineaServices.response;
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
                    $scope.listQuimica = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.quimicaLoad = true;
                    createEmbed("quimica");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $("#modal-insertar-quimica").modal();
    }

    $scope.insertar = function (quimica) {
        quimica.prueba_id = $scope.prueba.id;
        quimica.token = $scope.user.data.token;
        quimica.user = $scope.user.user;
        // console.log(quimica);
        quimicaSanguineaServices.insertar(quimica).then(function () {
            var response = quimicaSanguineaServices.response;
            console.log(response);
            $("#modal-insertar-quimica").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (quimica) {
        $scope.edtQuimica = quimica;
        $("#modal-edit-quimica").modal();
    }

    $scope.edit = function (quimica) {
        quimica.user = $scope.user.user;
        quimica.token = $scope.user.data.token;
        console.log(quimica)
        quimicaSanguineaServices.modificar(quimica).then(function () {
            $scope.response = quimicaSanguineaServices.response;
            console.log($scope.response);
            $("#modal-edit-quimica").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-delete-quimica").modal();
        $scope.dataquimica = prueba;
    }

    $scope.eliminar = function (dataBiometria) {

        var biometria = new Object();
        biometria.id = dataBiometria.id;
        biometria.user = $scope.user.user;
        biometria.token = $scope.user.data.token;
        quimicaSanguineaServices.eliminar(biometria).then(function () {
            $scope.response = quimicaSanguineaServices.response;
            $("#modal-delete-quimica").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('quimica')
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
