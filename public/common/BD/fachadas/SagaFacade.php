<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DTO/SagaDTO.php');
require_once(__DIR__.'/../acceso/SagaAccess.php');


/*********************************************************
 * Clase con los métodos de saga
 *********************************************************/
class SagaFacade{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos SagaDTO
	 */
	public function findAll() {
		$res = array();
		
		foreach(SagaAccess::findAll() as $obj) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = self::daoToDto($obj);
		}
		return $res;
	}

	/**
	 * Recupera un autor por su id
	 */ 
	public function findById($id){
		$obj = SagaAccess::findById($id);
		
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
		
		$dto = new SagaDTO($dao->getId(),
							$name);
		return $dto;
	}
	
	
}
?>