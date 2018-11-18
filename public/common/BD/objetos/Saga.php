<?php

class Saga {
    protected $id;//id
	protected $Name;//String
    
	/**Getters/Setters**/
    public function getId() {return $this->id; }
    public function setId($id) {$this->id = $id; }
	
    public function getName() {return $this->name; }
    public function setName($name) {$this->name = $name; }
    
    public function __construct($row) {
        $this->id = $row['id'];
        $this->name = $row['name'];
    }
}

?>