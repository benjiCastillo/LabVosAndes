<?php

namespace App\Model;

use App\Lib\Response;

/**
* Modelo usuario
*/
class  InformesGModel
{
	private $db;
	private $db_pdo;
	private $table = 'informes_g';
	private $response;



	public function __CONSTRUCT($db, $db_pdo){
		$this->db 		= $db;
		$this->db_pdo   = $db_pdo;
		$this->response = new Response();
	}

	//lista_total
	public function listar(){
		$data = $this->db->from($this->table)
						 ->orderBy('id DESC')
						 ->fetchAll();
		if ($data != null){
			return $this->response->setResponse(true, $data, '0');
		}
		return $this->response->setResponse(true, 'No existen datos', '1');
	}

	//listar paginado
	//parametros de limite, pagina
	public function paginated($l, $p){
		$p = $p*$l;
		$data = $this->db->from($this->table)
						 ->limit($l)
						 ->offset($p)
						 ->orderBy('id desc')
						 ->fetchAll();

		$total = $this->db->from($this->table)
						  ->select('COUNT(*) Total')
						  ->fetch()
						  ->Total;

		return [
			'data'	=>   $data,
			'total' =>   $total

		];
	}
	//obtener
	public function getInformeG($id){
		$data = $this->db->from($this->table, $id)
								->fetch();
		if ($data != null){
			return $this->response->setResponse(true, $data, '0');
		}
		return $this->response->setResponse(true, 'Registro no encontrado', '1');
	}
	//registrar
	public function insertarInformeG($data){
		$this->db_pdo->multi_query(" CALL insertarInformeG('".$data['_nombre']."',
														'".$data['_contenido']."',
														'".$data['_id_examen']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_assoc();
			mysqli_close($this->db_pdo);
			if ($res['error']==true) {
				return $this->response->setResponse(true, $res['respuesta'], $res['error']);
			}
			return $this->response->setResponse(true, array("id"=>$res['id']), $res['error']);
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