var app = angular.module('vosandesApp.espermogramasCtrl', []);

app.controller('espermogramasCtrl', ['$scope', '$routeParams', '$window', 'espermogramasServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, espermogramasServices, medicosServices, $sessionStorage, moment) {

    //espermogramas
    $scope.espermogramas = new Object();
    $scope.espermogramas = {
        hora_recoleccion: "",
        hora_recepcion: "",
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
        primera_hora: "",
        segunda_hora: "",
        tercera_hora: ""
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
        espermogramas.prueba_id = $scope.prueba.id;
        espermogramas.token = $scope.user.data.token;
        espermogramas.user = $scope.user.user;
        espermogramas.hora_recoleccion = espermogramas.hora_recoleccion._d;
        espermogramas.hora_recepcion = espermogramas.hora_recepcion._d;
        console.log(espermogramas);
        espermogramasServices.insertar(espermogramas).then(function () {
            var response = espermogramasServices.response;
            console.log(response);
            $("#modal-insertar-espermogramas").modal("hide");
            // $window.location.reload();
            $scope.listar($scope.dataQuery);
        });

    }

    $scope.mostrarEditar = function (espermogramas) {
        $scope.edtespermogramas = espermogramas;
        $("#modal-edit-espermogramas").modal();
    }

    $scope.edit = function (espermogramas) {
        espermogramas.user = $scope.user.user;
        espermogramas.token = $scope.user.data.token;
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

}])
