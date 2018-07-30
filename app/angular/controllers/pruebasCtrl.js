var app = angular.module('vosandesApp.pruebasCtrl', []);

app.controller('pruebasCtrl', ['$scope', '$routeParams', '$window', 'pruebasServices', 'medicosServices', '$sessionStorage', 'moment', function ($scope, $routeParams, $window, pruebasServices, medicosServices, $sessionStorage, moment) {
    // moment.tz.setDefault("America/La_Paz");
    var user = sessionStorage.getItem('user');
    user = JSON.parse(user)
    $scope.user = user;
    $scope.paciente = $sessionStorage.paciente;
    $scope.dataQuery = new Object();
    $scope.dataQueryMed = new Object();
    $scope.medicos = new Object();
    $scope.loadData = false;
    $scope.notData = false;
    $notMedico = true;
    $scope.medico = new Object;
    $scope.medico = {
        medico_id: '',
        paciente_id: ''
    }


    $scope.dataQuery.user = $scope.user;
    $scope.dataQuery.paciente = $scope.paciente;
    $scope.dataQueryMed.user = $scope.user.user;
    $scope.dataQueryMed.data = {};
    $scope.dataQueryMed.data.token = $scope.user.data.token
    // obtenerMedicos
    $scope.listarMedicos = function (data) {
        medicosServices.listar(data).then(function () {
            $scope.medicos = medicosServices.response.data;
            console.log($scope.medicos)
            if ($scope.medicos.length == 0) {
                alert("No existen médicos registrados, registre médicos para registrar un prueba")
            }
        });
    }
    $scope.listar = function (data) {
        //  console.log(data)
        $scope.paciente.visible = true;
        pruebasServices.listar(data).then(function () {
            $scope.response = pruebasServices.response;
            // console.log($scope.response);
            $scope.loadData = false;

            if ($scope.response.error == 1) {
                $scope.notData = true;
            } else {
                $scope.pacientesCargado = true;

                $scope.listPruebas = $scope.response.data;
                $scope.msgPruebas = $scope.response.message;
                console.log($scope.listPruebas)
            }

        });
    }

    $scope.listarMedicos($scope.dataQueryMed)
    $scope.listar($scope.dataQuery);


    // modal add
    $scope.insertarModal = function () {
        // var insertDate = moment().format('YYYY-MM-DDTHH:mm');
        // document.getElementById("add_hora_fecha").value = insertDate;
        $("#modal-pruebas-add").modal();
        console.log($scope.dataQueryMed);
    }
    $scope.insertar = function (medico) {
        if (!isNaN(medico.medico_id)) {
            var data = new Object();
            data.token = $scope.user.data.token;
            data.user = $scope.user.user;
            data.medico_id = parseInt(medico.medico_id);
            data.fecha = moment(medico.fecha).format('YYYY-MM-DD HH:mm');
            data.paciente_id = $scope.paciente.id;
            data.comentario = medico.comentario
            console.log(data);
            pruebasServices.insertar(data).then(function () {
                var response = pruebasServices.response;
                console.log(response);
                $("#modal-pruebas-add").modal("hide");
                $scope.listar($scope.dataQuery);
            });
        } else {
            alert("Elija un médico o registre médicos para registrar un prueba")
        }

    }

    $scope.mostrarEditar = function (prueba) {

        prueba.fecha = moment(prueba.fecha).format('YYYY-MM-DDTHH:mm');
        // document.getElementById("edt_hora_fecha").value = prueba.fecha
        console.log(prueba.fecha)
        $scope.edtprueba = prueba;
        $("#modal-edit-prueba").modal();
    }

    $scope.edit = function (pruebaMod) {
        var h_f = document.getElementById("edt_hora_fecha").value;
        pruebaMod.user = $scope.user.user;
        pruebaMod.token = $scope.user.data.token;
        pruebaMod.medico_id = parseInt(pruebaMod.medico_id)
        pruebaMod.fecha = moment(h_f).format('YYYY-MM-DD HH:mm')
        console.log(pruebaMod)
        pruebasServices.modificar(pruebaMod).then(function () {
            $scope.response = pruebasServices.response;
            console.log($scope.response)
            $("#modal-edit-prueba").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }

    $scope.mostrarEliminar = function (prueba) {
        $("#modal-pruebas-delete").modal();
        $scope.dataPrueba = prueba;
    }

    $scope.eliminar = function (dataPrueba) {
        // console.log(dataPrueba)
        var prueba = new Object();
        prueba.id = dataPrueba.id;
        prueba.user = $scope.user.user;
        prueba.token = $scope.user.data.token;
        pruebasServices.eliminar(prueba).then(function () {
            $scope.response = pruebasServices.response;
            $("#modal-pruebas-delete").modal("hide");
            $scope.listar($scope.dataQuery);
        });
    }


    $scope.crearPruebas = function (prueba) {
        $sessionStorage.prueba = prueba;
        $window.location.href = '#/paciente/pruebas/create';
    }

    $scope.getMedico = function (id) {
        if ($scope.medicos.length == 0) {
            return "";
        } else {
            var medicos = $scope.medicos;
            var medico = "";
            medicos.forEach(element => {
                if (element.id == id) {
                    medico = element.nombre
                }
            });
        }
        return medico;
    }


}])
