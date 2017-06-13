var app = angular.module('facturacionApp.medicosServices',[])

app.factory('medicosServices', ['$http','$q','$rootScope', function($http,$q,$rootScope){


var self ={

				insertar : function(datos){
					var d = $q.defer();
					console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://192.168.1.2/LabVosAndes/api/public/medico/',
                        // url: 'http://localhost/gitgrad/APIPOLLO/public/observation/read/',
                        data:{
								nombre:datos.nombre,
								apellidos:datos.apellidos
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
					  	url: 'http://192.168.1.2/LabVosAndes/api/public/medico/',
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
					  	url: 'http://192.168.1.2/LabVosAndes/api/public/medico/'+user.id,
						  data:{
								nombre:user.nombre,
								apellidos:user.apellidos
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
					  	url: 'http://192.168.1.2/LabVosAndes/api/public/medico/'+user.id
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