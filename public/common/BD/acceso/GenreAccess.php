<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/GenreDAO.php');


/*********************************************************
 * Clase para interactuar con la tabla genre
 *********************************************************/
class GenreAccess{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos genreDAO
	 */
	function findAll() {
		$query = "SELECT id, nameEN, nameES FROM genre";
		$res = array();
		
		foreach(ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new GenreDAO($row);
		}
		return $res;
	}

	/**
	 * Recupera un género por su id
	 */ 
	function findById($id){
		$query = "SELECT id, nameEN, nameES FROM genre WHERE id = $id";
		$row = ejecutarConsulta($query);
		
		return new GenreDAO($row[0]);
	}
}

?>