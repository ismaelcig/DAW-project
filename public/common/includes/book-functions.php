<?php
/*********************************************************************
 ** Clase con los métodos de añadir a cesta, comprar, favoritos....
 *********************************************************************/
require_once('Utilidades.php');
Utilidades::_log('Entra ------->book-functions.php<-------');

require_once(Utilidades::getRoot().'common/BD/objetos/DTO/UserDTO.php');
require_once(Utilidades::getRoot().'common/BD/objetos/DTO/OrderDTO.php');
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
    case 'add-bucket':
		UserFacade::addCart($_POST['book_id'], $_POST['book_lang'], $_POST['book_price']);
		//Devolvemos los datos
		echo json_encode(array("msg" => 'added',//Mensaje para mostrar al usuario
								"newAmount" => sizeOf($_SESSION['cart']->getBookVOs())));//Cantidad carro
        break;
	case 'rem-bucket':
		UserFacade::removeCart($_POST['book_id'], $_POST['book_lang']);
		//Devolvemos los datos
		echo json_encode(array("msg" => 'removed',//Mensaje para mostrar al usuario
								"newAmount" => sizeOf($_SESSION['cart']->getBookVOs())));//Cantidad carro
		break;
    case 'add-wish':
		UserFacade::addFavourite($_POST['book_id'], $_POST['book_lang']);
		//Devolvemos los datos
		//echo json_encode(array("msg" => 'faved'));
		echo 'faved';
		break;
	case 'rem-wish':
		UserFacade::removeFavourite($_POST['book_id'], $_POST['book_lang']);
		//Devolvemos los datos
		// echo json_encode(array("msg" => 'unfaved'));
		echo 'unfaved';
		break;
    default:
		echo '';
}





?>