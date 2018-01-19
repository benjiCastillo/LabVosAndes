<?php
use App\Lib\Response;

$app->group('/parasitologia',function(){

	$this->get('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Parasitologia->listar())
				   	);
	});

	$this->get('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Parasitologia->getParasitologia($args['id']))
				   	);
	});

	$this->post('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->Parasitologia->insertarParasitologia($req->getParsedBody()))

				   	);
	});

	$this->put('/{id}',function($req, $res, $args){

		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Parasitologia->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Parasitologia->delete($args['id']))
				   	);
	});
});

 ?>