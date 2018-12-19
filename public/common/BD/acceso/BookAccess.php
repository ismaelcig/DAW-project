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
		// $lang = $_SESSION['lang'];
		$query ="SELECT id,author,genre,saga,rating,price,sold, 
					book_id,lang,isbn,cover,title,synopsis,stock,visible,
					publisher,publish_date
				FROM book, book_lang 
				WHERE id = book_id";
		$res = array();
		
		foreach(DB::ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new BookVO($row);
		}
		return $res;
	}

	/**
	 * Recupera por su Id e Idioma
	 */ 
	function findByIdLang($id,$lang, $vo = false){
		Utilidades::_log("findByIdLang($id,$lang,$vo)");
		$query = "SELECT id,author,genre,saga,rating,price,sold,
					book_id,lang,isbn,cover,title,synopsis,stock,visible,
					publisher,publish_date
				FROM book, book_lang
				WHERE id = book_id
				  AND id = $id ";
		if(null != $lang)
			$query.=" AND lang = '$lang'";
		
		$row = DB::ejecutarConsulta($query);
		if(null != $row)//Por si no lo encuentra
			if($vo) return new BookVO($row[0]);
			else return new BookLangDAO($row[0]);
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
		
		foreach(DB::ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new BookVO($row);
		}
		return $res;
	}
	
	/**
	 * Realiza venta de un libro
	 */
	function sellBook($book_id, $book_lang){
		Utilidades::_log("sellBook($book_id, $book_lang)");
		/****Actualizar book****/
		$query1 ="UPDATE book
				 SET sold = sold+1
				 WHERE id = :book_id";
					
		$db=DB::conectar();//Devuelve conexión
		$update=$db->prepare($query1);
		//Bind values
		$update->bindValue('book_id',$book_id);
		
		$update->execute();
		Utilidades::_log('Sold+1');
		/****Actualizar book_lang****/
		$query2 ="UPDATE book_lang
				 SET stock = stock-1
				 WHERE book_id = :book_id
				   AND lang = :book_lang";
		
		$update=$db->prepare($query2);
		//Bind values
		$update->bindValue('book_id',$book_id);
		$update->bindValue('book_lang',$book_lang);
		
		$update->execute();
		Utilidades::_log('Stock-1');
	}
	
	
	
	
	
	/**********************************/
	/* Gestión de libros  *************/
	/**********************************/
	
	/**
	 * Insertar book
	 */
	public function insertBook($author, $genre, $saga, $rating, $price, $sold){
		Utilidades::_log("insertBook()");
		$query = "INSERT INTO book(author, genre, saga, rating, price, sold) 
			VALUES (:author, :genre, :saga, :rating, :price, :sold)";
		$db=DB::conectar();//Devuelve conexión
		$insert=$db->prepare($query);
		$insert->bindValue('author',$author);
		$insert->bindValue('genre',$genre);
		$insert->bindValue('saga',$saga);
		$insert->bindValue('rating',$rating);
		$insert->bindValue('price',$price);
		$insert->bindValue('sold',$sold);
		$insert->execute();
		//Recuperamos el id del objeto
		$last_id = $db->lastInsertId();
		if(null != $last_id && 0< $last_id){
			Utilidades::_log("Insertado book ".$last_id.".");
			return $last_id;
		}else{
			return 0;
		}
	}
	
	/**
	 * Insertar book_lang
	 */
	public function insertBook_lang($book_id,$lang,$isbn,$cover,$title,$synopsis,$stock,
						$visible,$publisher,$publish_date){
		Utilidades::_log("insertBook_lang($book_id,$lang,$title)");
		$query = "INSERT INTO book_lang(book_id,lang,isbn,cover,title,synopsis,stock,
										visible,publisher,publish_date) 
					VALUES (:book_id,:lang,:isbn,:cover,:title,:synopsis,:stock,
						:visible,:publisher,:publish_date)";
		
		$db=DB::conectar();//Devuelve conexión
		$insert=$db->prepare($query);
					
		$insert->bindValue('book_id',$book_id);
		$insert->bindValue('lang',$lang);
		$insert->bindValue('isbn',$isbn);
		$insert->bindValue('cover',$cover);
		$insert->bindValue('title',$title);
		$insert->bindValue('synopsis',$synopsis);
		$insert->bindValue('stock',$stock);
		$insert->bindValue('visible',$visible);
		$insert->bindValue('publisher',$publisher);
		$insert->bindValue('publish_date',$publish_date);
		$insert->execute();
		
		Utilidades::_log("Insertado book_lang ".$book_id."-".$lang.".");
		
	}
	
	/**
	 * Eliminar book_lang
	 */
	public function deleteBook($id, $lang){
		Utilidades::_log("deleteBook($id, $lang)");
		
		$query1 = "DELETE FROM book_lang WHERE book_id = :id";
		$query2 = "DELETE FROM book WHERE id = :id";
		if(null != $lang)//Si se especifica idioma
			$query1.= " AND lang = :lang";
		
		//Borrado sobre book_lang
		$db=DB::conectar();//Devuelve conexión
		$delete=$db->prepare($query1);
		$delete->bindValue('id',$id);
		if(null != $lang)
			$delete->bindValue('lang',$lang);
		$delete->execute();
		
		if(null == $lang){
			//Borrado sobre book
			$delete=$db->prepare($query2);
			$delete->bindValue('id',$id);
			$delete->execute();
		}
		
	}
	
	
}

?>