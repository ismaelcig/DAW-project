<!DOCTYPE html>
<html>
	<head>
		<?php 
		/**
		 * Página para mostrar un libro determinado.
		 * 
		 * @author Ismael Conde Iglesias <ismaelci@outlook.es>
		 * @version 1.0
		 */

			require_once ('common/includes/heading.html');//Se incluye head
			require_once ('common/includes/Utilidades.php');
			require_once ('common/BD/fachadas/BookFacade.php');
			require_once ('common/BD/fachadas/AuthorFacade.php');
			require_once ('common/BD/fachadas/GenreFacade.php');
			Utilidades::_log('Entra ------->book-page.php<-------');
			
			//Comenzar session (inicializa variables de sesión)
			Utilidades::initSession();
			//Nos aseguramos de tener el id del libro
			Utilidades::required(array('book'));
			
			/***Cargar libro***/
			//Si ha llegado hasta aquí es que tenemos el id
			$id = $_GET['book'];
			$book = BookFacade::findById($id);
			//Nos aseguramos de que existe el libro
			Utilidades::requiredObj($book);
			
			$author = AuthorFacade::findById($book->getAuthor());
			$genre = GenreFacade::findById($book->getGenre());
		?>
		<!--Icono-->
		<title><?php echo $book->getTitle();?></title>
		<!--JS específico-->
		<script type="text/javascript" src="js/book-page.js"></script>
		<!--CSS específico-->
		<link rel="stylesheet" href="css/book-page.css">
	</head>
	<body>
		<!--Barra navegación-->
		<?php require_once ('common/includes/navbars.html'); ?>
		<!--Libros-->
		<div id="container" class="container-fluid">
			<div class="container">
				<!--Bloque principal-->
				<div class="row section-container">
					<!--Img libro-->
					<div class="col-md-3 col-xs-7 fixed-height">
						<div class="book-image">
							<img src="img/books/<?php echo $book->getCover();?>" onerror="this.src=img/books/default_cover.jpg" class="img-responsive">
						</div>
					</div>
					
					<!--Caja de Pago-->
					<div class="col-md-3 col-md-push-6 col-xs-5 pay-box">
						<!--Mostramos el precio-->
						<p class="price">
							<span>
								<?php echo Utilidades::getMoney($book->getPrice())?>
							</span>
						</p>
						<!--Mostrar especiales-->
						<div id="specials">
							<div class="stock">
								<?php
								
									if($book->getStock() == 0){//En Stock
										echo '<div class="text-danger">
												<span class="glyphicon glyphicon-book"></span>
												<span id="outStock">Out of Stock</span>
											  </div>';
									}else if($book->getStock() < 10){//Últimas uds.
										echo '<div class="text-warning">
												<span class="glyphicon glyphicon-book"></span>
												<span id="uds">Books left</span>: '.$book->getStock().
											  '</div>';
									}else{//Agotado
										echo '<div class="text-success">
												<span class="glyphicon glyphicon-book"></span>
												<span id="inStock">In Stock</span>
											  </div>';
									}
									//Más vendido
									if(false){
										return '<span id="best" class="tag2 hot">Best-Seller</span>';
									}
								?>
								<div class="text-info">
									<span class="glyphicon glyphicon-plane"></span>
									<span id="freeShip">Free Shipment</span>
								</div>
							</div>
						</div>
						
						<!--Botones-->
						<div class="btn-box">
							<a class="btn add-bucket" <?php if($book->getStock()==0) echo 'disabled'?>
								href="#" role="button">
									<span id="addBucket">Add to bucket</span>
							</a>
							<a class="add-wish" href="#">
								<span id="addWish">Add to wishlist</span>
							</a>
						</div>
						
					</div>
					
					<!--Datos principales libro-->
					<div class="col-md-6 col-md-pull-3 col-xs-12 book-data">
						<h2><?php echo $book->getTitle();?></h2>
						<h4>
							<!--<span id="author">Author</span>: -->
							<?php echo $author->getName();?>
						</h4>
						<p class="synopsis">
							<?php echo $book->getSynopsis();?>
						</p>
						<a class="more-less"><span id="readMore">Read More</span></a>
						
						
					</div>
					
					
					
					<!--Detalles del libro-->
					<div class="col-md-12 col-xs-12 book-details">
						<h3><span id="details">Book Details</span></h3>
						<div class="row">
							<div class="col-md-3 col-xs-6">
								<span id="isbn" class="bold">ISBN</span>: <?php echo $book->getIsbn()?>
							</div>
							<div class="col-md-3 col-xs-6">
								<span id="language" class="bold">Language</span>: 
								<span id="<?php echo $book->getLang()?>"></span>
							</div><!--
							<div class="col-md-3 col-xs-6">
								<span id="saga" class="bold">Saga</span>: 
								<span id="<php echo $book->getSaga()->getName()?>"></span>
							</div>-->
							<div class="col-md-3 col-xs-6">
								<span id="publisher" class="bold">Publisher</span>: 
								<?php echo $book->getPublisher()?>
							</div>
							<div class="col-md-3 col-xs-6">
								<span id="publDate" class="bold">Publication Date</span>: 
								<?php echo $book->getPublish_date()?>
							</div>
						</div>
					</div>
					
				</div>
				<!--Relacionado con el Autor-->
				<div class="row section-container">
					<div class="col-md-12 fixed-height">
						<h3><span id="moreFromAuth">More from the Author</span></h3>
						<?php
							foreach(
								BookFacade::
									findBy(null, $book->getAuthor(), null, null)
								as $bookVO)
							{//Se crea una caja por cada libro
								include('common/includes/book-item-sm.html');
							}
						
						
						?>
						
					</div>
				</div>
				<!--Otros/Relacionado con el Género-->
				<div class="row section-container">
					<div class="col-md-12 fixed-height">
						<h3><span id="moreFromGenre">Others/Same Genre</span></h3>
					</div>
				</div>
			</div>
			
			
			
			
			
			
			
			
			
			<!--Botón Volver arriba-->
			<a id="back-to-top" class="btn btn-primary btn-lg back-to-top" 
				href="#" role="button">
					<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
			
			<!--Botones Anterior y Siguiente-->
			<div id="previous" class="change-book">
				<a class="btn btn-lg" role="button"
					<?php
						if($_GET['book']==1){//Ya es el primero
							echo ' disabled ';
							echo 'href="javascript:void(0);"';
						}else{
							/**Se hace esto con el fin de evitar
							 * tener que hacer una consulta a BD
							 * para ver cual es el siguiente libro*/
							echo 'href="?book='.($_GET['book']-1).'"';
						}
					?>
					>
						<span class="glyphicon glyphicon-chevron-left"></span>
				</a>
			</div>
			<div id="next" class="change-book">
				<a class="btn btn-lg" <?php if(false) echo 'disabled'?> role="button"
					href="?book=<?php echo $_GET['book']+1?>">
						<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
			
		</div>
	</body>
</html>