var app = angular.module('facturacionApp.pacientesExamenServices',[])

app.factory('pacientesExamenServices', ['$http','$q','$rootScope', function($http,$q,$rootScope){


var self ={

				insertarExamen : function(datos){
					var d = $q.defer();
					console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://localhost/LabVosAndes/api/public/examen/insertTest/',
                        data:{
								_id_medico:datos.id_medico,
								_id_paciente:datos.id_paciente
						}
                    	})
                        .then(function successCallback(response) {
								self.response 	= response.data;
								return d.resolve()	
                            }, function errorCallback(response) {	
								self.response 	= response.data
								return d.resolve();
                        });
                       return d.promise;	 
	
				},
				insertarInforme : function(datos){
					var d = $q.defer();
					console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://localhost/LabVosAndes/api/public/informesg/insertReport/',
                        data:{
								_nombre:datos.nombre,
								_contenido:datos.informe
						}
                    	})
                        .then(function successCallback(response) {
								self.response 	= response.data;
								return d.resolve()	
                            }, function errorCallback(response) {	
								self.response 	= response.data
								return d.resolve();
                        });
                       return d.promise;	 
	
				},
				insertarTipo : function(datos){
					var d = $q.defer();
					// console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://localhost/LabVosAndes/api/public/examen/insertType/',
                        data:{
								_id_examen:datos.id_examen,
								_tipo:datos.tipo,
								_id_tipo:datos.id_tipo
						}
                    	})
                        .then(function successCallback(response) {
								self.response 	= response.data;
								return d.resolve()	
                            }, function errorCallback(response) {	
								self.response 	= response.data
								return d.resolve();
                        });
                       return d.promise;	 

				},
				insertarExamenGeneral : function(datos){
					var d = $q.defer();
					// console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://localhost/LabVosAndes/api/public/examengeneral/insertGeneralTest/',
                        data:{
								_color:datos.color,
								_cantidad:datos.cantidad,
								_olor:datos.olor,
								_aspecto:datos.aspecto,
								_espuma:datos.espuma,
								_sedimento:datos.sedimento,
								_densidad:datos.densidad,
								_reaccion:datos.reaccion,
								_proteinas:datos.proteinas,
								_glucosa:datos.glucosa,
								_cetona:datos.cetona,
								_bilirrubina:datos.bilirrubina,
								_sangre:datos.sangre,
								_nitritos:datos.nitritos,
								_urubilinogeno:datos.urubilinogeno,
								_eritrocitos:datos.eritocito,
								_piocitos:datos.piocitos,
								_leucocitos:datos.leucocitos,
								_cilindros:datos.cilindros,
								_celulas:datos.celulas,
								_cristales:datos.cristales,
								_otros:datos.otros1,
								_exa_bac_sed:datos.otros2
						}
                    	})
                        .then(function successCallback(response) {
								self.response 	= response.data;
								return d.resolve()	
                            }, function errorCallback(response) {	
								self.response 	= response.data
								return d.resolve();
                        });
                       return d.promise;	 
	
				},
				insertarBiometria : function(datos){
					var d = $q.defer();
					// console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://localhost/LabVosAndes/api/public/biometria/insertBio/',
                        data:{
								_hematies:datos.hematies,
								_hematocrito:datos.hematocrito,
								_hemoglobina:datos.hemoglobina,
								_leucocitos:datos.leucocito,
								_vsg:datos.vsg,
								_vcm:datos.vcm,
								_hbcm:datos.hbcm,
								_chbcm:datos.chbcm,
								_comentario_hema:datos.comentario1,
								_cayados:datos.cayados,
								_neutrofilos:datos.neutrofilos,
								_basofilo:datos.basofilo,
								_eosinofilo:datos.eosinofilo,
								_linfocito:datos.linfocito,
								_monocito:datos.monocito,
								_prolinfocito:datos.prolinfocito,
								_cel_inmaduras:datos.celinmaduras,
								_comentario_leuco:datos.comentario2
						}
                    	})
                        .then(function successCallback(response) {
								self.response 	= response.data;
								return d.resolve()	
                            }, function errorCallback(response) {	
								self.response 	= response.data
								return d.resolve();
                        });
                       return d.promise;	 
	
				},
				insertarReaccion : function(datos){
					var d = $q.defer();
					// console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://localhost/LabVosAndes/api/public/reaccionw/',
                        data:{
								_paraA1:datos.pA20,
								_paraA2:datos.pA40,
								_paraA3:datos.pA80,
								_paraA4:datos.pA160,
								_paraA5:datos.pA320,
								_paraA6:datos.pA400,
								_paraB1:datos.pB20,
								_paraB2:datos.pB40,
								_paraB3:datos.pB80,
								_paraB4:datos.pB160,
								_paraB5:datos.pB320,
								_paraB6:datos.pB400,
								_somaticoO1:datos.s20,
								_somaticoO2:datos.s40,
								_somaticoO3:datos.s80,
								_somaticoO4:datos.s160,
								_somaticoO5:datos.s320,
								_somaticoO6:datos.s400,
								_flagelarH1:datos.f20,
								_flagelarH2:datos.f40,
								_flagelarH3:datos.f80,
								_flagelarH4:datos.f160,
								_flagelarH5:datos.f320,
								_flagelarH6:datos.f400,
								_comentario:datos.comentario
						}
                    	})
                        .then(function successCallback(response) {
								self.response 	= response.data;
								return d.resolve()	
                            }, function errorCallback(response) {	
								self.response 	= response.data
								return d.resolve();
                        });
                       return d.promise;	 
	
				},
				listarMedicos : function(){
						var d = $q.defer();
				
                    $http({
                      method: 'GET',
					  	url: 'http://localhost/LabVosAndes/api/public/medico/',
                    	})
                        .then(function successCallback(response) {
                                // ok
                                // self.cargado		= true;
    							// self.cargando		= false;
								self.response 	= response.data;
								
								return d.resolve()	
                            }, function errorCallback(response) {
                            // ko
                            	return d.resolve()	
                                // self.cargado		= true;
    							// self.cargando		= false;
								self.response 	= response.data
                        });
                       return d.promise;	
	
				},
				listarExaPac : function(id){
						var d = $q.defer();
						console.log(id)
                    $http({
                      method: 'GET',
					  	url: 'http://localhost/LabVosAndes/api/public/examen/listExamenPaciente/'+id,
                    	})
                        .then(function successCallback(response) {

								self.response 	= response.data;
								
								return d.resolve()	
                            }, function errorCallback(response) {

                            	return d.resolve()	

								self.response 	= response.data
                        });
                       return d.promise;	
				}


	}


	return self;
}])