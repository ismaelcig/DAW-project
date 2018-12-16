<?php
/*********************************************************************
 ** Clase con los métodos de añadir a cesta, comprar, favoritos....
 *********************************************************************/
require_once('Utilidades.php');
Utilidades::_log('Entra ------->book-functions.php<-------');

require_once(Utilidades::getRoot().'common/BD/objetos/DTO/UserDTO.php');
require_once(Utilidades::getRoot().'common/BD/fachadas/UserFacade.php');

//Inicio de sesión
Utilidades::initSession();
//Recuperamos usuario
$user = new UserDTO();
if(isset($_SESSION['activeUser'])){
	$user=$_SESSION['activeUser'];
}else{
	echo 'mustLog';//Debes estar registrado
	exit();//Que no continúe
}
//Recuperamos acción a realizar
$action = $_POST['action'];
Utilidades::traza($action);

switch ($action) {
    case 'add-wish':
		UserFacade::addFavourite($_POST['book_id'], $_POST['book_lang']);
        echo 'faved';
        break;
	case 'rem-wish':
		UserFacade::removeFavourite($_POST['book_id'], $_POST['book_lang']);
		echo 'unfaved';
		break;
    default:
		echo '';
}





?>