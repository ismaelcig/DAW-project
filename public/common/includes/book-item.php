<?php

/*********************************************************
 * Clase que crea un elemento html para mostrar por pantalla
 *********************************************************/
class BookItemHtml{
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
		if($book->getStock() < 10)
			return '<span id="lastUds" class="tag3 special">Last Uds</span>';
		//Más vendido
		else if(false)
			return '<span id="best" class="tag2 hot">Best-Seller</span>';
	}
	
	
	/**
	 * Recibe BookVO.
	 * Imprime html con los datos.
	 */
	function __construct($bookVO){
		echo
		'<div class="col-md-4 col-xs-6 product">
			<div class="prod-info-main prod-wrap clearfix">
				<div class="row">
					<div class="col-md-5 col-xs-5">
						<div class="product-image"> 
							<img src="img/books/'.$bookVO->getCover().'" onerror="this.src=\'img/books/default_cover.jpg\'" class="img-responsive"> '.
							self::getSpecial($bookVO).
						'</div>
					</div>
					<div class="col-md-7 col-xs-7">
						<div>
							<div class="product-detail">
								<h5 class="name">
									<a href="#">'.//Abrir página del libro
										$bookVO->getTitle().'
									</a>
									<a href="index.php?author='.$bookVO->getAuthor()->getId().'">
										<span>'.$bookVO->getAuthor()->getName().'</span>
									</a>
									<a href="index.php?genre='.$bookVO->getGenre()->getId().'">
										<span>'.$bookVO->getGenre()->getName().'</span>
									</a>
								</h5>
								<div class="product-info smart-form bottom">
									<div class="row">
										<div class="col-md-12">
											<div class="rating">'.
												self::getHtmlStars($bookVO->getRating()).
												' '.
												$bookVO->getRating().
											'</div>
										</div>
									</div>
									<div>
										<p class="price-container">
											<span>'.
											getMoney($bookVO->getPrice()).
											'</span>
										</p>
									</div>
								</div>
							</div>
						</div>
						<div class="btn-box">
							<div class="col-md-12"> 
								<a href="javascript:void(0);" class="btn btn-danger btn-padding">
									<span id="addCart">Add to Cart</span>
								</a>
								<a href="javascript:void(0);" class="btn btn-info btn-padding">
									<span id="infoL" class="full-text">More info</span>
									<span id="infoS" class="short-text">+Info</span>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';

	}
	
}
?>