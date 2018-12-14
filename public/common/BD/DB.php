<?php

/***********************************
 * Clase con métodos genéricos de conexión a BD
 ***********************************/

class DB{
	private static $conn=null;
	/**
	 * Recibe una query y la ejecuta.
	 * Contempla tratamiento de errores.
	 */
	function ejecutarConsulta($sql) {
		$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		$dsn = "mysql:host=localhost;dbname=bookworld";
		$user = 'root';
		$pass = '';
		
		try{
			$conn = new PDO($dsn, $user, $pass, $opc);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $conn->prepare($sql);//Utilizamos la query recibida
			$stmt->execute();
			$resultado = $stmt->setFetchMode(PDO::FETCH_ASSOC);
			$resultado = $stmt->fetchAll();
			return $resultado;
		}
		catch(PDOException $e) {
			echo "Error: " . $e->getMessage();
		}
		$conn = null;
	}
	
	public static function conectar(){/*
		$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
		self::$conn=new PDO('mysql:host=localhost;dbname=bookworld','root','root123456',$pdo_options);
		return self::$conn;*/
		$opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
		$dsn = "mysql:host=localhost;dbname=bookworld";
		$user = 'root';
		$pass = '';
		self::$conn = new PDO($dsn, $user, $pass, $opc);
		return self::$conn;
		
	}

	/**
	 * Añade un filtro a la query.
	 * Añade 'AND' si es necesario.
	 *//*
	function addFilter($query, $campo, $valor){
		$and = " AND ";
		if(isset($query) && isset($campo) && isset($valor)){
			if(!empty($query))
				$query.= $and;
			$query.= $campo . "=" . $valor;
			return $query;
		}
	}*/
}
?>