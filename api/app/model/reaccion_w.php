<?php

namespace App\Model;

use App\Lib\Response,
	App\Lib\Security;

/**
* Modelo reaccion widal
*/
class  ReaccionWModel
{
	private $db;
	private $table = 'reaccion_w';
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
	public function getReaccionW($id){

		return $data = $this->db->from($this->table, $id)
								->fetch();
	}
	//registrar

	public function insert($data){
		$this->db_pdo->multi_query(" CALL insertarReaccionW('".$data['_paraA1']."',
														'".$data['_paraA2']."',
														'".$data['_paraA3']."',
														'".$data['_paraA4']."',
														'".$data['_paraA5']."',
														'".$data['_paraA6']."',
														'".$data['_paraB1']."',
														'".$data['_paraB2']."',
														'".$data['_paraB3']."',
														'".$data['_paraB4']."',
														'".$data['_paraB5']."',
														'".$data['_paraB6']."',
														'".$data['_somaticoO1']."',
														'".$data['_somaticoO2']."',
														'".$data['_somaticoO3']."',
														'".$data['_somaticoO4']."',
														'".$data['_somaticoO5']."',
														'".$data['_somaticoO6']."',
														'".$data['_flagelarH1']."',
														'".$data['_flagelarH2']."',
														'".$data['_flagelarH3']."',
														'".$data['_flagelarH4']."',
														'".$data['_flagelarH5']."',
														'".$data['_flagelarH6']."',
														'".$data['_comentario']."',
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
	public function delete($id){
		$this->db->deleteFrom($this->table, $id)
			->execute();

		return $this->response->setResponse(true);
	}
}

 ?>