<?php
use App\Lib\Response;

$app->group('/reaccionw',function(){

	$this->get('/',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->ReaccionW->listar())
				   	);
	});

	$this->get('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->ReaccionW->getReaccionW($args['id']))
				   	);
	});

	$this->post('/',function($req, $res, $args){
		// $r = UserValidation::validate($req->getParsedBody());

		// if(!$r->response){
		// 	return $res->withHeader('Content-type', 'aplication/json')
		// 			   ->withStatus(422)
		// 			   ->write(json_encode($r->errors));
		// }

		return $res->withHeader('Content-type', 'application/json')
			       -> write(
						json_encode($this->model->ReaccionW->insert($req->getParsedBody()))

				   	);
	});

	$this->put('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->ReaccionW->update($req->getParsedBody(), $args['id'] ))
				   	);
	});

	$this->delete('/{id}',function($req, $res, $args){
		return $res->withHeader('Content-type', 'application/json')
				   ->write(
				   		json_encode($this->model->ReaccionW->delete($args['id']))
				   	);

	});
});

 ?>