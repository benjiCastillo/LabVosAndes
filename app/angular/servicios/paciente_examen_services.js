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