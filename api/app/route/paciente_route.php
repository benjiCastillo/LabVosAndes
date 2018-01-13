<?php
use App\Lib\Response;

$app->group('/paciente',function(){

	$this->get('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Paciente->listar())
				   	);
	});

	$this->get('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Paciente->getPaciente($args['id']))
				   	);
	});

	$this->post('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->Paciente->insert($req->getParsedBody()))

				   	);
	});

	$this->put('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Paciente->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Paciente->delete($args['id']))
				   	);

	});
});

 ?>