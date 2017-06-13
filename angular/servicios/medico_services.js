var app = angular.module('facturacionApp.medicosServices',[])

app.factory('medicosServices', ['$http','$q','$rootScope', function($http,$q,$rootScope){

var self ={
				 guardar: function( medico ){
				 	var d = $q.defer()
					 console.log(medico)
				 	$http.post('api/public/medico/', medico)

				 	.success(function(respuesta){
				 	
				 			self.cargarPagina(self.pag_actual)
				 			d.resolve()	
				 	})		
				 	return d.promise
				 },
				 eliminar: function( medico ){
				 	var d = $q.defer()
					 console.log("este es un medico"+medico)
					 $http.delete('api/public/medico/'+medico)

				 	.success(function(respuesta){
				 	
				 			self.cargarPagina(self.pag_actual)
				 			d.resolve()	
				 				
				 	})
				 	return d.promise
				 },
				editar: function( medico, id ){
				 	var d = $q.defer()

					 $http.put('api/public/medico/'+id,medico)

				 	.success(function(respuesta){
				 	
				 			self.cargarPagina(self.pag_actual)
				 			d.resolve()	
				 				
				 	})
				 	return d.promise
				 },		
				cargarPagina : function(pag){

					var d = $q.defer()
					$http.get('api/public/medico/10/'+pag)	
						.success(function(data){
								//obtener el numero de paginas
								var paginas = self.obtenerPaginas(data); 

    							self.cargado		= true;
    							self.cargando		= false;
								self.Medico 	    = data.data;
								self.total          = data.total;
								self.paginas		= paginas;
								self.pag_actual     = pag;
								
								return d.resolve()	
								
						})
					return d.promise;	
				},

				obtenerPaginas :function(data){
							var pag = data.total / 10	;
							pag = Math.floor(pag);
					
							var arr_paginas = new Array(pag);
							for( var i = 0 ; i<=pag ; i++){
								arr_paginas[i]=i;
							}
							return arr_paginas;
				}

	}


	return self;
}])