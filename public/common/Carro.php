<?php
require_once('DB.php');

class Carro {
    protected $articulos = array();
    
    // Introduce un nuevo artículo en el carro de la compra
    public function nuevo_articulo($iban) {
        $libro = DB::consultaLibro($iban);
        $this->articulos[] = $libro;
    }
    
    // Obtiene los artículos en el carro
    public function get_articulos() { return $this->articulos; }
    
    // Obtiene el coste total de los artículos en el carro
    public function get_coste() {
        $coste = 0;
        foreach($this->articulos as $a) $coste += $a->getPrecio();
        return $coste;
    }
    
    // Devuelve true si la cesta está vacía
    public function vacia() {
        if(count($this->articulos) == 0) return true;
        return false;
    }
    
    // Guarda la cesta de la compra en la sesión del usuario
    public function guarda_cesta() { $_SESSION['cesta'] = $this; }
    
    // Recupera la cesta de la compra almacenada en la sesión del usuario
    public static function carga_cesta() {
        if (!isset($_SESSION['cesta'])) return new Carro();
        else return $_SESSION['cesta'];
    }
}

?>
