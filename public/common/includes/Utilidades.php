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
 * Recibe un id y un valor por defecto.
 * Trata de recuperar el valor con GET 
 * Sino, si la variable SESSION ya tiene un valor, lo mantiene
 * Sino, en último caso utiliza $default
 */
function session($id, $default){
	if(isset($_GET[$id]))
		$_SESSION[$id] = $_GET[$id];
	else if(isset($_SESSION[$id]))
		$_SESSION[$id] = $_SESSION[$id];
	else 
		$_SESSION[$id] = $default;
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