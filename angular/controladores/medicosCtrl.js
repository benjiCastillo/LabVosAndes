var app = angular.module('facturacionApp.medicosCtrl', []);

// controlador clientes
app.controller('medicosCtrl', ['$scope','$routeParams','medicosServices', function($scope,$routeParams, medicosServices){
	
	var pag = $routeParams.pag

	$scope.activar('Mmedico','', 'medicosServices', 'Lista')
	$scope.medicos = {}
	$scope.medicoSel = {}
	$scope.accion = ""
	$scope.medicoEditado = {}

	//variable para mandar a la vista lo recuperado de la promise
	$scope.medicos = {
		'cargando':true
	}

	$scope.moverA = function(pag){

		$scope.medicos = {
			'cargando' : true
		}

		medicosServices.cargarPagina(pag).then(function(){
			$scope.medicos = medicosServices

		});
	
	}

	$scope.moverA(pag);

	//Mostrar Modal de Edicion y Creacion

	$scope.mostrarModal = function(  ){
		// console.log(medico)
		
		$("#modal-medico").modal();

			$scope.medicoEditado.respuesta={
				'err':false,
				'cargado':false
			}

	}

	$scope.modalEditar = function( medico ){
		// console.log(medico)

		angular.copy(medico, $scope.medicoSel)
		
		$("#modal-editar-medico").modal();

			$scope.medicoEditado.respuesta={
				'err':false,
				'cargado':false
			}


	}

	//Funcion para guardar

	$scope.guardar = function( medico){

		$scope.medicoEditado = medicosServices
		$scope.medicoEditado = {
			'respuesta':{
					'err':true,
					'cargado':false
				}
			}
		medicosServices.guardar( medico ).then(function(){

			$scope.medicoEditado = medicosServices
			$scope.medicoEditado.respuesta={
				'cargado':true
			}

					setTimeout(function(){
						document.getElementById("medNombre").value = ""	
						$("#modal-medico").modal("hide");
						
					},500)
		})
	}

	$scope.editar = function( medico,frmmedico){

		$scope.medicoEditado = medicosServices
		$scope.medicoEditado = {
			'respuesta':{
					'err':true,
					'cargado':false
				}
			}
		var id     = medico.id
		delete medico['id'];
		delete medico['fecha_a'];

		medicosServices.editar( medico,id ).then(function(){

			$scope.medicoEditado = medicosServices
			$scope.medicoEditado.respuesta={
				'cargado':true
			}

					setTimeout(function(){
						document.getElementById("medNombre").value = ""	
						$("#modal-editar-medico").modal("hide");
						
					},500)
		})
	}

	//eliminar

		$scope.mostrarEliminar = function( medico ){
		// console.log(medico)

			angular.copy(medico, $scope.medicoSel)

			$("#modal-medico-eliminar").modal();

			$scope.medicoEditado.respuesta={
					'cargado':false
			}

		}

		$scope.eliminar = function( medico ){
			$scope.medicoEditado = medicosServices
			$scope.medicoEditado = {
			'respuesta':{
					'err':true,
					'cargado':false
				}
			}
			medicosServices.eliminar( medico.id ).then(function(){

			$scope.medicoEditado = medicosServices
			$scope.medicoEditado.respuesta={
				'cargado':true
			}

					setTimeout(function(){

						$("#modal-medico-eliminar").modal("hide");
						$scope.medicoSel = {}	
						//frmmedico.autoValidateFormOptions.resetForm();

					},1000)
			})

		}

}])