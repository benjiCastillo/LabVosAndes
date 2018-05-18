var app = angular.module('vosandesApp.createpruebasCtrl', []);

app.controller('createpruebasCtrl', ['$scope', '$routeParams', '$window',
    'pruebasServices', 'medicosServices', '$sessionStorage',
    'biometriaServices', 'cultivosServices', 'espermogramasServices',
    'examenGeneralServices', 'hormonasServices', 'informeServices',
    'liquidoSinovialServices', 'microbiologiaServices', 'parasitologiaServices',
    'quimicaSanguineaServices', 'reaccionwServices', 'serologiaServices',
    function ($scope, $routeParams, $window,
        pruebasServices, medicosServices, $sessionStorage,
        biometriaServices, cultivosServices, espermogramasServices,
        examenGeneralServices, hormonasServices, informeServices,
        liquidoSinovialServices, microbiologiaServices, parasitologiaServices,
        quimicaSanguineaServices, reaccionwServices, serologiaServices) {

        var user = sessionStorage.getItem('user');
        user = JSON.parse(user)
        $scope.user = user;
        $scope.paciente = $sessionStorage.paciente;
        $scope.prueba = $sessionStorage.prueba;
        $scope.dataQuery = new Object();
        $scope.dataQueryMed = new Object();
        $scope.loadData = false;
        $scope.notData = false;
        $notMedico = true;

        $scope.dataQuery.user = $scope.user;
        $scope.dataQuery.paciente = $scope.paciente;
        $scope.dataQueryMed.user = $scope.user.user;
        $scope.dataQueryMed.token = $scope.user.data.token
        $scope.dataQueryMed.prueba_id = $scope.prueba.id;

        $scope.crearPruebas = function (prueba) {
            $window.location.href = '#/paciente/pruebas/create/' + prueba;
        }

        $scope.getBiometria = function () {
            console.log($scope.dataQueryMed)
            biometriaServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseBiometria = biometriaServices.response;
                console.log($scope.responseBiometria.data);
                if ($scope.responseBiometria.data != null) {
                    document.getElementById("card-biometria").style.background = "#00a65a";
                    document.getElementById("card-biometria").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getBiometria();

        $scope.getCultivos = function () {
            console.log($scope.dataQueryMed)
            cultivosServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseCultivos = cultivosServices.response;
                console.log($scope.responseCultivos.data);
                if ($scope.responseCultivos.data != null) {
                    document.getElementById("card-cultivos").style.background = "#00a65a";
                    document.getElementById("card-cultivos").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getCultivos();

        $scope.getEspermogramas = function () {
            console.log($scope.dataQueryMed)
            espermogramasServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseEspermo = espermogramasServices.response;
                console.log($scope.responseEspermo.data);
                if ($scope.responseEspermo.data != null) {
                    document.getElementById("card-espermograma").style.background = "#00a65a";
                    document.getElementById("card-espermograma").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getEspermogramas();

        $scope.getExamenGeneral = function () {
            console.log($scope.dataQueryMed)
            examenGeneralServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseExamen = examenGeneralServices.response;
                console.log($scope.responseExamen.data);
                if ($scope.responseExamen.data != null) {
                    document.getElementById("card-examen-general").style.background = "#00a65a";
                    document.getElementById("card-examen-general").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getExamenGeneral();

        $scope.getHormonas = function () {
            console.log($scope.dataQueryMed)
            hormonasServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseHormonas = hormonasServices.response;
                console.log($scope.responseHormonas.data);
                if ($scope.responseHormonas.data != null) {
                    document.getElementById("card-hormonas").style.background = "#00a65a";
                    document.getElementById("card-hormonas").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getHormonas();

        $scope.getInformes = function () {
            console.log($scope.dataQueryMed)
            informeServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseInformes = informeServices.response;
                console.log($scope.responseInformes.data);
                if ($scope.responseInformes.data != null) {
                    document.getElementById("card-informe").style.background = "#00a65a";
                    document.getElementById("card-informe").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getInformes();

        $scope.getSinovial = function () {
            console.log($scope.dataQueryMed)
            liquidoSinovialServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseSinovial = liquidoSinovialServices.response;
                console.log($scope.responseSinovial.data);
                if ($scope.responseSinovial.data != null) {
                    document.getElementById("card-liquido-sinovial").style.background = "#00a65a";
                    document.getElementById("card-liquido-sinovial").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getSinovial();

        $scope.getMicrobiologia = function () {
            console.log($scope.dataQueryMed)
            microbiologiaServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseMicro = microbiologiaServices.response;
                console.log($scope.responseMicro.data);
                if ($scope.responseMicro.data != null) {
                    document.getElementById("card-microbiologia").style.background = "#00a65a";
                    document.getElementById("card-microbiologia").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getMicrobiologia();

        $scope.getParasitologia = function () {
            console.log($scope.dataQueryMed)
            parasitologiaServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseParasito = parasitologiaServices.response;
                console.log($scope.responseParasito.data);
                if ($scope.responseParasito.data != null) {
                    document.getElementById("card-parasitologia").style.background = "#00a65a";
                    document.getElementById("card-parasitologia").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getParasitologia();

        $scope.getQuimica = function () {
            console.log($scope.dataQueryMed)
            quimicaSanguineaServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseQuimica = quimicaSanguineaServices.response;
                console.log($scope.responseQuimica.data);
                if ($scope.responseQuimica.data != null) {
                    document.getElementById("card-quimica-sanguinea").style.background = "#00a65a";
                    document.getElementById("card-quimica-sanguinea").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getQuimica();

        $scope.getReaccion = function () {
            console.log($scope.dataQueryMed)
            reaccionwServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseReaccion = reaccionwServices.response;
                console.log($scope.responseReaccion.data);
                if ($scope.responseReaccion.data != null) {
                    document.getElementById("card-reaccion-widal").style.background = "#00a65a";
                    document.getElementById("card-reaccion-widal").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getReaccion();

        $scope.getSerologia = function () {
            console.log($scope.dataQueryMed)
            serologiaServices.listar($scope.dataQueryMed).then(function () {
                $scope.responseSerologia = serologiaServices.response;
                console.log($scope.responseSerologia.data);
                if ($scope.responseSerologia.data != null) {
                    document.getElementById("card-serologia").style.background = "#00a65a";
                    document.getElementById("card-serologia").style.color = "#ffff";
                    console.log("existen biometria")
                }

            });
        }

        $scope.getSerologia();

    }])
