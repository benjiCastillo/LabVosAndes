<?php

namespace App\Model;

use App\Lib\Response,
	App\Lib\Security;

/**
* Modelo usuario
*/
class  InformesGModel
{
	private $db;
	private $table = 'informes_g';
	private $response;



	public function __CONSTRUCT($db, $db_pdo){
		$this->db 		= $db;
		$this->db_pdo   = $db_pdo;
		$this->response = new Response();
		$this->security = new Security();
	}

	//var $l => 'limit', $p => 'pagina'

	//lista_total
	public function listar(){

		return $data = $this->db->from($this->table)
						 ->orderBy('id DESC')
						 ->fetchAll();
	//  return $data = $this->db_pdo->query('select * from '.$this->table)
	//					 			->fetchAll();
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

		return $data = $this->db->from($this->table, $id)
								->fetch();
	}
	//registrar

	public function insert($data){
		// $data['password'] = md5($data['password']);

		$this->db_pdo->insertInto($this->table, $data)
				 ->execute();

		return $this->response->setResponse(true);
		}

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

		$this->db->update($this->table, $data, $id)
				 ->execute();

		return $this->response->setResponse(true);
	}
	//eliminar
	public function delete($id,$titulo){
		$this->db->deleteFrom($this->table, $id)
			->execute();

		return $this->response->setResponse(true);
	}

}

 ?>