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
	 * Recupera un autor por su nombre
	 */ 
	public function findByName($name){
		$obj = AuthorAccess::findByName($name);
		
		return self::daoToDto($obj);
	}
	
	/**
	 * Busca el Id de un autor, si no existe, lo crea
	 */
	public function getAuthorId($name){
		$id = 0;
		$auth = AuthorAccess::findByName($name);
		if(null == $auth){//Si no existe, lo crea
			$id = AuthorAccess::insert($name);
		}else{//Sino, devuelve id
			$id = $auth->getId();
		}
		if(0 < $id)
			return $id;
		else return null;//Error
	}
	
	
	
	
	
	/*************************************/
	/*  Gestión Libros  ******************/
	/*************************************//*
	public function newBook(){
		
	}*/
	
	
	
	
	
	
	
	/**
	 * Recibe un DAO y lo pasa a DTO
	 */
	public function daoToDto($dao){
		$dto = null;
		if(null != $dao)
			$dto = new AuthorDTO($dao->getId(),$dao->getName());
		return $dto;
	}
	
	
}
?>