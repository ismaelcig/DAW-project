<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/Genre.php');


/*********************************************************
 * Clase con métodos para interactuar con la tabla genre
 *********************************************************/
/**
 * Recupera todos los registros de la tabla.
 * Devuelve un array de objetos genre
 */
function findAllGenres() {
	$query = "SELECT id, name FROM genre";
	$res = array();
	
	foreach(ejecutarConsulta($query) as $row) {
		// Añadimos un objeto por cada elemento obtenido
		$res[] = new Genre($row);
	}
	return $res;
}

/**
 * Recupera un género por su id
 */ 
function findGenre($id){
	$query = "SELECT id, name FROM genre WHERE id = $id";
	$row = ejecutarConsulta($query);
	
	return new Genre($row[0]);
}

?>