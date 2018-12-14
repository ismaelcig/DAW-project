<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DTO/UserDTO.php');
require_once(__DIR__.'/../acceso/UserAccess.php');


/*********************************************************
 * Clase con los métodos de user
 *********************************************************/
class UserFacade{

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
	 * Devuelve usuario, o null si nombre/clave son incorrectos
	 */
	public function findUser($acc,$pass){
		$obj = UserAccess::findUser($acc,$pass);
		if(null != $obj)
			return self::daoToDto($obj);
		else return null;
	}
	
	/**
	 * Insertar usuario
	 * Si se indica, devuelve el objeto insertado
	 */
	public function insert($user, $return = false){
		UserAccess::insert($user);
		if($return)
			return self::findUser($user->getAccount(), $user->getPass());
		
	}
	
	/**
	 * Comprueba si ya existe una cuenta con ese nombre
	 */
	public function existeUser($acc){
		return UserAccess::existeUser($acc);
	}
	
	
	
	
	/**
	 * Recibe un DAO y lo pasa a DTO
	 */
	public function daoToDto($dao){
		$dto = new UserDTO();
		$dto->init(	$dao->getId(),
							$dao->getAccount(),
							$dao->getName(),
							$dao->getSurnames(),
							$dao->getEmail(),
							$dao->getPass(),
							$dao->getAddress(),
							$dao->getAccess());
							
		return $dto;
	}
}
?>