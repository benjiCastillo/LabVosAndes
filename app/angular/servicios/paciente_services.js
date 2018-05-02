var app = angular.module('facturacionApp.pacientesServices', [])

app.factory('pacientesServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {


	var self = {

		insertar: function (datos) {
			var d = $q.defer();
			console.log(datos);
			$http({
				method: 'POST',
				url: PATH+'public/paciente/',
				data: datos
			})
				.then(function successCallback(response) {
					self.response = response.data;
					return d.resolve()
				}, function errorCallback(response) {

					self.response = response.data
					return d.resolve();
				});
			return d.promise;

		},
		listar: function () {
			var d = $q.defer();

			$http({
				method: 'GET',
				url: PATH+'public/paciente/',
			})
				.then(function successCallback(response) {
					self.response = response.data;

					return d.resolve()
				}, function errorCallback(response) {
					return d.resolve()
					self.response = response.data
				});
			return d.promise;

		},
		modificar: function (user) {
			var d = $q.defer();

			$http({
				method: 'PUT',
				url: PATH+'public/paciente/' + user.id,
				data: user
			})
				.then(function successCallback(response) {
					self.response = response.data;

					return d.resolve()
				}, function errorCallback(response) {
					return d.resolve()
					self.response = response.data
				});
			return d.promise;
		},
		eliminar: function (user) {
			var d = $q.defer();

			$http({
				method: 'DELETE',
				url: PATH+'public/paciente/' + user.id
			})
				.then(function successCallback(response) {
					self.response = response.data;
					return d.resolve()
				}, function errorCallback(response) {
					return d.resolve()
					self.response = response.data
				});
			return d.promise;
		}


	}


	return self;
}])