<?php

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
	session_start();
	//Currency (por defecto: 'EURO')
	if(isset($_GET['currency']))//Si nos llega como parámetro
		$_SESSION['currency'] = $_GET['currency'];
	else if(!isset($_SESSION['currency']))//Si no está inicializada
		$_SESSION['currency'] = 'EURO';
	//Lang (por defecto: 'ES')
	if(isset($_GET['lang']))//Si nos llega como parámetro
		$_SESSION['lang'] = $_GET['lang'];
	else if(!isset($_SESSION['lang']))//Si no está inicializada
		$_SESSION['lang'] = 'ES';
	
}

/**
 * Recibe un valor(€)
 * Lo transforma a la moneda que esté en sesión
 */
function getMoney($value){
	if($_SESSION['currency'] === 'EURO'){
		return $value.'€';//Se devuelve tal y como llega
	}
	else if($_SESSION['currency'] === 'USD'){
		return bcmul($value, 1.13, 2).'$';//Hay que multiplicar por 1.13
	}
	//else....
}



?>