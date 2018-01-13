<?php
use App\Lib\Response;

$app->group('/medico',function(){

	$this->get('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Medico->listar())
				   	);
	});

	$this->get('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Medico->getMedico($args['id']))
				   	);
	});

	$this->post('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->Medico->insert($req->getParsedBody()))

				   	);
	});

	$this->put('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Medico->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->Medico->delete($args['id']))
				   	);

	});
});

 ?>