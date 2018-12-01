<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DTO/AuthorDTO.php');
require_once(__DIR__.'/../acceso/AuthorAccess.php');


/*********************************************************
 * Clase con los métodos de author
 *********************************************************/
class AuthorFacade{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos author
	 */
	public function findAll() {
		$res = array();
		
		foreach(AuthorAccess::findAll() as $obj) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = self::daoToDto($obj);
		}
		return $res;
	}

	/**
	 * Recupera un autor por su id
	 */ 
	public function findById($id){
		$obj = AuthorAccess::findById($id);
		
		return self::daoToDto($obj);
	}
	
	
	
	/**
	 * Recibe un DAO y lo pasa a DTO
	 */
	public function daoToDto($dao){
		$dto = new AuthorDTO($dao->getId(),
							 $dao->getName());
		return $dto;
	}
	
	
}
?>