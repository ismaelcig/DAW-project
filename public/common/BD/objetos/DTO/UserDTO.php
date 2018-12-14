<?php

/**
 * Clase preparada para recoger todos los datos de un Usuario. 
 * Tablas: user.
 */

class UserDTO {
	protected $id;//id
	protected $account;//String
	protected $name;//String
	protected $surnames;//String
	protected $email;//String
	protected $pass;//String
	protected $address;//String
	protected $access;//String
    
	/**Getters/Setters**/
    public function getId() {return $this->id; }
    public function setId($id) {$this->id = $id; }
	
    public function getAccount() {return $this->account; }
    public function setAccount($account) {$this->account = $account; }
	
    public function getName() {return $this->name; }
    public function setName($name) {$this->name = $name; }
	
    public function getSurnames() {return $this->surnames; }
    public function setSurnames($surnames) {$this->surnames = $surnames; }
	
    public function getEmail() {return $this->name; }
    public function setEmail($email) {$this->name = $email; }
	
    public function getPass() {return $this->pass; }
    public function setPass($pass) {$this->pass = $pass; }
	
    public function getAddress() {return $this->address; }
    public function setAddress($address) {$this->address = $address; }
	
    public function getAccess() {return $this->access; }
    public function setAccess($access) {$this->access = $access; }
    
    
    public function init($id, $account, $name, $surnames, $email,
						$pass,$address,$access) {
        $this->id 		= $id;
        $this->account 	= $account;
        $this->name 	= $name;
        $this->surnames = $surnames;
        $this->email 	= $email;
        $this->pass 	= $pass;
        $this->address 	= $address;
        $this->access 	= $access;
    }   
	
    public function __construct() {}   
}       
        
?>