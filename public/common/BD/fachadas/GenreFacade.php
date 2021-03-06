<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DTO/GenreDTO.php');
require_once(__DIR__.'/../acceso/GenreAccess.php');


/*********************************************************
 * Clase con los métodos de genre
 *********************************************************/
class GenreFacade{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos genre
	 */
	public function findAll() {
		$res = array();
		
		foreach(GenreAccess::findAll() as $obj) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = self::daoToDto($obj);
		}
		return $res;
	}

	/**
	 * Recupera un autor por su id
	 */ 
	public function findById($id){
		$obj = GenreAccess::findById($id);
		
		return self::daoToDto($obj);
	}
	
	
	
	/**
	 * Recibe un DAO y lo pasa a DTO
	 */
	public function daoToDto($dao){
		//Escoger idioma
		$name = '';
		if($_SESSION['lang'] == 'ES')
			$name = $dao->getNameES();
		else if($_SESSION['lang'] == 'EN')
			$name = $dao->getNameEN();
		
		$dto = new GenreDTO($dao->getId(),
							$name);
		return $dto;
	}
	
	
}
?>