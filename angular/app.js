var app = angular.module( 'facturacionApp',[ 
		'ngRoute','jcs-autoValidate',
		'facturacionApp.configuracion',
		'facturacionApp.mensajes',
		'facturacionApp.notificaciones',
		'facturacionApp.pacientesCtrl',
		'facturacionApp.medicosCtrl',
		'facturacionApp.dashboardCtrl',
		'facturacionApp.informeCtrl',
		'facturacionApp.pacientesServices',
		'facturacionApp.medicosServices',
		'facturacionApp.informeServices'
		]);


angular.module('jcs-autoValidate')
.run([
	'defaultErrorMessageResolver',
	function (defaultErrorMessageResolver){
		defaultErrorMessageResolver.setI18nFileRootPath('angular/lib');
		defaultErrorMessageResolver.setCulture('es-co');
	}
]);

app.controller('mainCtrl', ['$scope', 'Configuracion','Mensajes', 'Notificaciones', function($scope, Configuracion,Mensajes, Notificaciones){
	
	$scope.config = {};
	$scope.mensajes = Mensajes.mensajes;
	$scope.notificaciones = Notificaciones.notificaciones;

	$scope.titulo = "";
	$scope.subtitulo = "";

	//console.log( $scope.notificaciones );

	$scope.usuario = {
		nombre:"Benjamin Castillo"
	}




	Configuracion.cargar().then( function(){
		$scope.config = Configuracion.config;
	});


	$scope.activar = function(menu, submenu, titulo, subtitulo){
		$scope.Mdashboard = "";
		$scope.Mpaciente  = "";
		$scope.Mmedico    = "";

		$scope[menu] = 'active';
		$scope.titulo = titulo;
		$scope.subtitulo = subtitulo;

	}



}]);


// ================================================
//   Rutas
// ================================================
app.config([ '$routeProvider', function($routeProvider){

	$routeProvider
		.when('/',{
			templateUrl: 'dashboard/dashboard.html',
			controller: 'dashboardCtrl'
		})
		.when('/paciente/:pag',{
			templateUrl: 'paciente/paciente.html',
			controller : 'pacientesCtrl'
		})
		.when('/medico/:pag',{
			templateUrl: 'medico/medico.html',
			controller : 'medicosCtrl'
		})
		.when('/biometria/:pag',{
			templateUrl: 'examen/biometria.html',
			controller : 'biometriaCtrl'
		})
		.when('/examen_general/:pag',{
			templateUrl: 'examen/examen_general.html',
			controller : 'examen_generalCtrl'
		})
		.when('/informe/:pag',{
			templateUrl: 'examen/informe.html',
			controller : 'informeCtrl'
		})
		.when('/reaccion_widal/:pag',{
			templateUrl: 'examen/reaccion_widal.html',
			controller : 'reaccionCtrl'
		})
		.otherwise({
			redirectTo: '/'
		})

}]);


// ================================================
//   Filtros
// ================================================
app.filter( 'quitarletra', function(){

	return function(palabra){
		if( palabra ){
			if( palabra.length > 1)
				return palabra.substr(1);
			else
				return palabra;
		}
	}
})

.filter( 'mensajecorto', function(){

	return function(mensaje){
		if( mensaje ){
			if( mensaje.length > 35)
				return mensaje.substr(0,35) + "...";
			else
				return mensaje;
		}
	}
})








