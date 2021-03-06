var app = angular.module('vosandesApp.informeServices',[])

app.factory('informeServices', ['$http','$q','$rootScope', function($http,$q,$rootScope){

var self ={
				'cargando'      : true,
				'cargado'		: false,
				'err'     		: false, 
				'conteo' 		: 0,
				'Informe' 	    : [],
				'pag_actual'    : 1,
				'pag_siguiente' : 1,
				'pag_anterior'  : 1,
				'total_paginas' : 1,
				'paginas'	    : [],
				cargarPagina : function(pag){

					var d = $q.defer()
					$http.get('api/examen/informe/informe.php?pag='+pag)	
						.success(function(data){
							console.log(data)

    							self.cargado		= true;
    							self.cargando		= false;
								self.err     		= data.err; 
								self.conteo 		= data.conteo;
								self.Informe 	    = data.Informe;
								self.pag_actual     = data.pag_actual;
								self.pag_siguiente  = data.pag_siguiente;
								self.pag_anterior   = data.pag_anterior;
								self.total_paginas  = data.total_paginas;
								self.paginas	    = data.paginas;
								return d.resolve()	
						
						})
					return d.promise;	
				}

	}


	return self;
}])