<?php

class GenreDAO {
    protected $id;//id
	protected $nameEN;//String
	protected $nameES;//String
    
	/**Getters/Setters**/
    public function getId() {return $this->id; }
    public function setId($id) {$this->id = $id; }
	
    public function getNameEN() {return $this->nameEN; }
    public function setNameEN($nameEN) {$this->nameEN = $nameEN; }
	
    public function getNameES() {return $this->nameES; }
    public function setNameES($nameES) {$this->nameES = $nameES; }
    
    public function __construct($row) {
        $this->id = $row['id'];
        $this->nameEN = $row['nameEN'];
        $this->nameES = $row['nameES'];
    }
}

?>