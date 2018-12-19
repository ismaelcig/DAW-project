<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DTO/BookDTO.php');
require_once(__DIR__.'/../acceso/BookAccess.php');
require_once(__DIR__.'/../../includes/Utilidades.php');


/*********************************************************
 * Clase con los métodos de book y book_lang
 *********************************************************/
class BookFacade{
	/**
	 * Recupera todos los registros de las tablas book y book_lang.
	 * Devuelve un array de objetos bookDTO
	 */
	public function findAll() {/*
		$res = array();
		
		foreach(BookAccess::findAll() as $obj) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = self::daoToDto($obj);
		}*/
		$res = BookAccess::findAll();
		Utilidades::traza($res);
		return $res;
	}
	
	/**
	 * Recupera por su Id e Idioma
	 */ 
	function findByIdLang($id,$lang){
		$obj = BookAccess::findByIdLang($id,$lang,$vo);
		if(null != $obj)
			return $obj;
		else return null;
	}

	/**
	 * Recupera un BookVO por su id
	 */ 
	public function findById($id){
		$obj = BookAccess::findById($id);
		if(null != $obj)
			return $obj;//self::daoToDto($obj);
		else return null;
	}
	
	/**
	 * Devuelve VO filtrando por parámetros
	 */
	function findBy($genre, $author, $minPrice, $maxPrice){
		$res = array();
		
		foreach(
			BookAccess::findBy($genre, $author, $minPrice, $maxPrice)
			as $obj) 
		{// Añadimos un objeto por cada elemento obtenido
			$res[] = $obj;//self::daoToDto($obj);
		}
		return $res;
	}
	
	/**
	 * Realiza la venta del libro
	 */
	public function sellBook($book){
		BookAccess::sellBook($book->getId(), $book->getLang());
	}
	
	
	
	
	
	/*************************************/
	/*  Gestión Libros  ******************/
	/*************************************/
	public function newBook($author, $genre, $saga, $rating, $price, $sold,
				$book_id,$lang,$isbn,$cover,$title,$synopsis,$stock,
						$visible,$publisher,$publish_date)
	{
		if(null == $book_id){//Hay que crear book
			$book_id = BookAccess::insertBook($author, $genre, $saga, $rating, $price, $sold);
		}
		if(0< $book_id){//Ya lo tenemos
			BookAccess::insertBook_lang($book_id,$lang,$isbn,$cover,$title,
					$synopsis,$stock,$visible,$publisher,$publish_date);
			
		}else{
			//Error
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	/**
	 * Recibe un DAO y lo pasa a DTO
	 */
	public function daoToDto($dao){
		$dto = new BookDTO( $dao->getId(),
							$dao->getAuthor(),
							$dao->getGenre(),
							$dao->getSaga(),
							$dao->getRating(),
							$dao->getPrice(),
							$dao->getSold(),
							$dao->getLang(),
							$dao->getIsbn(),
							$dao->getCover(),
							$dao->getTitle(),
							$dao->getSynopsis(),
							$dao->getStock(),
							$dao->getVisible(),
							$dao->getPublisher(),
							$dao->getPublish_date());//En formato DD-MM-YYYY
		return $dto;
	}
}
?>