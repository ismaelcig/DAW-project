<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/Author.php');


/*********************************************************
 * Clase con métodos para interactuar con la tabla author
 *********************************************************/
/**
 * Recupera todos los registros de la tabla.
 * Devuelve un array de objetos author
 */
function findAllAuthors() {
	$query = "SELECT id, name FROM author";
	$res = array();
	
	foreach(ejecutarConsulta($query) as $row) {
		// Añadimos un objeto por cada elemento obtenido
		$res[] = new Author($row);
	}
	return $res;
}

/**
 * Recupera un autor por su id
 */ 
function findAuthor($id){
	$query = "SELECT id, name FROM author WHERE id = $id";
	$row = ejecutarConsulta($query);
	
	return new Author($row[0]);
}

?>