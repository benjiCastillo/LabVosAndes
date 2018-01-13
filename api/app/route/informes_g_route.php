<?php
use App\Lib\Response;

$app->group('/informesg',function(){

	$this->get('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->InformesG->listar())
				   	);
	});

	$this->get('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->InformesG->getInformeG($args['id']))
				   	);
	});

	$this->post('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->InformesG->insertarInformeG($req->getParsedBody()))

				   	);
	});

	// $this->post('/insertReport/',function($req, $res, $args){
	// 	return $res->withHeader('Content-type', 'application/json')
	// 		       -> write(
	// 					json_encode($this->model->InformesG->insertarInformeG($req->getParsedBody()))

	// 			   	);
	// });

	$this->put('/{id}',function($req, $res, $args){

		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->InformesG->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}/{titulo}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->InformesG->delete($args['id'], $args['titulo']))
				   	);
	});
});

 ?>