var app = angular.module('facturacionApp.medicosServices', [])

app.factory('medicosServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

	var self = {
		insertar: function (datos) {
			var d = $q.defer();
			$http({
				method: 'POST',
				url: PATH + 'medicos/add',
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
		listar: function (data) {
			var d = $q.defer();

			$http({
				method: 'POST',
				url: PATH + 'medicos/list',
				data: {
					user: data.user,
					token: data.data.token
				}
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
				url: PATH + 'medicos/edit/' + user.id,
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
				method: 'POST',
				url: PATH + 'medicos/delete/' + user.id,
				data:user
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