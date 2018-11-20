<?php

/***********************************
 * Clase con métodos genéricos
 ***********************************/
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
?>