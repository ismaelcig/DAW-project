<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/GenreDAO.php');


/*********************************************************
 * Clase para interactuar con la tabla genre
 *********************************************************/
class GenreAccess{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos genreDAO
	 */
	function findAll() {
		$query = "SELECT id, nameEN, nameES FROM genre";
		$res = array();
		
		foreach(DB::ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new GenreDAO($row);
		}
		return $res;
	}

	/**
	 * Recupera un género por su id
	 */ 
	function findById($id){
		$query = "SELECT id, nameEN, nameES FROM genre WHERE id = $id";
		$row = DB::ejecutarConsulta($query);
		
		return new GenreDAO($row[0]);
	}

	/**
	 * Recupera un género por su nombre
	 */ 
	public function findByName($name){
		$query = "SELECT * FROM genre WHERE (nameEN = :name 
										  OR nameES = :name)";
		$db=DB::conectar();//Devuelve conexión
		$select=$db->prepare($query);
					
		$select->bindValue('name',$name);
		$row = $select->fetch();
		if(null != $row)
			return new GenreDAO($row[0]);
		else return null;
	}

	/**
	 * Inserta un género
	 */ 
	public function insert($name){
		$name1 = $name;
		$query = "INSERT INTO genre(nameEN,nameES) VALUES (:name,:name1)";
		$db=DB::conectar();//Devuelve conexión
		$insert=$db->prepare($query);
					
		$insert->bindValue('name',$name);
		$insert->bindValue('name1',$name1);
		$insert->execute();
		
		
		//Recuperamos el id del objeto
		$last_id = $db->lastInsertId();
		if(null != $last_id && 0< $last_id){
			Utilidades::_log("Insertado género ".$last_id.".");
			return $last_id;
		}else{
			return 0;
		}
	}
}

?>