<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/UserDAO.php');
require_once(__DIR__.'/../../includes/Utilidades.php');


/*********************************************************
 * Clase para interactuar con las tablas user, favourites, orders y order_books
 *********************************************************/
class UserAccess{

	/**
	 * Recupera un usuario por su id
	 */ 
	function findById($id){
		Utilidades::_log("findById($id)");
		$query = "SELECT id,name,account,surnames,email,pass,address,access
					FROM user WHERE id = $id";
		$row = DB::ejecutarConsulta($query);
		
		return new UserDAO($row[0]);
	}
	
	/**
	 * Comprueba credenciales
	 * Devuelve usuario si existe y la clave es correcta
	 * Sino devuelve null
	 */
	function findUser($acc,$pass){
		Utilidades::_log("findUser($acc,***)");
		$db=DB::conectar();
		$select=$db->prepare('SELECT * FROM user WHERE account=:account');
		$select->bindValue('account',$acc);
		$select->execute();
		$row=$select->fetch();
		$user = null;
		//Verifica si la clave es correcta
		if (password_verify($pass, $row['pass'])){
			//Si es correcta
			$user=new UserDAO($row);
			Utilidades::_log('pass Correcta');
		}
		Utilidades::_log('id: '.$row['id']);
		return $user;
	}
	/**
	 * Insertar usuario
	 */
	public function insert($user){
		Utilidades::_log("Insertar usuario: ".$user->getAccount());
		
		$query = 'INSERT INTO user ';
		$campos = '(account,pass';
		$values = 'VALUES(:account,:pass';
		
		if(null != $user->getName()){
			$campos.= ',name';
			$values.= ',:name';
		}
		if(null != $user->getSurnames()){
			$campos.= ',surnames';
			$values.= ',:surnames';
		}
		if(null != $user->getEmail()){
			$campos.= ',email';
			$values.= ',:email';
		}
		if(null != $user->getAddress()){
			$campos.= ',address';
			$values.= ',:address';
		}
		if(null != $user->getAccess()){
			$campos.= ',access';
			$values.= ',:access';
		}
		//Cerramos campos
		$campos.= ') ';
		$values.= ') ';
		//Concatenamos query
		$query.= $campos.$values;
		
		Utilidades::_log("Query: ".$query);
		
		$db=DB::conectar();//Devuelve conexión
		$insert=$db->prepare($query);
					
		$insert->bindValue('account',$user->getAccount());
		if(null != $user->getName())
			$insert->bindValue('name',$user->getName());
		if(null != $user->getSurnames())
			$insert->bindValue('surnames',$user->getSurnames());
		if(null != $user->getEmail())
			$insert->bindValue('email',$user->getEmail());
		if(null != $user->getAddress())
			$insert->bindValue('address',$user->getAddress());
		if(null != $user->getAccess())
			$insert->bindValue('access',$user->getAccess());
		//Encripta la clave
		$pass=password_hash($user->getPass(),PASSWORD_DEFAULT);
		$insert->bindValue('pass',$pass);
		$insert->execute();
		
		Utilidades::_log("Insertado.");
	}
	
	
	/**
	 * Comprueba si ya existe una cuenta con ese nombre
	 */
	public function existeUser($acc){
		Utilidades::_log("existeUser($acc)");
		$db=DB::conectar();
		$select=$db->prepare('SELECT * FROM user WHERE account=:account');
		$select->bindValue('account',$acc);
		$select->execute();
		$registro=$select->fetch();
		if(null != registro['id']){
			$usado=False;
		}else{
			$usado=True;
		}	
		return $usado;
	}
	
	
	
	
	
	/********************************************
	 * Métodos para gestionar favoritos
	 ********************************************/
	 
	/**
	 * Comprueba si ya está como favorito
	 */
	public function isFavourite($book_id,$book_lang){
		$user_id = $_SESSION['activeUser']->getId();
		Utilidades::_log("isFavourite($user_id, $book_id, $book_lang)");
		
		$query = 'SELECT * FROM favourites
					WHERE user_id = :user_id
					  AND book_id = :book_id
					  AND book_lang = :book_lang';
		$db=DB::conectar();//Devuelve conexión
		$select=$db->prepare($query);
		//Bind values
		$select->bindValue('user_id',$user_id, PDO::PARAM_INT);
		$select->bindValue('book_id',$book_id, PDO::PARAM_INT);
		$select->bindValue('book_lang',$book_lang, PDO::PARAM_STR);
		
		$select->execute();
		Utilidades::_log("rowCount: ".$select->rowCount());
		if ($select->rowCount() > 0) {//True si hay resultados
			Utilidades::_log('true');
			return true;
		}else {
			Utilidades::_log('false');
			return false;
		}
	}
	
	/**
	 * Añade un favorito de un usuario
	 */
	public function addFavourite($book_id, $book_lang){
		$user_id = $_SESSION['activeUser']->getId();
		Utilidades::_log("addFavourite($user_id, $book_id, $book_lang)");
		
		$query = 'INSERT INTO favourites (user_id,book_id,book_lang)
					VALUES (:user_id,:book_id,:book_lang)';
		$db=DB::conectar();//Devuelve conexión
		$insert=$db->prepare($query);
		//Bind values
		$insert->bindValue('user_id',$user_id);
		$insert->bindValue('book_id',$book_id);
		$insert->bindValue('book_lang',$book_lang);
		
		$insert->execute();
		
		Utilidades::_log("Insertado.");
	}
	 
	/**
	 * Elimina un favorito de un usuario
	 */
	public function removeFavourite($book_id, $book_lang){
		$user_id = $_SESSION['activeUser']->getId();
		Utilidades::_log("removeFavourite($user_id, $book_id, $book_lang)");
		
		$query = 'DELETE FROM favourites 
					WHERE user_id = :user_id
					  AND book_id = :book_id
					  AND book_lang = :book_lang';
		$db=DB::conectar();//Devuelve conexión
		$delete=$db->prepare($query);
		//Bind values
		$delete->bindValue('user_id',$user_id);
		$delete->bindValue('book_id',$book_id);
		$delete->bindValue('book_lang',$book_lang);
		
		$delete->execute();
		
		Utilidades::_log("Eliminado.");
	}
	
	/**
	 * Recupera todos los favoritos del usuario
	 */
	public function getFavoritos(){
		$user_id = $_SESSION['activeUser']->getId();
		Utilidades::_log("getFavoritos($user_id)");
		
		$query = "SELECT book.*, book_lang.*
					FROM favourites,book, book_lang
					WHERE favourites.user_id = $user_id
					  AND favourites.book_id = book.id
					  AND favourites.book_id = book_lang.book_id
					  and favourites.book_lang = book_lang.lang ";
		$query.= " ORDER BY sold DESC, rating DESC";
		
		Utilidades::_log("query: ".$query);
		$res = array();
		
		foreach(DB::ejecutarConsulta($query) as $row) {
			// Añadimos un objeto por cada elemento obtenido
			$res[] = new BookVO($row);
		}
		return $res;
	}
	
	
}

?>