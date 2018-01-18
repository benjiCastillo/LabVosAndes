var app = angular.module('facturacionApp.pacientesExamenServices', [])

app.factory('pacientesExamenServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {


	var self = {

		insertarExamen: function (datos) {
			var d = $q.defer();
			console.log(datos);
			$http({
				method: 'POST',
				url: 'http://localhost/LabVosAndes/api/public/examen/insertTest/',
				data: {
					_id_medico: datos.id_medico,
					_id_paciente: datos.id_paciente
				}
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
			// console.log(datos);
			$http({
				method: 'POST',
				url: 'http://localhost/LabVosAndes/api/public/examen/insertType/',
				data: {
					_id_examen: datos.id_examen,
					_tipo: datos.tipo,
					_id_tipo: datos.id_tipo
				}
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
				url: 'http://localhost/LabVosAndes/api/public/medico/',
			})
				.then(function successCallback(response) {
					// ok
					// self.cargado		= true;

					self.response = response.data;

					return d.resolve()
				}, function errorCallback(response) {
					// ko
					return d.resolve()
					// self.cargado		= true;
					// self.cargando		= false;
					self.response = response.data
				});
			return d.promise;

		},
		listarExamenes: function (id) {
			var d = $q.defer();
			console.log(id)
			$http({
				method: 'GET',
				url: 'http://localhost/LabVosAndes/api/public/examen/' + id + '/listaExamenes/',
			})
				.then(function successCallback(response) {
					self.response = response.data;

					return d.resolve()
				}, function errorCallback(response) {
					// ko
					return d.resolve()
					// self.cargado		= true;
					// self.cargando		= false;
					self.response = response.data
				});
			return d.promise;
		}

	}


	return self;
}])