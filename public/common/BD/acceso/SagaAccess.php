<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/SagaDAO.php');


/*********************************************************
 * Clase para interactuar con la tabla saga
 *********************************************************/
class SagaAccess{
	/**
	 * Recupera todos los registros de la tabla.
	 * Devuelve un array de objetos SagaDAO
	 */
	function findAll() {
		$query = "SELECT id, nameEN, nameES FROM saga";
		$res = array();
		
		foreach(DB::ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new SagaDAO($row);
		}
		return $res;
	}

	/**
	 * Recupera una saga por su id
	 */ 
	function findById($id){
		$query = "SELECT id, nameEN, nameES FROM saga WHERE id = $id";
		$row = DB::ejecutarConsulta($query);
		
		return new SagaDAO($row[0]);
	}

	/**
	 * Recupera una saga por su nombre
	 */ 
	public function findByName($name){
		$query = "SELECT * FROM saga WHERE (nameEN = :name 
										  OR nameES = :name)";
		$db=DB::conectar();//Devuelve conexión
		$select=$db->prepare($query);
					
		$select->bindValue('name',$name);
		$row = $select->fetch();
		if(null != $row)
			return new SagaDAO($row[0]);
		else return null;
	}

	/**
	 * Inserta un saga
	 */ 
	public function insert($name){
		$name1 = $name;
		$query = "INSERT INTO saga(nameEN,nameES) VALUES (:name,:name1)";
		$db=DB::conectar();//Devuelve conexión
		$insert=$db->prepare($query);
					
		$insert->bindValue('name',$name);
		$insert->bindValue('name1',$name1);
		$insert->execute();
		
		
		//Recuperamos el id del objeto
		$last_id = $db->lastInsertId();
		if(null != $last_id && 0< $last_id){
			Utilidades::_log("Insertada saga ".$last_id.".");
			return $last_id;
		}else{
			return 0;
		}
	}
}

?>