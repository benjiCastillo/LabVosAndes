<?php
use App\Lib\Response;

$app->group('/microbiologia',function(){

	$this->get('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Microbiologia->listar())
				   	);
	});

	$this->get('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Microbiologia->getMicrobiologia($args['id']))
				   	);
	});

	$this->post('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->Microbiologia->insertarMicrobiologia($req->getParsedBody()))

				   	);
	});

	$this->put('/{id}',function($req, $res, $args){

		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Microbiologia->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Microbiologia->delete($args['id']))
				   	);
	});
});

 ?>