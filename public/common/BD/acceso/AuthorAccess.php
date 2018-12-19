<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/AuthorDAO.php');


/*********************************************************
 * Clase para interactuar con la tabla author
 *********************************************************/
class AuthorAccess{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos authorDAO
	 */
	function findAll() {
		$query = "SELECT id, name FROM author";
		$res = array();
		
		foreach(DB::ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new AuthorDAO($row);
		}
		return $res;
	}

	/**
	 * Recupera un autor por su id
	 */ 
	function findById($id){
		$query = "SELECT id, name FROM author WHERE id = $id";
		$row = DB::ejecutarConsulta($query);
		
		return new AuthorDAO($row[0]);
	}

	/**
	 * Recupera un autor por su nombre
	 */ 
	public function findByName($name){
		$query = "SELECT id, name FROM author WHERE name = :name";
		$db=DB::conectar();//Devuelve conexión
		$select=$db->prepare($query);
					
		$select->bindValue('name',$name);
		$row = $select->fetch();
		if(null != $row)
			return new AuthorDAO($row[0]);
		else return null;
	}

	/**
	 * Inserta un autor
	 */ 
	public function insert($name){
		$query = "INSERT INTO author(name) VALUES (:name)";
		$db=DB::conectar();//Devuelve conexión
		$insert=$db->prepare($query);
					
		$insert->bindValue('name',$name);
		$insert->execute();
		
		
		//Recuperamos el id del objeto
		$last_id = $db->lastInsertId();
		if(null != $last_id && 0< $last_id){
			Utilidades::_log("Insertado autor ".$last_id.".");
			return $last_id;
		}else{
			return 0;
		}
	}
}

?>