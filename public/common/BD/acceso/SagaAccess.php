<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/SagaDAO.php');


/*********************************************************
 * Clase para interactuar con la tabla saga
 *********************************************************/
class SagaAccess{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos SagaDAO
	 */
	function findAll() {
		$query = "SELECT id, nameEN, nameES FROM saga";
		$res = array();
		
		foreach(DB::ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new SagaDAO($row);
		}
		return $res;
	}

	/**
	 * Recupera una saga por su id
	 */ 
	function findById($id){
		$query = "SELECT id, nameEN, nameES FROM saga WHERE id = $id";
		$row = DB::ejecutarConsulta($query);
		
		return new SagaDAO($row[0]);
	}
}

?>