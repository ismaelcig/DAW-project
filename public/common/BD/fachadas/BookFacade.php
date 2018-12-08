<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DTO/BookDTO.php');
require_once(__DIR__.'/../acceso/BookAccess.php');


/*********************************************************
 * Clase con los métodos de book y book_lang
 *********************************************************/
class BookFacade{
	/**
	 * Recupera todos los registros de las tablas book y book_lang.
	 * Devuelve un array de objetos bookDTO
	 */
	public function findAll() {
		$res = array();
		
		foreach(BookAccess::findAll() as $obj) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = self::daoToDto($obj);
		}
		return $res;
	}

	/**
	 * Recupera un libro por su id
	 */ 
	public function findById($id){
		$obj = BookAccess::findById($id);
		if(null != $obj)
			return self::daoToDto($obj);
		else return null;
	}
	
	/**
	 * Devuelve filtrando por parámetros
	 */
	function findBy($genre, $author, $minPrice, $maxPrice){
		$res = array();
		
		foreach(
			BookAccess::findBy($genre, $author, $minPrice, $maxPrice)
			as $obj) 
		{// Añadimos un objeto por cada elemento obtenido
			$res[] = self::daoToDto($obj);
		}
		return $res;
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