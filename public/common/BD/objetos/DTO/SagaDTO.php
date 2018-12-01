<?php

/**
 * Clase preparada para recoger todos los datos de una Saga. 
 * Tablas: saga.
 */

class SagaDTO {
	protected $id;//id
	protected $name;//String
    
	/**Getters/Setters**/
    public function getId() {return $this->id; }
    public function setId($id) {$this->id = $id; }
	
    public function getName() {return $this->name; }
    public function setName($name) {$this->name = $name; }
    
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }
}

?>