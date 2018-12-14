<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/AuthorDAO.php');


/*********************************************************
 * Clase para interactuar con la tabla author
 *********************************************************/
class AuthorAccess{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos authorDAO
	 */
	function findAll() {
		$query = "SELECT id, name FROM author";
		$res = array();
		
		foreach(DB::ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new AuthorDAO($row);
		}
		return $res;
	}

	/**
	 * Recupera un autor por su id
	 */ 
	function findById($id){
		$query = "SELECT id, name FROM author WHERE id = $id";
		$row = DB::ejecutarConsulta($query);
		
		return new AuthorDAO($row[0]);
	}
}

?>