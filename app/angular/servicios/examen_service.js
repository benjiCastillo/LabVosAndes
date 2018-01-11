var app = angular.module('facturacionApp.examenServices', [])

app.factory('examenServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {


	var self = {
		listar: function () {
			var d = $q.defer();

			$http({
				method: 'GET',
				url: 'http://localhost/LabVosAndes/api/public/examen/listalltest/',
			})
				.then(function successCallback(response) {
					self.response = response.data;
					return d.resolve()
				}, function errorCallback(response) {
					// ko
					return d.resolve()
					self.response = response.data
				});
			return d.promise;
		}
	}
	return self;
}])