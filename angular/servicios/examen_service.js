var app = angular.module('facturacionApp.examenServices',[])

app.factory('examenServices', ['$http','$q','$rootScope', function($http,$q,$rootScope){


var self ={
				listar : function(){
					var d = $q.defer();
				
                    $http({
                      method: 'GET',
					  	url: 'http://192.168.1.8/LabVosAndes/api/public/examen/testList/',
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