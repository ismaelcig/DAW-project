<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/BookDAO.php');
require_once(__DIR__.'/../objetos/VO/BookVO.php');
require_once(__DIR__.'/../../includes/Utilidades.php');


/*********************************************************
 * Clase para interactuar con las tablas book y book_lang
 *********************************************************/
class BookAccess{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos bookLangDAO
	 */
	function findAll() {
		Utilidades::_log("findAll()");
		$lang = $_SESSION['lang'];
		$query ="SELECT id,author,genre,saga,rating,price,sold,
					book_id,lang,isbn,cover,title,synopsis,stock,visible,
					publisher,publish_date
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
	 * Recupera por su Id e Idioma
	 */ 
	function findByIdLang($id,$lang){
		Utilidades::_log("findByIdLang($id,$lang)");
		$query = "SELECT id,author,genre,saga,rating,price,sold,
					book_id,lang,isbn,cover,title,synopsis,stock,visible,
					publisher,publish_date
				FROM book, book_lang
				WHERE id = book_id
				  AND id = $id ";
		if(null != $lang)
			$query.=" AND lang = '$lang'";
		
		$row = ejecutarConsulta($query);
		if(null != $row)//Por si no lo encuentra
			return new BookLangDAO($row[0]);
		else return null;
	}

	/**
	 * Recupera por su id
	 */ 
	function findById($id){
		Utilidades::_log("findById($id)");
		//Primero buscamos por el Idioma en Session
		$lang = $_SESSION['lang'];
		$book = self::findByIdLang($id, $lang);
		//Si no lo encuentra, buscamos cualquier Idioma
		if(null == $book)
			$book = self::findByIdLang($id, null);
		
		return $book;
	}
	
	/**
	 * Devuelve filtrando por parámetros
	 */
	function findBy($genre, $author, $minPrice, $maxPrice){
		Utilidades::_log("findBy($genre, $author, $minPrice, $maxPrice)");
		$lang = $_SESSION['lang'];//Idioma de la web
		$query ="SELECT id,author,genre,saga,rating,price,sold, 
					book_id,lang,isbn,cover,title,synopsis,stock,visible,
					publisher,publish_date
				FROM book, book_lang 
				WHERE id = book_id 
				  AND lang = '$lang'
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
		$query.= " ORDER BY  sold DESC, rating DESC";
		
		Utilidades::_log("query: ".$query);
		$res = array();
		
		foreach(ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new BookVO($row);
		}
		return $res;
	}
	
	/**
	 * Busca libros del mismo autor, pero sin incluir el que se recibe
	 */
	function relatedByAuthor($book_id, $book_lang, $author_id){
		Utilidades::_log("relatedByAuthor($book_id, $book_lang, $author_id)");
		$query ="SELECT id,author,genre,saga,rating,price,sold, 
					book_id,lang,isbn,cover,title,synopsis,stock,visible,
					publisher,publish_date
				FROM book, book_lang 
				WHERE id = book_id 
				  AND (id != $book_id OR lang != '$book_lang') 
				  AND author = $author_id 
				  AND visible = 1 
				  ORDER BY sold DESC
				  LIMIT 4";
		Utilidades::_log("query: ".$query);
		$res = array();
		
		foreach(ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new BookVO($row);
		}
		return $res;
	}
}

?>