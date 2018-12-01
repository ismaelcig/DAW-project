<?php

/**
 * Clase con variables generales de la tabla book
 */
class BookDAO {
    protected $id;//Decimal
    protected $author;//id
    protected $genre;//id
	protected $saga;//id
	protected $rating;//decimal
	protected $price;//decimal
	protected $sold;//int
	//Otros (Páginas, Dimensiones, Fecha Publicación, Editorial, Ranking)
	
	/**Getters/Setters**/
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
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

	public function getPrice(){
		return $this->price;
	}

	public function setPrice($price){
		$this->price = $price;
	}

	public function getSold(){
		return $this->sold;
	}

	public function setSold($sold){
		$this->sold = $sold;
	}
	
    
    
    public function __construct($row) {
        $this->id = $row['id'];
        $this->author = $row['author'];
        $this->genre = $row['genre'];
        $this->saga = $row['saga'];
        $this->rating = $row['rating'];
        $this->price = $row['price'];
        $this->sold = $row['sold'];
    }
}


/**
 * Clase que incluye book y book_lang
 */
class BookLangDAO extends BookDAO{
    //protected $book_id;//Decimal
	protected $lang;//String ('ES', 'EN')
	protected $isbn;//String
    protected $cover;//String ruta
    protected $title;//String
	protected $synopsis;//String
	protected $stock;//int
	protected $visible;//boolean
	
	/**Getters/Setters**/
	public function getBookId(){
		return $this->book_id;
	}

	public function setBookId($book_id){
		$this->book_id = $book_id;
	}

	public function getLang(){
		return $this->lang;
	}

	public function setLang($lang){
		$this->lang = $lang;
	}

	public function getIsbn(){
		return $this->isbn;
	}

	public function setIsbn($isbn){
		$this->isbn = $isbn;
	}

	public function getCover(){
		return $this->cover;
	}

	public function setCover($cover){
		$this->cover = $cover;
	}

	public function getTitle(){
		return $this->title;
	}

	public function setTitle($title){
		$this->title = $title;
	}

	public function getAuthor(){
		return $this->author;
	}

	public function setAuthor($author){
		$this->author = $author;
	}

	public function getSynopsis(){
		return $this->synopsis;
	}

	public function setSynopsis($synopsis){
		$this->synopsis = $synopsis;
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
	
    
    
    public function __construct($row) {
        $this->id = $row['id'];
        $this->author = $row['author'];
        $this->genre = $row['genre'];
        $this->saga = $row['saga'];
        $this->rating = $row['rating'];
        $this->price = $row['price'];
        $this->sold = $row['sold'];
        //$this->book_id = $row['book_id'];
        $this->lang = $row['lang'];
        $this->isbn = $row['isbn'];
        $this->cover = $row['cover'];
        $this->title = $row['title'];
        $this->synopsis = $row['synopsis'];
        $this->stock = $row['stock'];
        $this->visible = $row['visible'];
    }
}


?>