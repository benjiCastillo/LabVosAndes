<?php

namespace App\Model;

use App\Lib\Response,
	App\Lib\Security;

/**
* Modelo paciente
*/
class  PacienteModel
{
	private $db;
	private $table = 'paciente';
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

		$data = $this->db->from($this->table)
						 ->orderBy('id DESC')
						 ->fetchAll();
		if(empty($data)){
		 $respuesta = array('respuesta' => 0 );
		 return $respuesta;
		}else{
		 return $data;
		}
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
	public function getPaciente($id){

		return $data = $this->db->from($this->table, $id)
								->fetch();
	}
	//registrar

	public function insert($data){
		$this->db_pdo->multi_query(" CALL insertarPaciente(	'".$data['_nombre']."',
													'".$data['_apellidos']."',
													'".$data['_edad']."',
													'".$data['_sexo']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_assoc();
			mysqli_close($this->db_pdo);
			if ($res['error']==true) {
				return $this->response->setResponse(true, $res['respuesta'], $res['error']);
			}
			return $this->response->setResponse(true, $res['respuesta'], $res['error']);
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