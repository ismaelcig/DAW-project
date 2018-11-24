<?php
require_once(__DIR__.'/../../fachadas/AuthorFacade.php');
require_once(__DIR__.'/../Book.php');

class BookVO {
    protected $id;//Decimal
    protected $title;//String
    protected $cover;//String ruta
    protected $author;//Author
    protected $genre;//Genre
	protected $language;//String ('es', 'en', 'it')
	protected $saga;//Saga
	protected $rating;//decimal
	protected $synopsis;//String
	protected $price;//decimal
	protected $stock;//int
	protected $visible;//boolean
	//Otros (Páginas, Dimensiones, Fecha Publicación, Editorial, Ranking)
	
	/**Getters/Setters**/
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
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
	
    
    /**
	 * Recibe un objeto book y crea BookVO
	 */
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
    }
	
    /**
	 * Recibe un row desde la BD y crea BookVO
	 */
    public function __construct($row) {
		//Cubrimos los campos que nos lleguen
		$this->id = $row['id'];//Tiene que venir siempre
		if(isset($row['title'])){
			$this->title = $row['title'];
		}
		if(isset($row['cover'])){
			$this->cover = $row['cover'];
		}
		if(isset($row['author'])){
			$this->author = findAuthor($row['author']);
		}
		if(isset($row['genre'])){
			$this->genre = findGenre($row['genre']);
		}
		if(isset($row['language'])){
			$this->language = $row['language'];
		}
		if(isset($row['saga'])){
			$this->saga = findSaga($row['saga']);
		}
		if(isset($row['rating'])){
			$this->rating = $row['rating'];
		}
		if(isset($row['synopsis'])){
			$this->synopsis = $row['synopsis'];
		}
		if(isset($row['price'])){
			$this->price = $row['price'];
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