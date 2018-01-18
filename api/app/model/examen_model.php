<?php

namespace App\Model;

use App\Lib\Response;

/**
* Modelo examen
*/
class  ExamenModel
{
	private $db;
	private $db_pdo;
	private $table = 'examen';
	private $response;



	public function __CONSTRUCT($db, $db_pdo){
		$this->db 		= $db;
		$this->db_pdo   = $db_pdo;
		$this->response = new Response();
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

	/* INSERTAR EXAMEN */
	public function insertTest($data){
		$this->db_pdo->multi_query("CALL insertarExamen('".$data['_id_medico']."',
														'".$data['_id_paciente']."')");
			$res = $this->db_pdo->store_result();
			$res = $res->fetch_assoc();
			mysqli_close($this->db_pdo);
			if (isset($res['error'])) {
				return $this->response->setResponse(true, $res['respuesta'], $res['error']);
			}
			return $this->response->setResponse(true, $res, '0');
	}

	public function listarExamenes($id){
		$this->db_pdo->multi_query(" CALL listarExamenes(".$id.")");
			$res = $this->db_pdo->store_result();
			while($fila = $res->fetch_assoc()){
				$arreglo[] = $fila;
			}
			$res = $arreglo;
			mysqli_close($this->db_pdo);
			if (isset($res[0]['error'])) {
				return $this->response->setResponse(true, $res[0]['respuesta'], $res[0]['error']);
			}
			return $this->response->setResponse(true, $res, '0');
	}

	public function listarExamenesPaciente($id) {
		$tests = array('examen_general', 'biometria', 'informes_g', 'reaccion_w');
		foreach ($tests as $test) {
			$data = $this->db->from($test)
			->where('id_examen', $id)
			->fetch();
			$res = null;
			if ($data != false) {
				$data->nombre = $test;
				$res[] = $data;
			}
		}
		if ($res == null) {
			return $this->response->setResponse(true, 'No existen exámenes', '1');
		}
		return $this->response->setResponse(true, $res, '0');
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