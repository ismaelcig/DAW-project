<?php

class Libro {
    protected $iban;//String
    protected $titulo;//String
    protected $portada;//ruta?
    protected $autor;//String
	protected $tipo;//String('tapa dura', 'de bolsillo'...)
	protected $idioma;//String ('es', 'en', 'it')
	protected $saga;//Saga/Trilogia
	protected $rate;//decimal
	protected $descripcion;//String
	protected $precio;//decimal
	protected $stock;//int
	protected $visible;//boolean
	//Otros (Páginas, Dimensiones, Fecha Publicación, Editorial, Ranking)
	
	public function getIban(){
		return $this->iban;
	}

	public function setIban($iban){
		$this->iban = $iban;
	}

	public function getTitulo(){
		return $this->titulo;
	}

	public function setTitulo($titulo){
		$this->titulo = $titulo;
	}

	public function getPortada(){
		return $this->portada;
	}

	public function setPortada($portada){
		$this->portada = $portada;
	}

	public function getAutor(){
		return $this->autor;
	}

	public function setAutor($autor){
		$this->autor = $autor;
	}

	public function getTipo(){
		return $this->tipo;
	}

	public function setTipo($tipo){
		$this->tipo = $tipo;
	}

	public function getIdioma(){
		return $this->idioma;
	}

	public function setIdioma($idioma){
		$this->idioma = $idioma;
	}

	public function getSaga(){
		return $this->saga;
	}

	public function setSaga($saga){
		$this->saga = $saga;
	}

	public function getRate(){
		return $this->rate;
	}

	public function setRate($rate){
		$this->rate = $rate;
	}

	public function getDescripcion(){
		return $this->descripcion;
	}

	public function setDescripcion($descripcion){
		$this->descripcion = $descripcion;
	}

	public function getPrecio(){
		return $this->precio;
	}

	public function setPrecio($precio){
		$this->precio = $precio;
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
        $this->titulo = $row['titulo'];
        $this->portada = $row['portada'];
        $this->autor = $row['autor'];
        $this->tipo = $row['tipo'];
        $this->idioma = $row['idioma'];
        $this->saga = $row['saga'];
        $this->rate = $row['rate'];
        $this->descripcion = $row['descripcion'];
        $this->precio = $row['precio'];
        $this->stock = $row['stock'];
        $this->visible = $row['visible'];
    }
}

?>