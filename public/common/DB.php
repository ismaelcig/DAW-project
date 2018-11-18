<?php
require_once('Libro.php');

class DB {
	/**
	 * Recibe una query y la ejecuta
	 */
    protected static function ejecutaConsulta($sql) {
        $opc = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
        $dsn = "mysql:host=localhost;dbname=project";
        $user = 'isma';
        $pass = 'abc123.';
        
        $conn = new PDO($dsn, $usuario, $contrasena, $opc);
        $resultado = null;
        if (isset($conn)) $resultado = $conn->query($sql);
        return $resultado;
    }
	
	/**
	 * Recupera un libro directamente por su iban
	 */
	public static function consultarLibro($iban)
	{
		return consultarLibrosAllFilters($iban,null,null,null,null,
							null,null,null,null,null,null,null);
	}
	
	/**
	 * Busca libros por los filtros mas comunes
	 */
	public static function consultarLibros($iban,$titulo,$autor,$tipo,
		$idioma,$saga,$rate)
	{
		return consultarLibrosAllFilters($iban,$titulo,null,$autor,$tipo,
							$idioma,$saga,$rate,null,null,null,true);
	}
	

	/**
	 * Realiza la búsqueda de libros con los filtros que reciba
	 */
    public static function consultarLibrosAllFilters($iban,$titulo,$portada,
		$autor,$tipo,$idioma,$saga,$rate,$descripcion,$precio,$stock,$visible)
	{
        $sql = "SELECT iban,titulo,portada,autor,tipo,idioma,saga,"+ 
			"rate,descripcion,precio,stock,visible FROM producto";
			
		//Se añaden los filtros recibidos
		$filter = "";
		
		if(isset($iban))
			$filter = addFilter($filter, "iban", $iban);
		if(isset($titulo))
			$filter = addFilter($filter, "titulo", $titulo);
		if(isset($portada))
			$filter = addFilter($filter, "portada", $portada);
		if(isset($autor))
			$filter = addFilter($filter, "autor", $autor);
		if(isset($tipo))
			$filter = addFilter($filter, "tipo", $tipo);
		if(isset($idioma))
			$filter = addFilter($filter, "idioma", $idioma);
		if(isset($saga))
			$filter = addFilter($filter, "saga", $saga);
		if(isset($rate))
			$filter = addFilter($filter, "rate", $rate);
		if(isset($descripcion))
			$filter = addFilter($filter, "descripcion", $descripcion);
		if(isset($precio))
			$filter = addFilter($filter, "precio", $precio);
		if(isset($stock))
			$filter = addFilter($filter, "stock", $stock);
		if(isset($visible))
			$filter = addFilter($filter, "visible", $visible);
		if(!empty($filter))
			$sql.= " WHERE " . $filter;
		
		
		//Se ejecuta la consulta
        $resultado = self::ejecutaConsulta ($sql);
        $productos = array();

		if($resultado) {
            // Añadimos un elemento por cada producto obtenido
            $row = $resultado->fetch();
            while ($row != null) {
                $productos[] = new Producto($row);
                $row = $resultado->fetch();
            }
		}
        return $productos;
    }
	
	/**
	 * Añade un filtro a la query.
	 * Añade 'AND' si es necesario.
	 */
	public static function addFilter($query, $campo, $valor){
		$and = " AND ";
		if(isset($query) && isset($campo) && isset($valor)){
			if(!empty($query))
				$query.= $and;
			$query.= $campo . "=" . $valor;
			return $query;
		}
	}
    
	/**
	 * Comprueba si existe usuario/contraseña
	 */
    public static function verificaCliente($nombre, $contrasena) {
        $sql = "SELECT usuario FROM usuarios ";
        $sql .= "WHERE usuario='$nombre' ";
        $sql .= "AND contrasena='" . md5($contrasena) . "';";
        $resultado = self::ejecutaConsulta ($sql);
        $verificado = false;

        if(isset($resultado)) {
            $fila = $resultado->fetch();
            if($fila !== false) $verificado=true;
        }
        return $verificado;
    }
    
}

?>
