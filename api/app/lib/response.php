<?php

namespace App\Lib;

/**
* Class response
*/
class Response
{
	public $response  	= false;
	public $message		='Ocurrio un Error!';
	public $error		= false;

	public function SetResponse($response, $m , $err){
		$this->response = $response;
		$this->message = $m;
		$this->error = $err;
		if(!$response && $m = '') $this->response ='Ocurrio un Error inesperado';

		return $this;
	}
}


 ?>