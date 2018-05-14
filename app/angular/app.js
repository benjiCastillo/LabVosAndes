var app = angular.module('vosandesApp', [
	'ngRoute', 'jcs-autoValidate',
	'vosandesApp.configuracion',
	'vosandesApp.mensajes',
	'vosandesApp.notificaciones',
	'vosandesApp.pacientesCtrl',
	'vosandesApp.medicosCtrl',
	'vosandesApp.dashboardCtrl',
	'vosandesApp.informeCtrl',
	'vosandesApp.pruebasCtrl',
	'vosandesApp.examenGeneralCtrl',
	'vosandesApp.quimicaSanguineaCtrl',
	'vosandesApp.cultivosCtrl',
	'vosandesApp.espermogramasCtrl',
	'vosandesApp.microbiologiaCtrl',
	'vosandesApp.pacExaCtrl',
	'vosandesApp.biometriaCtrl',
	'vosandesApp.createpruebasCtrl',
	'vosandesApp.liquidoSinovialCtrl',
	'vosandesApp.parasitologiaCtrl',
	'vosandesApp.serologiaCtrl',
	'vosandesApp.reaccionwCtrl',
	'vosandesApp.hormonasCtrl',
	'vosandesApp.pacientesServices',
	'vosandesApp.medicosServices',
	'vosandesApp.informeServices',
	'vosandesApp.pruebasServices',
	'vosandesApp.pacientesExamenServices',
	'vosandesApp.biometriaServices',
	'vosandesApp.examenGeneralServices',
	'vosandesApp.quimicaSanguineaServices',
	'vosandesApp.cultivosServices',
	'vosandesApp.espermogramasServices',
	'vosandesApp.informeServices',
	'vosandesApp.liquidoSinovialServices',
	'vosandesApp.microbiologiaServices',
	'vosandesApp.parasitologiaServices',
	'vosandesApp.serologiaServices',
	'vosandesApp.reaccionwServices',
	'vosandesApp.hormonasServices',
	'angularMoment',

]);


app.controller('mainCtrl', ['$scope', 'Configuracion', 'Mensajes', 'Notificaciones','moment', function ($scope, Configuracion, Mensajes, Notificaciones,moment) {
	moment.tz.setDefault("America/La_Paz");
	$scope.config = {};
	$scope.mensajes = Mensajes.mensajes;
	$scope.notificaciones = Notificaciones.notificaciones;

	$scope.titulo = "";
	$scope.subtitulo = "";

	var user = sessionStorage.getItem('user');
	var user = JSON.parse(user)
	console.log(user.user)
	$scope.user = user;

	Configuracion.cargar().then(function () {
		$scope.config = Configuracion.config;
	});
	


	$scope.activar = function (menu, submenu, titulo, subtitulo) {
		$scope.Mdashboard = "";
		$scope.Mpaciente = "";
		$scope.Mmedico = "";

		$scope[menu] = 'active';
		$scope.titulo = titulo;
		$scope.subtitulo = subtitulo;

	}



}]);


// ================================================
//   Rutas
// ================================================
app.config(['$routeProvider', function ($routeProvider) {

	$routeProvider
		.when('/', {
			templateUrl: 'dashboard/dashboard.html',
			controller: 'dashboardCtrl'
		})
		.when('/paciente/', {
			templateUrl: 'paciente/paciente.html',
			controller: 'pacientesCtrl'
		})
		.when('/paciente/pruebas/', {
			templateUrl: 'pruebas/pruebas.html',
			controller: 'pruebasCtrl'
		})
		.when('/paciente/pruebas/create', {
			templateUrl: 'create-pruebas/create-pruebas.html',
			controller: 'createpruebasCtrl'
		})
		.when('/medico/:pag', {
			templateUrl: 'medico/medico.html',
			controller: 'medicosCtrl'
		})
		.when('/paciente/pruebas/create/biometria', {
			templateUrl: 'pruebas-examenes/biometria/biometria.html',
			controller: 'biometriaCtrl'
		})
		.when('/paciente/pruebas/create/examen-general', {
			templateUrl: 'pruebas-examenes/examen-general/examen-general.html',
			controller: 'examenGeneralCtrl'
		})
		.when('/paciente/pruebas/create/quimica-sanguinea', {
			templateUrl: 'pruebas-examenes/quimica-sanguinea/quimica-sanguinea.html',
			controller: 'quimicaSanguineaCtrl'
		})
		.when('/paciente/pruebas/create/cultivos', {
			templateUrl: 'pruebas-examenes/cultivos/cultivos.html',
			controller: 'cultivosCtrl'
		})
		.when('/paciente/pruebas/create/espermogramas', {
			templateUrl: 'pruebas-examenes/espermogramas/espermogramas.html',
			controller: 'espermogramasCtrl'
		})
		.when('/paciente/pruebas/create/informe', {
			templateUrl: 'pruebas-examenes/informe/informe.html',
			controller: 'informeCtrl'
		})
		.when('/paciente/pruebas/create/liquido-sinovial', {
			templateUrl: 'pruebas-examenes/liquido-sinovial/liquido-sinovial.html',
			controller: 'liquidoSinovialCtrl'
		})
		.when('/paciente/pruebas/create/microbiologia', {
			templateUrl: 'pruebas-examenes/microbiologia/microbiologia.html',
			controller: 'microbiologiaCtrl'
		})
		.when('/paciente/pruebas/create/parasitologia', {
			templateUrl: 'pruebas-examenes/parasitologia/parasitologia.html',
			controller: 'parasitologiaCtrl'
		})
		.when('/paciente/pruebas/create/serologia', {
			templateUrl: 'pruebas-examenes/serologia/serologia.html',
			controller: 'serologiaCtrl'
		})
		.when('/paciente/pruebas/create/reaccion-w', {
			templateUrl: 'pruebas-examenes/reaccion-w/reaccion-w.html',
			controller: 'reaccionwCtrl'
		})
		.when('/paciente/pruebas/create/hormonas', {
			templateUrl: 'pruebas-examenes/hormonas/hormonas.html',
			controller: 'hormonasCtrl'
		})
		.otherwise({
			redirectTo: '/'
		})

}]);

app.run(function (amMoment) {
	amMoment.changeLocale('es');
});
// ================================================
//   Filtros
// ================================================
app.directive('ckEditor', function () {
	return {
		require: '?ngModel',
		link: function (scope, elm, attr, ngModel) {
			var ck = CKEDITOR.replace(elm[0]);

			if (!ngModel) return;

			ck.on('pasteState', function () {
				scope.$apply(function () {
					ngModel.$setViewValue(ck.getData());
				});
			});

			ngModel.$render = function (value) {
				ck.setData(ngModel.$viewValue);
			};
		}
	};
});
app.filter('quitarletra', function () {

	return function (palabra) {
		if (palabra) {
			if (palabra.length > 1)
				return palabra.substr(1);
			else
				return palabra;
		}
	}
})




	.filter('mensajecorto', function () {

		return function (mensaje) {
			if (mensaje) {
				if (mensaje.length > 35)
					return mensaje.substr(0, 35) + "...";
				else
					return mensaje;
			}
		}
	})
