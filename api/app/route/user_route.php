<?php
use App\Lib\Response;

$app->group('/user',function(){

	$this->post('/login',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->UserModel->login($req->getParsedBody()))
				   	);
	});
	$this->post('/',function($req, $res, $args){

		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->UserModel->insert($req->getParsedBody()))
				   	);
	});

	$this->put('/{id}',function($req, $res, $args){

		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->UserModel->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->UserModel->delete($args['id']))
				   	);

	});
});

 ?>