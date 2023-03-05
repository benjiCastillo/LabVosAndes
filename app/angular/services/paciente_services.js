var app = angular.module('vosandesApp.pacientesServices', [])
console.log(PATH)
app.factory('pacientesServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

	var self = {
		insertar: function (datos) {
			var d = $q.defer();
			$http({
				method: 'POST',
				url: PATH + 'pacientes/add',
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
		listar: function (query) {
			var d = $q.defer();
			var query = encodeQueryData(query);
			$http({
				method: 'GET',
				url: PATH + 'pacientes/list?' + query,
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
		modificar: function (data) {
			var d = $q.defer();
			$http({
				method: 'PUT',
				url: PATH + 'pacientes/edit/' + data.id,
				data: data
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
		eliminar: function (data) {
			var d = $q.defer();
			$http({
				method: 'POST',
				url: PATH + 'pacientes/delete/' + data.id,
				data: data
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
