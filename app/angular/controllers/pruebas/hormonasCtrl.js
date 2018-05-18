var app = angular.module('vosandesApp.hormonasCtrl', []);

app.controller('hormonasCtrl', ['$scope', '$routeParams', '$window', 'hormonasServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, hormonasServices, medicosServices, $sessionStorage, moment) {

    //hormonas
    $scope.hormonas = new Object();
    $scope.hormonas = {
        tsh: "",
        t4_libre: "",
        t4_total: "",
        t3: "",
        cisticercosis_resultado: "",
        cisticercosis_cut_off: "",
        comentario_cisticercosis: "",
        antigeno_carcino: "",
        psa_total: "",
        psa_libre: "",
        relacion_psa_libre_total: "",
        estradiol: "",
        progesterona: "",
        fsh: "",
        lh: "",
        prolactina: "",
        testosterona: "",
        ana: "",
        ana_control_positivo: "",
        ana_control_negativo: "",
        celulas_le: "",
        celulas_le_control_positivo: "",
        celulas_le_control_negativo: "",
        anticuerpos_resultado: "",
        anticuerpos_cut_off: "",
        comentario_anticuerpos: "",
        toxoplasmosis_lgm: "",
        toxoplasmosis_lgg: "",
        b_hcg_cuantitativo: "",
        anti_nucleares: "",
        anticuerpos_control_positivo: "",
        anticuerpos_control_negativo: "",
        celulas_hep: "",
        control_positivo: "",
        control_negativo: "",
        conclusion: "",
        comentario_general: "",
        laboratorio:""
    }

    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/hormonasPruebas/printHormonasPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.hormonasLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;

    $scope.listar = function (data) {
        $scope.loadData = true;
        hormonasServices.listar(data).then(function () {
            $scope.response = hormonasServices.response;
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
                    $scope.listhormonas = $scope.response.data;
                    $scope.msgPruebas = $scope.response.message;
                    $scope.hormonasLoad = true;
                    createEmbed("hormonas");
                }

            }

        });
    }

    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        $("#modal-insertar-hormonas").modal();
    }
    $scope.insertar = function (hormonas) {
        hormonas.prueba_id = $scope.prueba.id;
        hormonas.token = $scope.user.data.token;
        hormonas.user = $scope.user.user;
        console.log(hormonas);
        hormonasServices.insertar(hormonas).then(function () {
            var response = hormonasServices.response;
            console.log(response);
            $("#modal-insertar-hormonas").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (hormonas) {
        $scope.edthormonas = hormonas;
        $("#modal-edit-hormonas").modal();
    }

    $scope.edit = function (pacienteMod) {
        pacienteMod.user = $scope.user.user;
        pacienteMod.token = $scope.user.data.token;
        hormonasServices.modificar(pacienteMod).then(function () {
            $scope.response = hormonasServices.response;
            console.log($scope.response);
            $("#modal-edit-hormonas").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-hormonas-delete").modal();
        $scope.datahormonas = prueba;
    }

    $scope.eliminar = function (datahormonas) {

        var hormonas = new Object();
        hormonas.id = datahormonas.id;
        hormonas.user = $scope.user.user;
        hormonas.token = $scope.user.data.token;
        hormonasServices.eliminar(hormonas).then(function () {
            $scope.response = hormonasServices.response;
            $("#modal-hormonas-delete").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('hormonas')
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