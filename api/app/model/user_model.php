<?php

namespace App\Model;

use App\Lib\Response;

/**
* Modelo user
*/
class  UserModel
{
	private $db;
	private $db_pdo;
	private $table = 'usuario';
	private $response;



	public function __CONSTRUCT($db, $db_pdo){
		$this->db 		= $db;
		$this->db_pdo   = $db_pdo;
		$this->response = new Response();
	}

    public function login($data){
		    $this->db_pdo->multi_query("CALL login(	'".$data['_user']."',
													'".$data['_password']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_assoc();
			mysqli_close($this->db_pdo);
			if (isset($res['error'])) {
				return $this->response->setResponse(true, $res['respuesta'], $res['error']);
			}
			return $this->response->setResponse(true, $res, '0');
	}

	public function insert($data){
		    $this->db_pdo->multi_query("CALL insertarUser('".$data['_nombre']."',
													'".$data['_user']."',
													'".$data['_password']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_assoc();
			mysqli_close($this->db_pdo);
			if (isset($res['error'])) {
				return $this->response->setResponse(true, $res['respuesta'], $res['error']);
			}
			return $this->response->setResponse(true, $res['respuesta'], '0');
	}

	//actualizar
	public function update($data, $id){
		$oldData = $this->db->from($this->table, $id)
		->fetch();

		if ($oldData != null) {
			$this->db->update($this->table, $data, $id)
			->execute();

   			return $this->response->setResponse(true, 'El registro se actualizó correctamente', '0');
		}
		return $this->response->setResponse(true, 'Error al actualizar, el registro no existe', '1');
	}
	//eliminar
	public function delete($id){
		$data = $this->db->from($this->table, $id)
		->fetch();

		if ($data != null) {
			$this->db->deleteFrom($this->table, $id)
			->execute();

			return $this->response->setResponse(true, 'Registro eliminado', '0');
		}
		return $this->response->setResponse(true, 'Error al eliminar, el registro no existe', '1');
	}

}

 ?>