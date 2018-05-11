var app = angular.module('vosandesApp.serologiaCtrl', []);

app.controller('serologiaCtrl', ['$scope', '$routeParams', '$window', 'serologiaServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, serologiaServices, medicosServices, $sessionStorage, moment) {

    //serologia
    $scope.serologia = new Object();
    $scope.serologia = {
        factor_reumatoide: "",
        pcr: "",
        asto: "",
        aso: "",
        k_plus: "",
        na_plus: "",
        cl_minus: "",
        ca: "",
        p: "",
        chagas: "",
        toxoplasmosis: "",
        chagas_resultado: "",
        chagas_elisa_cut_off: "",
        chagas_comentario: "",
        tiempo_sangria: "",
        tiempo_coagulacion: "",
        tiempo_protrombina: "",
        actividad_protrombina: "",
        grupo_sanguineo: "",
        factor_rh: "",
        recuento_plaquetas: "",
        agr_dis_plaquetaria: ""
    }

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/serologia-pruebas/printSerologiaPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.serologiaLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;

    $scope.listar = function (data) {
        $scope.loadData = true;
        serologiaServices.listar(data).then(function () {
            $scope.response = serologiaServices.response;
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
                    $scope.listserologia = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.serologiaLoad = true;
                    createEmbed("serologia");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $scope.medico = {};
        $("#modal-insertar-serologia").modal();
    }
    $scope.insertar = function (serologia) {
        serologia.prueba_id = $scope.prueba.id;
        serologia.token = $scope.user.data.token;
        serologia.user = $scope.user.user;
        console.log(serologia);
        serologiaServices.insertar(serologia).then(function () {
            var response = serologiaServices.response;
            console.log(response);
            $("#modal-insertar-serologia").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (serologia) {
        $scope.edtserologia = serologia;
        $("#modal-edit-serologia").modal();
    }

    $scope.edit = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        serologiaServices.modificar(pacienteMod).then(function () {
            $scope.response = serologiaServices.response;
            console.log($scope.response);
            $("#modal-edit-serologia").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-serologia-delete").modal();
        $scope.dataserologia = prueba;
    }

    $scope.eliminar = function (dataserologia) {

        var serologia = new Object();
        serologia.id = dataserologia.id;
        serologia.user = $scope.user.user;
        serologia.token = $scope.user.data.token;
        serologiaServices.eliminar(serologia).then(function () {
            $scope.response = serologiaServices.response;
            $("#modal-serologia-delete").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('serologia')
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