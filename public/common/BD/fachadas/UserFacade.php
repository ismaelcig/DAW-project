<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DTO/UserDTO.php');
require_once(__DIR__.'/../objetos/DTO/OrderDTO.php');
require_once(__DIR__.'/../acceso/UserAccess.php');
require_once(__DIR__.'/../acceso/BookAccess.php');
require_once(__DIR__.'/../../includes/Utilidades.php');


/*********************************************************
 * Clase con los métodos de user
 *********************************************************/
class UserFacade{

	/**
	 * Recupera un libro por su id
	 */ 
	public function findById($id){
		$obj = UserAccess::findById($id);
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
	
	
	
	
	
	/********************************************
	 * Métodos para gestionar carro
	 ********************************************/
	
	/**
	 * Comprueba si ya está en el carro
	 */
	public function isInCart($book_id,$book_lang){
		Utilidades::_log("isInCart($book_id,$book_lang)");
		foreach($_SESSION['cart']->getBookVOs()
				as $bookVO){
			Utilidades::traza($bookVO);
			if($bookVO->getId() == $book_id && $bookVO->getLang() == $book_lang){
				return true;
			}
		}
		return false;
	}
	
	/**
	 * Añade un libro al carro
	 */
	public function addCart($book_id, $book_lang, $book_price){
		Utilidades::_log("addCart($book_id, $book_lang, $book_price)");
		//Se añade el nuevo libro
		$res = $_SESSION['cart']->getBookVOs();
		$res[] = BookAccess::findByIdLang($book_id, $book_lang, true);
		$_SESSION['cart']->setBookVOs($res);
		//Se añade al total
		$_SESSION['cart']->sumarTotal($book_price);
	}
	 
	/**
	 * Elimina un libro del carro
	 */
	public function removeCart($book_id, $book_lang){
		Utilidades::_log("removeCart($book_id, $book_lang)");
		//Buscamos el libro
		$lista = $_SESSION['cart']->getBookVOs();
		foreach($lista as $key=>$bookVO){
			
			if($bookVO->getId() == $book_id && $bookVO->getLang() == $book_lang){
				//Lo eliminamos
				array_splice($lista, $key,1);
				$_SESSION['cart']->setBookVOs($lista);
				
				//Se resta del total
				$_SESSION['cart']->restarTotal($bookVO->getPrice());
			}
		}
	}
	
	
	
	
	
	
	/********************************************
	 * Métodos para gestionar favoritos
	 ********************************************/
	
	/**
	 * Comprueba si ya está como favorito
	 */
	public function isFavourite($book_id,$book_lang){
		return UserAccess::isFavourite($book_id, $book_lang);
	}
	
	/**
	 * Añade un favorito de un usuario
	 */
	public function addFavourite($book_id, $book_lang){
		UserAccess::addFavourite($book_id, $book_lang);
	}
	 
	/**
	 * Elimina un favorito de un usuario
	 */
	public function removeFavourite($book_id, $book_lang){
		UserAccess::removeFavourite($book_id, $book_lang);
	}
	
	/**
	 * Recupera todos los favoritos del usuario
	 */
	public function getFavoritos(){
		return UserAccess::getFavoritos();
		
	}
}
?>