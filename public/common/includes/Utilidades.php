<?php

class Utilidades{
	/*
	private static $iv=null;
	private static $key = "ASDF";*/
	
	/**
	 * Registra una traza en el log
	 * Lleva la fecha en el nombre
	 */
	function _log($log){
		$log = '['.date("H:i:s").'] '.$log.PHP_EOL;//Nueva línea
		file_put_contents($_SERVER["DOCUMENT_ROOT"].
			'/zProject/logs/log_'.date("j.n.Y").'.log', $log, FILE_APPEND);
	}
	
	/**
	 * Traza de una variable
	 */
	function traza($var){
		self::_log(print_r($var, TRUE));
	}
	
	/**
	 * Devuelve ruta base para localizar archivos por ruta absoluta
	 */
	function getRoot(){
		return $_SERVER["DOCUMENT_ROOT"].'/zProject/public/';
	}
	
	/**
	 * Recibe un id. 
	 * Trata de recuperar la variable mediante GET
	 * Devuelve null si no se recibe el parámetro
	 */
	function get($id){
		if(isset($_GET[$id])) {
			return $_GET[$id];
		}
		return null;
	}

	/**
	 * Comienza una sessión 
	 * Inicializa variables de sesión si no lo están
	 * Comprueba si nos llegan por GET y lo guarda en SESSION
	 */
	function initSession(){
		self::_log('Entra: initSession()');
		//Esta clase nos hace falta para la sesión
		require_once(self::getRoot().'common/BD/objetos/DTO/UserDTO.php');
		
		session_start();
		//Currency (por defecto: '€')
		if(isset($_GET['currency']))//Si nos llega como parámetro
			$_SESSION['currency'] = $_GET['currency'];
		else if(!isset($_SESSION['currency']))//Si no está inicializada
			$_SESSION['currency'] = '€';
		//Lang (por defecto: 'ES')
		if(isset($_GET['lang']))//Si nos llega como parámetro
			$_SESSION['lang'] = $_GET['lang'];
		else if(!isset($_SESSION['lang']))//Si no está inicializada
			$_SESSION['lang'] = 'ES';
		
		self::_log('Sale:  initSession()');
	}

	/**
	 * Recibe un valor(€)
	 * Lo transforma a la moneda que esté en sesión
	 */
	function getMoney($value){
		if($_SESSION['currency'] === '€'){
			return $value.'€';//Se devuelve tal y como llega
		}
		else if($_SESSION['currency'] === '$'){
			return bcmul($value, 1.13, 2).'$';//Hay que multiplicar por 1.13
		}
		//else....
	}

	/**
	 * Recibe un array de strings (ids a buscar)
	 * Trata de recuperar las variables con GET
	 * Redirecciona a index.php si no vienen
	 */
	function required($array){
		self::_log('Entra: required()');
		foreach($array as $id){
			if(!isset($_GET[$id])){
				self::_log($id.' viene vacío.');
				header("Location: ".self::getRoot()."index.php");
				die();
			}
		}
		self::_log('Sale:  required()');
	}

	/**
	 * Recibe un objeto
	 * Redirecciona a index.php si es null
	 */
	function requiredObj($obj){
		self::_log('Entra: requiredObj()');
		if(null == $obj){
				self::_log('Era null.');
			header("Location: ".self::getRoot()."index.php");
			die();
		}
		self::_log('Sale:  requiredObj()');
	}
	
	/**
	 * Transforma un objeto a un array
	 */
	function object_to_array($data){
		if(is_array($data) || is_object($data))
		{
			$result = array();
	 
			foreach($data as $key => $value) {
				$result[$key] = $this->object_to_array($value);
			}
			return $result;
		}
		return $data;
	}
	
	
}
?>