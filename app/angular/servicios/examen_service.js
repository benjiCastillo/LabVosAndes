var app = angular.module('facturacionApp.examenServices', [])

app.factory('examenServices', ['$http', '$q', '$rootScope', function ($http, $q, $rootScope) {

	var self = {
		listar: function (id) {
			var d = $q.defer();

			$http({
				method: 'GET',
				url: PATH+'api/public/examen/'+id+'/examenesPaciente/',
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
		},
		insertarInforme: function (datos) {
			var d = $q.defer();
			console.log(datos);
			$http({
				method: 'POST',
				url: PATH+'api/public/informesg/',
				data: {
					_nombre: datos.nombre,
					_contenido: datos.informe,
					_id_examen:datos.id_examen
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
		insertarExamenGeneral: function (datos) {
			var d = $q.defer();
			console.log(datos);
			$http({
				method: 'POST',
				url: PATH+'api/public/examengeneral/',
				data: {
					_color: datos.color,
					_cantidad: datos.cantidad,
					_olor: datos.olor,
					_aspecto: datos.aspecto,
					_espuma: datos.espuma,
					_sedimento: datos.sedimento,
					_densidad: datos.densidad,
					_reaccion: datos.reaccion,
					_proteinas: datos.proteinas,
					_glucosa: datos.glucosa,
					_cetona: datos.cetona,
					_bilirrubina: datos.bilirrubina,
					_sangre: datos.sangre,
					_nitritos: datos.nitritos,
					_urubilinogeno: datos.urubilinogeno,
					_eritrocitos: datos.eritocito,
					_piocitos: datos.piocitos,
					_leucocitos: datos.leucocitos,
					_cilindros: datos.cilindros,
					_celulas: datos.celulas,
					_cristales: datos.cristales,
					_otros: datos.otros1,
					_exa_bac_sed: datos.otros2,
					_id_examen:datos.id_examen
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
		insertarBiometria: function (datos) {
			var d = $q.defer();
			console.log(datos);
			$http({
				method: 'POST',
				url: PATH+'api/public/biometria/',
				data: {
					_hematies: datos.hematies,
					_hematocrito: datos.hematocrito,
					_hemoglobina: datos.hemoglobina,
					_leucocitos: datos.leucocito,
					_vsg: datos.vsg,
					_vcm: datos.vcm,
					_hbcm: datos.hbcm,
					_chbcm: datos.chbcm,
					_comentario_hema: datos.comentario1,
					_cayados: datos.cayados,
					_neutrofilos: datos.neutrofilos,
					_basofilo: datos.basofilo,
					_eosinofilo: datos.eosinofilo,
					_linfocito: datos.linfocito,
					_monocito: datos.monocito,
					_prolinfocito: datos.prolinfocito,
					_cel_inmaduras: datos.celinmaduras,
					_comentario_leuco: datos.comentario2,
					_id_examen:datos.id_examen
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
		insertarReaccion: function (datos) {
			var d = $q.defer();
			// console.log(datos);
			$http({
				method: 'POST',
				url: PATH+'api/public/reaccionw/',
				data: {
					_paraA1: datos.pA20,
					_paraA2: datos.pA40,
					_paraA3: datos.pA80,
					_paraA4: datos.pA160,
					_paraA5: datos.pA320,
					_paraA6: datos.pA400,
					_paraB1: datos.pB20,
					_paraB2: datos.pB40,
					_paraB3: datos.pB80,
					_paraB4: datos.pB160,
					_paraB5: datos.pB320,
					_paraB6: datos.pB400,
					_somaticoO1: datos.s20,
					_somaticoO2: datos.s40,
					_somaticoO3: datos.s80,
					_somaticoO4: datos.s160,
					_somaticoO5: datos.s320,
					_somaticoO6: datos.s400,
					_flagelarH1: datos.f20,
					_flagelarH2: datos.f40,
					_flagelarH3: datos.f80,
					_flagelarH4: datos.f160,
					_flagelarH5: datos.f320,
					_flagelarH6: datos.f400,
					_comentario: datos.comentario,
					_id_examen:datos.id_examen
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
		listarInforme: function (id) {
			var d = $q.defer();
			console.log(id)
			$http({
				method: 'GET',
				url: PATH+'api/public/informesg/' + id,
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
		editarInforme: function (data) {
			var d = $q.defer();

			$http({
				method: 'PUT',
				url: PATH+'api/public/informesg/' + data.id,
				data: {
					nombre: data.nombre,
					contenido: data.contenido
				}
			})
				.then(function successCallback(response) {
					// ok
					// self.cargado		= true;
					// self.cargando		= false;
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
		eliminarInforme: function (user) {
			var d = $q.defer();

			$http({
				method: 'DELETE',
				url: PATH+'api/public/informesg/' + user.id + '/' + user.titulo
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
		listarBio: function (id) {
			var d = $q.defer();
			console.log(id)
			$http({
				method: 'GET',
				url: PATH+'api/public/biometria/' + id,
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
		editarBio: function (data) {
			var d = $q.defer();

			$http({
				method: 'PUT',
				url: PATH+'api/public/biometria/' + data.id,
				data: {
					hematies: data.hematies,
					hematocrito: data.hematocrito,
					hemoglobina: data.hemoglobina,
					leucocitos: data.leucocitos,
					vsg: data.vsg,
					vcm: data.vcm,
					hbcm: data.hbcm,
					chbcm: data.chbcm,
					comentario_hema: data.comentario_hema,
					cayados: data.cayados,
					neutrofilos: data.neutrofilos,
					basofilo: data.basofilo,
					eosinofilo: data.eosinofilo,
					linfocito: data.linfocito,
					monocito: data.monocito,
					prolinfocito: data.prolinfocito,
					cel_inmaduras: data.cel_inmaduras,
					comentario_leuco: data.comentario_leuco

				}
			})
				.then(function successCallback(response) {
					// ok
					// self.cargado		= true;
					// self.cargando		= false;
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
		eliminarBiometria: function (user) {
			var d = $q.defer();

			$http({
				method: 'DELETE',
				url: PATH+'api/public/biometria/' + user.id
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
		listarGen: function (id) {
			var d = $q.defer();
			console.log(id)
			$http({
				method: 'GET',
				url: PATH+'api/public/examengeneral/' + id,
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
		editarGeneral: function (data) {
			var d = $q.defer();

			$http({
				method: 'PUT',
				url: PATH+'api/public/examengeneral/' + data.id,
				data: {
					color: data.color,
					cantidad: data.cantidad,
					olor: data.olor,
					aspecto: data.aspecto,
					espuma: data.espuma,
					sedimento: data.sedimento,
					densidad: data.densidad,
					reaccion: data.reaccion,
					proteinas: data.proteinas,
					glucosa: data.glucosa,
					cetona: data.cetona,
					bilirrubina: data.bilirrubina,
					nitritos: data.nitritos,
					urubilinogeno: data.urubilinogeno,
					eritrocitos: data.eritrocitos,
					piocitos: data.piocitos,
					leucocitos: data.leucocitos,
					sangre: data.sangre,
					cilindros: data.cilindros,
					celulas: data.celulas,
					cristales: data.cristales,
					otros: data.otros,
					exa_bac_sed: data.exa_bac_sed

				}
			})
				.then(function successCallback(response) {
					// ok
					// self.cargado		= true;
					// self.cargando		= false;
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
		eliminarGeneral: function (user) {
			var d = $q.defer();

			$http({
				method: 'DELETE',
				url: PATH+'api/public/examengeneral/' + user.id
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
		eliminarReaccion: function (user) {
			var d = $q.defer();

			$http({
				method: 'DELETE',
				url: PATH+'api/public/reaccionw/' + user.id
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
		listarRea: function (id) {
			var d = $q.defer();
			console.log(id)
			$http({
				method: 'GET',
				url: PATH+'api/public/reaccionw/' + id,
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
		editarReaccion: function (data) {
			var d = $q.defer();

			$http({
				method: 'PUT',
				url: PATH+'api/public/reaccionw/' + data.id,
				data: {
					paraA1: data.paraA1,
					paraA2: data.paraA2,
					paraA3: data.paraA3,
					paraA4: data.paraA4,
					paraA5: data.paraA5,
					paraA6: data.paraA6,
					paraB1: data.paraB1,
					paraB2: data.paraB2,
					paraB3: data.paraB3,
					paraB4: data.paraB4,
					paraB5: data.paraB5,
					paraB6: data.paraB6,
					somaticoO1: data.somaticoO1,
					somaticoO2: data.somaticoO2,
					somaticoO3: data.somaticoO3,
					somaticoO4: data.somaticoO4,
					somaticoO5: data.somaticoO5,
					somaticoO6: data.somaticoO6,
					flagelarH1: data.flagelarH1,
					flagelarH2: data.flagelarH2,
					flagelarH3: data.flagelarH3,
					flagelarH4: data.flagelarH4,
					flagelarH5: data.flagelarH5,
					flagelarH6: data.flagelarH6,
					comentario: data.comentario

				}
			})
				.then(function successCallback(response) {
					// ok
					// self.cargado		= true;
					// self.cargando		= false;
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