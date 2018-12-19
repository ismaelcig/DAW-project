<?php

/**
 * Clase preparada para recoger todos los datos de un Pedido. 
 * Tablas: order, order_books.
 */

class OrderDTO {
	protected $id;//id
	protected $user_id;//id
	protected $timeP;//Datetime
	protected $timeS;//Datetime
	protected $timeC;//Datetime
	protected $total;//Decimal
	protected $state;//String
	protected $bookVOs;//Lista de BookVO
	protected $address;
    
	/**Getters/Setters**/
    public function getId() {return $this->id; }
    public function setId($id) {$this->id = $id; }
	
    public function getUser_id() {return $this->user_id; }
    public function setUser_id($user_id) {$this->user_id = $user_id; }
	
    public function getTimeP() {return $this->timeP; }
    public function setTimeP($timeP) {$this->timeP = $timeP; }
	
    public function getTimeS() {return $this->timeS; }
    public function setTimeS($timeS) {$this->timeS = $timeS; }
	
    public function getTimeC() {return $this->timeC; }
    public function setTimeC($timeC) {$this->timeC = $timeC; }
	
    public function getTotal() {return $this->total; }
    public function setTotal($total) {$this->total = $total; }
    public function sumarTotal($x) {$this->total = ($this->total + $x); }
    public function restarTotal($x) {$this->total = ($this->total - $x); }
	
    public function getState() {return $this->state; }
    public function setState($state) {$this->state = $state; }
	
    public function getBookVOs() {return $this->bookVOs; }
    public function setBookVOs($bookVOs) {$this->bookVOs = $bookVOs; }
	
    public function getAddress() {return $this->address; }
    public function setAddress($address) {$this->address = $address; }
    
    
    public function init($id, $user_id, $timeP, $timeS, $timeC, 
							$total, $state, $bookVOs, $address) {
        $this->id 		= $id;
        $this->user_id 	= $user_id;
        $this->timeP 	= $timeP;
        $this->timeS 	= $timeS;
        $this->timeC 	= $timeC;
        $this->total 	= $total;
        $this->state 	= $state;
		$this->bookVOs	= $bookVOs;
		$this->address	= $address;
    }   
	
    public function __construct() {
		$this->total 	= 0;
        $this->state 	= 'P';//Pendiente, para cuando se inserte en BD
		$this->bookVOs	= array();
	}   
}       
        
?>