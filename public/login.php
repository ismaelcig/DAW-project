<?php
require_once('common/includes/Utilidades.php');
Utilidades::_log('Entra ------->login.php<-------');

require_once(Utilidades::getRoot().'common/BD/objetos/DTO/UserDTO.php');
require_once(Utilidades::getRoot().'common/BD/objetos/DTO/OrderDTO.php');
require_once(Utilidades::getRoot().'common/BD/fachadas/UserFacade.php');

//Inicio de sesión
Utilidades::initSession();
$user=new UserDTO();

//Verifica si la variable signup está definida
if (isset($_POST['signup'])) {
	Utilidades::_log('Registrar: '.$_POST['_account']);
	//Recuperamos todos los campos
	$user->setAccount($_POST['_account']);//Obligatorio
	$user->setPass($_POST['_pass']);//Obligatorio
	if(isset($_POST['_name']))
		$user->setName($_POST['_name']);
	if(isset($_POST['_surnames']))
		$user->setSurnames($_POST['_surnames']);
	if(isset($_POST['_address']))
		$user->setAddress($_POST['_address']);
	if(isset($_POST['_email']))
		$user->setEmail($_POST['_email']);
	if(isset($_POST['_access']))
		$user->setAccess($_POST['_access']);
	
	//Si no existe otra cuenta con ese nombre
	if (!UserFacade::existeUser($_POST['_account'])) {
		$user = UserFacade::insert($user, true);
		if (null != $user && null != $user->getId()) {
			$_SESSION['activeUser'] = $user;//Crea la sesión de usuario
			$_SESSION['cart'] = new OrderDTO();//Crea el carro para añadir libros
			Utilidades::_log('Registro con éxito.');
			Utilidades::traza($user);
			header('Location: index.php');
		}else{//Error al insertar
			Utilidades::_log('Error "regErr"');
			header('Location: error.php?msg=regErr');
		}
	}else{//La cuenta ya existe
		Utilidades::_log('Error "accExists"');
		header('Location: error.php?msg=accExists');
	}		
	
	
	
}elseif (isset($_POST['login'])) {//Verifica si la variable signin está definida
	Utilidades::_log('Login: '.$_POST['_user']);
	$user = UserFacade::findUser($_POST['_user'],$_POST['_pass']);
	
	// Comprobamos que lo ha encontrado
	if (null != $user && null != $user->getId()) {
		$_SESSION['activeUser'] = $user;//Crea la sesión de usuario
		$_SESSION['cart'] = new OrderDTO();//Crea el carro para añadir libros
		$_SESSION['cart']->setUser_Id($user->getId());//Informamos el user_id
		Utilidades::traza($_SESSION['cart']);
		Utilidades::_log('Login con éxito.');
	Utilidades::traza($_SESSION['activeUser']);
		header('Location: index.php');
	}else{
		header('Location: error.php?msg=logErr');
	}
	
	
	
	
}elseif(isset($_POST['exit'])){//Cerrar sesión
	Utilidades::_log('Cerrar Sesión.');
	header('Location: index.php');
	unset($_SESSION['activeUser']); //Destruye la sesión
}

?>