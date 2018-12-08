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
			
			//Comenzar session (inicializa variables de sesión)
			Utilidades::initSession();
			//Nos aseguramos de tener el id del libro
			Utilidades::required(array('id'));
			
			/***Cargar libro***/
			//Si ha llegado hasta aquí es que tenemos el id
			$id = $_GET['id'];
			$book = BookFacade::findById($id);
			//Nos aseguramos de que existe el libro
			Utilidades::requiredObj($book);
			
			$author = AuthorFacade::findById($book->getAuthor());
			$genre = GenreFacade::findById($book->getGenre());
		?>
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
				<div class="row main-container">
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
								//Últimas uds.
								if($book->getStock() == 0){
									echo '<div class="text-danger">
											<span class="glyphicon glyphicon-book"></span>
											<span id="outStock"></span>
										  </div>';
								}else if($book->getStock() < 10){
									echo '<div class="text-warning">
											<span class="glyphicon glyphicon-book"></span>
											<span id="uds">Books left</span>: '.$book->getStock().
										  '</div>';
								}else{
									echo '<div class="text-success">
											<span class="glyphicon glyphicon-book"></span>
											<span id="inStock"></span>
										  </div>';
								}
								//Más vendido
								if(false){
									return '<span id="best" class="tag2 hot">Best-Seller</span>';
								}
							?>
							</div>
						</div>
						
						<!--Botones-->
						<div class="btn-box">
							<a class="add-bucket" href="#">Añadir a la cesta</a>
							<a class="add-wish" href="#">Añadir a deseados</a>
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
						Detalles del libro
					</div>
					
				</div>
				<!--Relacionado con el Autor-->
				<div class="row">
					<div class="col-md-12 fixed-height" style="background-color: #ccceff;">
						Relacionado con el Autor
					</div>
				</div>
				<!--Otros/Relacionado con el Género-->
				<div class="row">
					<div class="col-md-12 fixed-height" style="background-color: #ccefff;">
						Otros/Relacionado con el Género
					</div>
				</div>
			</div>
			
			
			<!--Botón Volver arriba-->
			<a id="back-to-top" class="btn btn-primary btn-lg back-to-top" 
				href="#" role="button">
					<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
		</div>
	</body>
</html>