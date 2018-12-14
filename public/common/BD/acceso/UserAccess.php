<?php
require_once(__DIR__.'/../DB.php');
require_once(__DIR__.'/../objetos/DAO/UserDAO.php');
require_once(__DIR__.'/../../includes/Utilidades.php');


/*********************************************************
 * Clase para interactuar con la tabla user
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
	
}

?>