var app = angular.module('facturacionApp.dashboardCtrl', []);

// controlador clientes
app.controller('dashboardCtrl', ['$scope','$sessionStorage', function($scope,$sessionStorage){
	
	$scope.activar('Mdashboard','', 'Inicio', 'Datos')
	
	var user = sessionStorage.getItem('user');
	$scope.user = JSON.parse(user);
	
}])