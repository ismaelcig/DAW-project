<?php

class BookItem{
	/**
	 * Función que recibe el rating de un libro
	 * y devuelve el html con las estrellas para indicarlo visualmente
	 */
	function getHtmlStars($rating){
		$res = '';
		for($i=1; $i<=5; $i++){
			if($i<=$rating){
				//Imprime estrella roja
				$res.='<label for="stars-rating-'.$i.'"><i class="fa fa-star text-danger"></i></label>';
			}
			else{//Imprime estrella amarilla
				$res.='<label for="stars-rating-'.$i.'"><i class="fa fa-star text-warning"></i></label>';
			}
		}
		return $res;
	}

	/**
	 * Función que imprime una etiqueta especial sobre el libro
	 * (Descuentos, últimas uds....)
	 */
	function getSpecial($book){
		//Últimas uds.
		if($book->getStock() == 0){
			return '<span id="noStock" class="tag3 oos">No Stock</span>';
		}else if($book->getStock() < 10){
			return '<span id="lastUds" class="tag3 lastUds">Last Uds</span>';
		//Más vendido
		}else if(false){
			return '<span id="best" class="tag2 hot">Best-Seller</span>';
		}
	}
}
?>