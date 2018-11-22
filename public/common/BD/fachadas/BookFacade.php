<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/Book.php');


/*********************************************************
 * Clase con métodos para interactuar con la tabla book
 *********************************************************/
/**
 * Recupera todos los registros de la tabla.
 * Devuelve un array de objetos book
 */
function findAllBooks() {
	$query = "SELECT id,title,cover,author,genre,language,
				saga,rating,synopsis,price,stock,visible
				FROM book";
	$res = array();
	
	foreach(ejecutarConsulta($query) as $row) {
		// Añadimos un objeto por cada elemento obtenido
		$res[] = new Book($row);
	}
	return $res;
}

/**
 * Devuelve sólo los datos necesarios para mostrarlo por pantalla
 */
function findBookItems($genre, $author, $minPrice, $maxPrice){
	$query = "SELECT title,cover,author,genre,rating,price".
				"FROM book ".
				"WHERE `stock` > 0 AND `visible` = 1 ";
	//Filtros
	if(isset($genre)){
		$query.= "AND genre = $genre";
	}
	if(isset($author)){
		$query.= "AND author = $author";
	}
	if(isset($minPrice)){
		$query.= "AND minPrice = $minPrice";
	}
	if(isset($maxPrice)){
		$query.= "AND maxPrice = $maxPrice";
	}
	$res = array();
	
	foreach(ejecutarConsulta($query) as $row) {
		// Añadimos un objeto por cada elemento obtenido
		$res[] = new Book($row);
	}
	return $res;
}

?>

