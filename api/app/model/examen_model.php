<?php

namespace App\Model;

use App\Lib\Response,
	App\Lib\Security;

/**
* Modelo examen
*/
class  ExamenModel
{
	private $db;
	private $table = 'examen';
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
	public function getExamen($id){

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

	/* INSERTAR EXAMEN */
	public function insertTest($data){
		$this->db_pdo->multi_query("CALL insertarExamen('".$data['_id_medico']."',
														'".$data['_id_paciente']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_array();
			mysqli_close($this->db_pdo);
			$res = array("message"=>$res[0],"response"=>true);
			return $res;
	}

	public function listarExamenes(){
		$this->db_pdo->multi_query(" CALL listarExamenes()");
			$res = $this->db_pdo->store_result();
			while($fila = $res->fetch_assoc()){
				$arreglo[] = $fila;
			}
			$res = $arreglo;
			mysqli_close($this->db_pdo);
			$res = array("message"=>$res,"response"=>true);
			return $res;
	}

	public function listarExamenesPac($data){

			$this->db_pdo->multi_query(" CALL listarExamenesPac(".$data.")");
			$res = $this->db_pdo->store_result();
			while($fila = $res->fetch_assoc()){
				$arreglo[] = $fila;
			}
			$res = $arreglo;
			mysqli_close($this->db_pdo);
			$res = array("message"=>$res,"response"=>true);
			return $res;

	}

	public function insertarTipo($data){

		//$this->db->insertInto($this->table, $data)
		//		 ->execute();
		$this->db_pdo->multi_query(" CALL insertarTipo('".$data['_tipo']."',
														'".$data['_id_examen']."',
														'".$data['_id_tipo']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_array();
			mysqli_close($this->db_pdo);
			$res = array("message"=>$res[0],"response"=>true);
			return $res;
	}
	//listar todos los examens
	public function listAllTest(){

		$this->db_pdo->multi_query(" CALL listExa()");
			$res = $this->db_pdo->store_result();
			while($fila = $res->fetch_assoc()){
				$arreglo[] = $fila;
			}
			$res = $arreglo;
			mysqli_close($this->db_pdo);
			$res = array("message"=>$res,"response"=>true);
			return $res;
	}
	//Listar tipo de examen por id de examen
	public function listExamenPaciente($id){
		$this->db_pdo->multi_query(" CALL listarExamenPaciente('".$id."')");
			$res = $this->db_pdo->store_result();
			while($fila = $res->fetch_assoc()){
				$arreglo[] = $fila;
			}
			$res = $arreglo;
			mysqli_close($this->db_pdo);
			$res = array("message"=>$res,"response"=>true);
			return $res;
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