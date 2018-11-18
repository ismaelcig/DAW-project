<?php

class Book {
    protected $iban;//String
    protected $title;//String
    protected $cover;//String ruta
    protected $author;//id
    protected $genre;//id
	//protected $tipo;//String('tapa dura', 'de bolsillo'...)
	protected $language;//String ('es', 'en', 'it')
	protected $saga;//Saga/Trilogia
	protected $rating;//decimal
	protected $synopsis;//String
	protected $price;//decimal
	protected $stock;//int
	protected $visible;//boolean
	//Otros (Páginas, Dimensiones, Fecha Publicación, Editorial, Ranking)
	
	public function getIban(){
		return $this->iban;
	}

	public function setIban($iban){
		$this->iban = $iban;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getCover(){
		return $this->cover;
	}

	public function setCover($cover){
		$this->cover = $cover;
	}

	public function getAuthor(){
		return $this->author;
	}

	public function setAuthor($author){
		$this->author = $author;
	}

	public function getGenre(){
		return $this->genre;
	}

	public function setGenre($genre){
		$this->genre = $genre;
	}

	// public function getTipo(){
		// return $this->tipo;
	// }

	// public function setTipo($tipo){
		// $this->tipo = $tipo;
	// }

	public function getLanguage(){
		return $this->language;
	}

	public function setLanguage($language){
		$this->language = $language;
	}

	public function getSaga(){
		return $this->saga;
	}

	public function setSaga($saga){
		$this->saga = $saga;
	}

	public function getRating(){
		return $this->rating;
	}

	public function setRating($rating){
		$this->rating = $rating;
	}

	public function getSynopsis(){
		return $this->synopsis;
	}

	public function setSynopsis($synopsis){
		$this->synopsis = $synopsis;
	}

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}

	public function getStock(){
		return $this->stock;
	}

	public function setStock($stock){
		$this->stock = $stock;
	}

	public function getVisible(){
		return $this->visible;
	}

	public function setVisible($visible){
		$this->visible = $visible;
	}
	
    
    //public function getcodigo() {return $this->codigo; }
    
    public function __construct($row) {
        $this->iban = $row['iban'];
        $this->title = $row['title'];
        $this->cover = $row['cover'];
        $this->author = $row['author'];
        // $this->tipo = $row['tipo'];
        $this->language = $row['language'];
        $this->saga = $row['saga'];
        $this->rating = $row['rating'];
        $this->synopsis = $row['synopsis'];
        $this->price = $row['price'];
        $this->stock = $row['stock'];
        $this->visible = $row['visible'];
    }
}

?>