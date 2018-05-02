var app = angular.module('facturacionApp.pacientesServices',[])

app.factory('pacientesServices', ['$http','$q','$rootScope', function($http,$q,$rootScope){


var self ={

				insertar : function(datos){
					var d = $q.defer();
					console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://localhost/~edev/LabVosAndes/api/public/paciente/',
                        // url: 'http://localhost/~edev/gitgrad/APIPOLLO/public/observation/read/',
                        data:{
								_nombre:datos.nombre,
								_apellidos:datos.apellidos,
								_edad:datos.edad,
								_sexo:datos.sexo
						}
                    	})
                        .then(function successCallback(response) {
                                // ok
                                // self.cargado		= true;
    							// self.cargando		= false;
								self.response 	= response.data;
								// console.log("Service"+response);
								return d.resolve()	
                            }, function errorCallback(response) {
								
								self.response 	= response.data
								return d.resolve();
                        });
                       return d.promise;	 
	
				},
				listar : function(){
					var d = $q.defer();
				
                    $http({
                      method: 'GET',
					  	url: 'http://localhost/~edev/LabVosAndes/api/public/paciente/',
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
				modificar : function(user){
					var d = $q.defer();
				
                    $http({
                      method: 'PUT',
					  	url: 'http://localhost/~edev/LabVosAndes/api/public/paciente/'+user.id,
						  data:{
								nombre:user.nombre,
								apellidos:user.apellidos,
								edad:user.edad,
								sexo:user.sexo
						}
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
				eliminar : function(user){
					var d = $q.defer();
				
                    $http({
                      method: 'DELETE',
					  	url: 'http://localhost/~edev/LabVosAndes/api/public/paciente/'+user.id
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
				}	   
					

	}


	return self;
}])