<?php
use App\Lib\Response;

$app->group('/examengeneral',function(){

	$this->get('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->ExamenGeneral->listar())
				   	);
	});

	$this->get('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->ExamenGeneral->getExamenGeneral($args['id']))
				   	);
	});

	$this->post('/',function($req, $res, $args){

		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->ExamenGeneral->insertGeneralTest($req->getParsedBody()))

				   	);
	});

	$this->put('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->ExamenGeneral->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->ExamenGeneral->delete($args['id']))
				   );
	});
});
// })->add(new AuthMiddleware($app)); //agregar middleware

 ?>