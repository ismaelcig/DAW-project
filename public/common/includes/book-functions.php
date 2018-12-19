<?php
/*********************************************************************
 ** Clase con los métodos de añadir a cesta, comprar, favoritos....
 *********************************************************************/
require_once('Utilidades.php');
Utilidades::_log('Entra ------->book-functions.php<-------');

require_once(Utilidades::getRoot().'common/BD/objetos/DTO/UserDTO.php');
require_once(Utilidades::getRoot().'common/BD/objetos/DTO/OrderDTO.php');
require_once(Utilidades::getRoot().'common/BD/fachadas/UserFacade.php');
require_once(Utilidades::getRoot().'common/BD/fachadas/BookFacade.php');

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
Utilidades::requiredObj($_POST['action']);
$action = $_POST['action'];
Utilidades::traza($action);

switch ($action) {
	/***Carro***/
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
	case 'checkout':
		//Comprobamos si el usuario tiene dirección
		if(null != $_SESSION['activeUser']->getAddress()){
			UserFacade::saveCart();//Se guarda el pedido
			
			/*Aquí se realizaría el cobro del pedido*/
			
			unset($_SESSION['cart']);
			$_SESSION['cart'] = new OrderDTO();//Se limpia el carro
			$_SESSION['cart']->setUser_Id($_SESSION['activeUser']->getId());//Informar user_id
			
			//Datos a devolver
			echo json_encode(array("res" => "ok", "msg" => 'thx'));
		}
		else{
			//Datos a devolver
			echo json_encode(array("res" => "nok", "msg" => 'dirMust'));
		}
		break;
	
	
	
	
	
	/***Procesar pedido***/
	case 'processOrder':
		Utilidades::traza($_POST);
		UserFacade::processOrder($_POST['order_id']);
		//Datos a devolver
		echo json_encode(array("res" => "ok", "msg" => 'ok'));
		
		break;
		
		
		
	
	/***Favoritos***/
    case 'add-wish':
		UserFacade::addFavourite($_POST['book_id'], $_POST['book_lang']);
		//Devolvemos los datos
		echo json_encode(array("res" => "ok", "msg" => 'faved'));
		break;
	case 'rem-wish':
		UserFacade::removeFavourite($_POST['book_id'], $_POST['book_lang']);
		//Devolvemos los datos
		echo json_encode(array("res" => "ok", "msg" => 'unfaved'));
		break;
		
		
	
	/***Registrar libro***/
	case 'newBook':
		Utilidades::_log('vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv');
		Utilidades::traza($_POST);
		Utilidades::_log('^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^');
		
		$book_id = (isset($_POST['book_id']) ? $_POST['book_id'] : null);
		
		$author_id = AuthorFacade::getAuthorId($_POST['_author']);
		$genre_id = GenreFacade::getGenreId($_POST['_genre']);
		$saga_id = null;
		if(isset($_POST['_saga']) && '' != $_POST['_saga'])
			$saga_id = SagaFacade::getSagaId($_POST['_saga']);
		
		$publisher = (isset($_POST['_publisher']) ? $_POST['_publisher'] : null);
		$publishDate = (isset($_POST['_publishDate']) ? $_POST['_publishDate'] : null);
		$visible = (isset($_POST['visible']) ? 1 : 0);//Valor del checkbox
		
		$cover_path = '';
		
		//Se guarda la imagen en el servidor
		$uploaddir = Utilidades::getRoot().'/img/books/';
		$uploadfile = $uploaddir . basename($_FILES['cover']['name']);

		echo "<p>";

		if (move_uploaded_file($_FILES['cover']['tmp_name'], $uploadfile)) {
			Utilidades::_log("File is valid, and was successfully uploaded.\n");
		} else {
		   Utilidades::_log("Upload failed");
		}
		//Se guarda su nombre
		$cover_path = $_FILES['cover']['name'];
		// Utilidades::_log('vvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv');
		// Utilidades::traza($_FILES);
		// Utilidades::_log('^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^');
		
		
		BookFacade::newBook($author_id, $genre_id, $saga_id, $_POST['rating'], 
			$_POST['_price'], 0,$book_id,$_POST['_lang'],$_POST['_isbn'],
			$cover_path,$_POST['_title'],$_POST['_synopsis'],$_POST['_stock'],
			$visible,$publisher,$publishDate);
		
		
		
			
		echo json_encode(array("res" => "ok", "msg" => 'ok'));
		break;
		
	
	
	
	
    default:
		echo '';
}





?>