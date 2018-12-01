<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/BookDAO.php');


/*********************************************************
 * Clase para interactuar con las tablas book y book_lang
 *********************************************************/
class BookAccess{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos bookLangDAO
	 */
	function findAll() {
		/*$query = "SELECT id,author,genre,saga,rating,price,sold 
					FROM book";
		$query ="SELECT `id`,`author`,`genre`,`saga`,`rating`,`price`,`sold`,
					`isbn`,`cover`,`title`,`synopsis`,`stock`,`visible`
				FROM `book`, `book_lang`
				WHERE `id` = `book_id`
				  AND `lang` = $_SESSION['lang']";*/
		$lang = $_SESSION['lang'];
		$query ="SELECT id,author,genre,saga,rating,price,sold,
					book_id,lang,isbn,cover,title,synopsis,stock,visible
				FROM book, book_lang
				WHERE id = book_id
				  AND lang = $lang";
		$res = array();
		
		foreach(ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new BookLangDAO($row);
		}
		return $res;
	}

	/**
	 * Recupera un género por su id
	 */ 
	function findById($id){
		$query = "SELECT id,author,genre,saga,rating,price,sold 
					FROM book WHERE id = $id";
		$row = ejecutarConsulta($query);
		
		return new BookLangDAO($row[0]);
	}
	
	/**
	 * Devuelve filtrando por parámetros
	 */
	function findBy($genre, $author, $minPrice, $maxPrice){
		$lang = $_SESSION['lang'];//Idioma de la web
		$query ="SELECT id,author,genre,saga,rating,price,sold, 
					book_id,lang,isbn,cover,title,synopsis,stock,visible 
				FROM book, book_lang 
				WHERE id = book_id 
				  AND lang = '$lang'
				  AND stock > 0 
				  AND visible = 1 ";
		//Filtros
		if(isset($genre)){
			$query.= " AND genre = $genre ";
		}
		if(isset($author)){
			$query.= " AND author = $author ";
		}
		if(isset($minPrice)){
			$query.= " AND minPrice = $minPrice ";
		}
		if(isset($maxPrice)){
			$query.= " AND maxPrice = $maxPrice ";
		}
		$res = array();
		
		foreach(ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new BookVO($row);
		}
		return $res;
	}
}

?>