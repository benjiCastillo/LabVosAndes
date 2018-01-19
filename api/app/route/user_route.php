<?php
use App\Lib\Response;

$app->group('/user',function(){

	$this->post('/login',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->User->login($req->getParsedBody()))
				   	);
	});
	$this->post('/',function($req, $res, $args){

		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->User->insert($req->getParsedBody()))
				   	);
	});

	$this->put('/{id}',function($req, $res, $args){

		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->User->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->User->delete($args['id']))
				   	);

	});
});

 ?>