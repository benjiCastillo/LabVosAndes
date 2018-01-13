<?php

namespace App\Model;

use App\Lib\Response,
	App\Lib\Security;

/**
* Modelo user
*/
class  UserModel
{
	private $db;
	private $table = 'usuario';
	private $response;



	public function __CONSTRUCT($db, $db_pdo){
		$this->db 		= $db;
		$this->db_pdo   = $db_pdo;
		$this->response = new Response();
		$this->security = new Security();
	}

    public function login($data){
		    $this->db_pdo->multi_query("CALL login(	'".$data['_user']."',
													'".$data['_password']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_assoc();
			mysqli_close($this->db_pdo);
			if ($res['error']==true) {
				return $this->response->setResponse(true, $res['respuesta'], $res['error']);
			}
			return $this->response->setResponse(true, $res, '0');
	}

	public function insert($data){
		    $this->db_pdo->multi_query("CALL insertUser('".$data['_nombre']."',
													'".$data['_user']."',
													'".$data['_password']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_assoc();
			mysqli_close($this->db_pdo);
			if ($res['error']==true) {
				return $this->response->setResponse(true, $res['respuesta'], $res['error']);
			}
			return $this->response->setResponse(true, $res['respuesta'], '0');
	}

	public function update($data, $id){

		$this->db->update($this->table, $data, $id)
				 ->execute();

		return $this->response->setResponse(true);
	}
	//eliminar
	public function delete($id){

		$this->db->deleteFrom($this->table, $id)
				 ->execute();

		return $this->response->setResponse(true);
	}

}

 ?>