var app = angular.module('vosandesApp.espermogramasCtrl', []);

app.controller('espermogramasCtrl', ['$scope', '$routeParams', '$window', 'espermogramasServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, espermogramasServices, medicosServices, $sessionStorage, moment) {
    moment.tz.setDefault("America/La_Paz");
    //espermogramas
    $scope.espermogramas = new Object();
    $scope.espermogramas = {
        duracion_abstinencia: "",
        aspecto: "",
        color: "",
        volumen: "",
        viscosidad: "",
        ph: "",
        concentracion_espermatica: "",
        caracteristicas_morfologicas: "",
        espermatozoides_normales: "",
        cabeza: "",
        pieza_intermedia: "",
        cola: "",
        otras_celulas: "",
        aglutinacion: "",
        progresion_lineal_rapida: "",
        progresion_lineal_lenta: "",
        motilidad_no_progresiva: "",
        inmoviles: "",
        primera_hora_moviles: "",
        primera_hora_inmoviles: "",
        segunda_hora_moviles: "",
        segunda_hora_inmoviles: "",
        tercera_hora_moviles: "",
        tercera_hora_inmoviles: ""
    }




    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.prueba = $sessionStorage.prueba;
    $scope.PATH = 'http://localhost/LabVosAndes/api/espermograma-pruebas/printEspermogramaPruebas/' + $scope.prueba.id;
    console.log()
    $scope.dataQuery = new Object();
    // $scope.dataQueryMed = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $scope.espermogramasLoad = false;
    // $notMedico = true;

    $scope.dataQuery.user = $scope.user.user;
    $scope.dataQuery.token = $scope.user.data.token;
    $scope.dataQuery.prueba_id = $scope.prueba.id;



    $scope.listar = function (data) {
        $scope.loadData = true;
        console.log(data)
        espermogramasServices.listar(data).then(function () {
            $scope.response = espermogramasServices.response;
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
                    $scope.listespermogramas = $scope.response.data;
                    console.log($scope.listespermogramas )
                    $scope.msgPruebas = $scope.response.message;
                    $scope.espermogramasLoad = true;
                    createEmbed("espermogramas");
                }

            }
        });
    }

    $scope.listar($scope.dataQuery);

    // modal add
    $scope.insertarModal = function () {
        $("#modal-insertar-espermogramas").modal();
    }

    $scope.insertar = function (espermogramas) {
        var hora_reco = document.getElementById("hora_recoleccion_form").value;
        var hora_rece = document.getElementById("hora_recepcion_form").value;
        espermogramas.prueba_id = $scope.prueba.id;
        espermogramas.token = $scope.user.data.token;
        espermogramas.user = $scope.user.user;
        espermogramas.hora_recoleccion = moment(hora_reco).format('YYYY-MM-DD HH:mm');
        espermogramas.hora_recepcion = moment(hora_rece).format('YYYY-MM-DD HH:mm');
        console.log(espermogramas)
        espermogramasServices.insertar(espermogramas).then(function () {
            var response = espermogramasServices.response;
            console.log(response);
            $("#modal-insertar-espermogramas").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (espermogramas) {
        console.log(moment(espermogramas.hora_recoleccion).format('YYYY-MM-DDThh:mm'));
        espermogramas.hora_recoleccion = moment(espermogramas.hora_recoleccion).format('YYYY-MM-DDThh:mm');
        espermogramas.hora_recepcion = moment(espermogramas.hora_recepcion).format('YYYY-MM-DDThh:mm');
        // document.getElementById("edt_hora_recoleccion_form").value = moment(espermogramas.hora_recoleccion).format('yyyy-MM-ddThh:mm');
        // document.getElementById("edt_hora_recepcion_form").value = moment(espermogramas.hora_recepcion).format('yyyy-MM-ddThh:mm');
        $scope.edtespermogramas = espermogramas;
        $("#modal-edit-espermogramas").modal();
    }

    $scope.edit = function (espermogramas) {
        var h_reco = document.getElementById("edt_hora_recoleccion").value;
        var h_rece = document.getElementById("edt_hora_recepcion").value;
        espermogramas.user = $scope.user.user;
        espermogramas.token = $scope.user.data.token;
        espermogramas.hora_recoleccion = moment(h_reco).format('YYYY-MM-DD HH:mm');
        espermogramas.hora_recepcion = moment(h_rece).format('YYYY-MM-DD HH:mm');
        console.log(espermogramas)
        espermogramasServices.modificar(espermogramas).then(function () {
            $scope.response = espermogramasServices.response;
            console.log($scope.response);
            $("#modal-edit-espermogramas").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-delete-espermogramas").modal();
        $scope.dataespermogramas = prueba;
    }

    $scope.eliminar = function (dataespermogramas) {

        var espermogramas = new Object();
        espermogramas.id = dataespermogramas.id;
        espermogramas.user = $scope.user.user;
        espermogramas.token = $scope.user.data.token;
        espermogramasServices.eliminar(espermogramas).then(function () {
            $scope.response = espermogramasServices.response;
            $("#modal-delete-espermogramas").modal("hide");
            $scope.listar($scope.dataQuery);
            deleteElement('espermogramas')
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

    $('#hora_recoleccion').datetimepicker({
        format: 'YYYY-MM-DD h:mm:ss a',
        locale: 'es',
    });


}])
