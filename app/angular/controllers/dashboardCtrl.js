var app = angular.module('vosandesApp.dashboardCtrl', []);

// controlador clientes
app.controller('dashboardCtrl', ['$scope','$sessionStorage', function($scope,$sessionStorage){
	
	$scope.activar('Mdashboard','', 'Inicio', 'Datos')
	
	var user = sessionStorage.getItem('user');
	var user = JSON.parse(user)
	console.log(user.user)
	$scope.user = user;
	
}])