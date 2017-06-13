var app = angular.module('facturacionApp.pacientesServices',[])

app.factory('pacientesServices', ['$http','$q','$rootScope', function($http,$q,$rootScope){


var self ={

				insertar : function(datos){
					var d = $q.defer();
					console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://192.168.1.14/vos_andes/api/public/paciente/',
                        // url: 'http://localhost/gitgrad/APIPOLLO/public/observation/read/',
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
				logIn : function(datos){
					var d = $q.defer();
					console.log(datos);
                    $http({
                      method: 'POST',
					  	url: 'http://192.168.1.14/Web/jscrum/api/public/usuario/login/',
                        // url: 'http://localhost/gitgrad/APIPOLLO/public/observation/read/',
                        data:{
								_login:datos.login,
								_password:datos.password
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
				listar : function(){
					var d = $q.defer();
				
                    $http({
                      method: 'GET',
					  	url: 'http://192.168.1.14/vos_andes/api/public/paciente/',
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
                      method: 'POST',
					  	url: 'http://192.168.1.14/Web/jscrum/api/public/usuario/rol/',
						  data:{
								_id:user.id,
								_rol:user.rol
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
					  	url: 'http://192.168.1.14/vos_andes/api/public/paciente/'+user.id
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
					
				// listar : function(){
				// 	var doc = 2;
				// 	var d = $q.defer()
                //     $http({
                //       method: 'POST',
				// 	  	url: 'http://192.168.1.11/Web/gitgrad/api/public/observation/read/',
                //         // url: 'http://localhost/gitgrad/APIPOLLO/public/observation/read/',
                //         data:{'id':doc}
                //     	})
                //         .then(function successCallback(response) {
                //                 // ok
                //                 self.cargado		= true;
    			// 				self.cargando		= false;
				// 				self.comentarios 	= response.data;
								
				// 				return d.resolve()	
                //             }, function errorCallback(response) {
                //             // ko
                //             	return d.resolve()	
                //                 self.cargado		= true;
    			// 				self.cargando		= false;
				// 				self.comentarios 	= response.data
                //         });
                //        return d.promise;	 
	
				// },					
				// eliminar : function(id){
				// 	var d = $q.defer()
                //     $http({
                //       method: 'DELETE',
				// 	  	url: 'http://192.168.1.11/Web/gitgrad/api/public/observation/'+id,
                //         // url: 'http://localhost/gitgrad/APIPOLLO/public/observation/read/',
                //     	})
                //         .then(function successCallback(response) {
                //                 // ok
				// 				self.response 	= response.data;
								
				// 				self.listar()
				// 				return d.resolve()	
                //             }, function errorCallback(response) {
                //             // ko
				// 				self.response 	= response.data;
                //             	return d.resolve()	
                //         });
                //        return d.promise;
				// 	}	

	}


	return self;
}])