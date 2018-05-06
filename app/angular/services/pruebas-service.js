var app = angular.module('vosandesApp.pruebasServices', [])

app.factory('pruebasServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

	var self = {
		listar: function (data) {
			var d = $q.defer();
			$http({
				method: 'POST',
				url: PATH + 'pruebas/list',
				data: {
					user: data.user.user,
					token: data.user.data.token,
					paciente_id: data.paciente.id
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
		insertar: function (data) {
			console.log(data)
			var d = $q.defer();
			$http({
				method: 'POST',
				url: PATH + 'pruebas/add',
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
				url: PATH + 'pruebas/delete/' + data.id,
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
