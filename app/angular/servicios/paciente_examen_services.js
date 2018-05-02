var app = angular.module('facturacionApp.pacientesExamenServices', [])

app.factory('pacientesExamenServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {


	var self = {

		insertarExamen: function (datos) {
			var d = $q.defer();
			console.log(datos);
			$http({
				method: 'POST',
				url: PATH + 'public/examen/insertTest/',
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

		insertarTipo: function (datos) {
			var d = $q.defer();
			$http({
				method: 'POST',
				url: PATH + 'public/examen/insertType/',
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


		listarMedicos: function () {
			var d = $q.defer();

			$http({
				method: 'GET',
				url: PATH + 'api/public/medico/',
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
		listarExamenes: function (id) {
			var d = $q.defer();
			console.log(id)
			$http({
				method: 'GET',
				url: PATH + 'api/public/examen/' + id + '/listaExamenes/',
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