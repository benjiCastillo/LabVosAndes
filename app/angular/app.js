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
	'vosandesApp.pacExaCtrl',
	'vosandesApp.createpruebasCtrl',
	'vosandesApp.pacientesServices',
	'vosandesApp.medicosServices',
	'vosandesApp.informeServices',
	'vosandesApp.pruebasServices',
	'vosandesApp.pacientesExamenServices',
	'angularMoment'

]);


app.controller('mainCtrl', ['$scope', 'Configuracion', 'Mensajes', 'Notificaciones', function ($scope, Configuracion, Mensajes, Notificaciones) {

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
		.when('/biometria/:pag', {
			templateUrl: 'examen/biometria.html',
			controller: 'biometriaCtrl'
		})
		.when('/examen_general/:pag', {
			templateUrl: 'examen/examen_general.html',
			controller: 'examen_generalCtrl'
		})
		.when('/informe/:pag', {
			templateUrl: 'examen/informe.html',
			controller: 'informeCtrl'
		})
		.when('/reaccion_widal/:pag', {
			templateUrl: 'examen/reaccion_widal.html',
			controller: 'reaccionCtrl'
		})
		.when('/examen/:id/:name/:ape/:fecha', {
			templateUrl: 'examen/examen.html',
			controller: 'examenCtrl'
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








