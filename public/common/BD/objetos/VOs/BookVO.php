<?php
require_once(__DIR__.'/../../fachadas/AuthorFacade.php');
require_once(__DIR__.'/../../fachadas/GenreFacade.php');
require_once(__DIR__.'/../../fachadas/SagaFacade.php');

class BookVO {
    protected $id;//Decimal
    protected $author;//Author
    protected $genre;//Genre
	protected $saga;//Saga
	protected $rating;//decimal
	protected $price;//decimal
	protected $sold;//int
	
	protected $lang;//String ('ES', 'EN')
	protected $isbn;//String
    protected $title;//String
    protected $cover;//String ruta
	protected $synopsis;//String
	protected $stock;//int
	protected $visible;//boolean
	
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
	
    
    /**
	 * Recibe un objeto bookDTO y crea BookVO
	 *//*
    public function bookToVo($book) {
        $this->id = $book->getId();
        $this->title = $book->getTitle();
        $this->cover = $book->getCover();
		if(null != $book->getAuthor()){
			$this->author = findAuthor($book->getAuthor());
		}
		if(null != $book->getGenre()){
			$this->genre = findGenre($book->getGenre());
		}
        $this->language = $book->getLanguage();
        $this->saga = $book->getSaga();
        $this->rating = $book->getRating();
        $this->synopsis = $book->getSynopsis();
        $this->price = $book->getPrice();
        $this->stock = $book->getStock();
        $this->visible = $book->getVisible();
    }*/
	
    /**
	 * Recibe un row y crea BookVO
	 */
    public function __construct($row) {
		//Cubrimos los campos que nos lleguen
		$this->id = $row['id'];//Tiene que venir siempre
		if(isset($row['author'])){
			$this->author = AuthorFacade::findById($row['author']);
		}
		if(isset($row['genre'])){
			$this->genre = GenreFacade::findById($row['genre']);
		}
		if(isset($row['saga'])){
			$this->saga = SagaFacade::findById($row['saga']);
		}
		if(isset($row['rating'])){
			$this->rating = $row['rating'];
		}
		if(isset($row['price'])){
			$this->price = $row['price'];
		}
		
		if(isset($row['lang'])){
			$this->lang = $row['lang'];
		}
		if(isset($row['isbn'])){
			$this->isbn = $row['isbn'];
		}
		if(isset($row['title'])){
			$this->title = $row['title'];
		}
		if(isset($row['cover'])){
			$this->cover = $row['cover'];
		}
		if(isset($row['synopsis'])){
			$this->synopsis = $row['synopsis'];
		}
		if(isset($row['stock'])){
			$this->stock = $row['stock'];
		}
		if(isset($row['visible'])){
			$this->visible = $row['visible'];
		}
    }
}

?>