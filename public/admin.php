<!DOCTYPE html>
<html>
	<head>
		<?php 
		/**
		 * Página de administración.
		 * 
		 * @author Ismael Conde Iglesias <ismaelci@outlook.es>
		 * @version 1.0
		 */
			require_once ('common/includes/heading.html');//Se incluye head
			require_once ('common/includes/Utilidades.php');
			require_once ('common/BD/fachadas/BookFacade.php');
			require_once ('common/BD/fachadas/UserFacade.php');
			require_once ('common/BD/fachadas/AuthorFacade.php');
			require_once ('common/BD/objetos/VO/BookVO.php');
			require_once ('common/BD/objetos/DTO/OrderDTO.php');
			Utilidades::_log('Entra ------->admin.php<-------');

			//Comenzar session (inicializa variables de sesión)
			Utilidades::initSession();
			
		?>
		<title>Admin</title>
		<!--CSS de esta página-->
		<!--<link rel="stylesheet" href="css/master.css">-->
		<link rel="stylesheet" href="css/admin.css">
		<!--JS específico-->
		<script type="text/javascript" src="js/admin.js"></script>
	</head>
	<body>
		<!--Barra navegación-->
		<?php //require_once ('common/includes/navbars.html'); ?>
		<span id="lang" class="hidden"><?php if(isset($_SESSION['lang'])) echo $_SESSION['lang']; else echo 'EN';?></span>
		
		
		<div class="container-fluid">
			<!--Pestañas-->
			<ul class="nav nav-tabs">
				<!--Pantalla inicio-->
				<li class="active"><a data-toggle="tab" href="#home">Home</a></li>
				<!--Opciones Libros-->
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<span id="books">Books</span> 
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li>
							<a data-toggle="tab" href="#book_new">
								<span id="newBook">New Book</span>
							</a>
						</li><!--
						<li>
							<a data-toggle="tab" href="#book_lang">
								<span id="books">New Language</span>
							</a>
						</li>--><!--
						<li>
							<a data-toggle="tab" href="#book_mod">
								<span id="books">Change/Delete</span>
							</a>
						</li> -->
					</ul>
				</li>
				<!--Opciones Usuarios--><!--
				<li><a href="#">Menu 2</a></li>-->
			</ul>
			<a href="index.php" class="btn btn-default float-right">
				<span id="goBack">Go Back</span>
			</a>
			
			
			
			<!--Contenido-->
			<div class="tab-content">
				<!--Pantalla inicio-->
				<div id="home" class="tab-pane fade in active">
					<h3 class="container text-center">
						<span id="pOrders">Pending Orders</span>
					</h3>
					<div class="container">
						<?php
							foreach(UserFacade::getPendingOrders() as $order){
								include('common/includes/order-item.html');
							}
						?>
					</div>
				</div>
				
				
				
				
				
				<!--Libros-->
				<!--Añadir libro-->
				<div id="book_new" class="tab-pane fade">
					<h3 class="container text-center">
						<span id="newBookHeader">Add a new Book</span>
					</h3>
					
					<form id="newBookForm" class="container form" role="form" method="post" 
						action="common/includes/book-functions.php" enctype="multipart/form-data">
						
						<!--Selector para añadir idioma de un libro que ya existe-->
						<div class="form-group row">
							<div class="col-md-8 col-sm-8 col-xs-12">
								<select name="book_id" class="form-control">
									<option value="">--<span id="basedOn">Based On</span>--</option>
									<?php 
										foreach(BookFacade::findAll() as $book){
											echo '<option value="'.$book->getId().'">'.
														$book->getTitle().
												 '</option>';
										}
									?>
								</select>
							</div>
						</div>
						<!--Título e idioma-->
						<div class="form-group row">
							<div class="col-md-8 col-sm-8 col-xs-12">
								<input name="_title" type="text" class="form-control"
									placeholder="Title" required>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-12">
								<select id="_lang" name="_lang" class="form-control col-md-2">
									<option value="EN"><span id="EN">English</span></option>
									<option value="ES"><span id="ES">Spanish</span></option>
								</select>
							</div>
						</div>
						<!--Autor y Género-->
						<div class="form-group row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="_author" type="text"  class="form-control" 
									placeholder="Author" required list="author-list" />
								<datalist id="author-list">
									<?php 
										foreach(AuthorFacade::findAll() as $a){
											echo '<option value="'.$a->getName().'">';
										}
									?>
								</datalist>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="_genre" type="text"  class="form-control" 
									placeholder="Genre" required list="genre-list" />
								<datalist id="genre-list">
									<?php 
										foreach(GenreFacade::findAll() as $g){
											echo '<option value="'.$g->getName().'">';
										}
									?>
								</datalist>
							</div>
						</div>
						<!--Saga y Rating-->
						<div class="form-group row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="_saga" type="text"  class="form-control" 
									placeholder="Saga" list="saga-list" />
								<datalist id="saga-list">
									<?php 
										foreach(SagaFacade::findAll() as $s){
											echo '<option value="'.$s->getName().'">';
										}
									?>
								</datalist>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12 rate-element">
								<div class="col-md-4 col-sm-4 row">
									<span id="rating">Rating</span>: <span id="rating-val"></span>
									<input type="hidden" name="rating" value="3">
								</div>
								<div class="slider-container col-md-8 col-sm-8">
									<input class="ratingSld" type="range" 
										min="1" max="5" value="3" step="0.1" id="sld">
								</div>
							</div>
						</div>
						<!--Synopsis-->
						<div class="form-group row">
							<div class="col-md-12 col-xs-12">
								<textarea  name="_synopsis" class="form-control" rows="5" 
									placeholder="Synopsis" required ></textarea>
							</div>
						</div>
						<!--ISBN y Portada-->
						<div class="form-group row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="_isbn" type="text" class="form-control" 
									placeholder="ISBN10" required>
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								<div class="col-md-3 col-sm-3">
									<span id="cover">Cover</span>: 
								</div>
								<div class="col-md-9 col-sm-9">
									<input type="file" name="cover" accept="image/*">
								</div>
							</div>
						</div>
						<!--Editorial y F.Publicación-->
						<div class="form-group row">
							<div class="col-md-6 col-sm-6 col-xs-12">
								<input name="_publisher" type="text" class="form-control" 
									placeholder="Publisher">
							</div>
							<div class="col-md-6 col-sm-6 col-xs-12">
								
								<input name="_publishDate" type="text" class="form-control" 
									placeholder="Publish Date (dd/mm/aaaa)">
							</div>
						</div>
						<!--Precio, Stock y Visible-->
						<div class="form-group row">
							<div class="col-md-4 col-sm-4 col-xs-4">
								<input name="_price" type="text" class="form-control" 
									placeholder="Price €" required>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<input name="_stock" type="number" class="form-control" 
									min="0" placeholder="Stock" required>
							</div>
							<div class="col-md-4 col-sm-4 col-xs-4">
								<input name="visible" class="form-check-input" 
									type="checkbox" checked>
								<span id="visible">Visible</span>
							</div>
						</div>
						<!--Botones-->
						<input type="hidden" name="action" value="newBook">
						<div class="form-group">
							<button type="submit" class="btn btn-primary btn-block">
								<span id="addNewBook">Add New Book</span>
							</button>
							<button type="reset" class="btn btn-default btn-block">
								<span id="clear">Clear</span>
							</button>
						</div>
						
					</form>
				</div>
				
				
				
				
				<!--Añadir libro en un nuevo idioma-->
				<div id="book_lang" class="tab-pane fade">
					<h3 class="container text-center">
						<span id="newLangHeader">Add book in another language</span>
					</h3>
					<p>Some content in menu 2.</p>
				</div>
				
				
				
				<!--Modificar/Eliminar libro existente-->
				<div id="book_mod" class="tab-pane fade">
					<h3 class="container text-center">
						<span id="modBookHeader">Update a book</span>
					</h3>
					<p>Some content in menu 2.</p>
				</div>
			</div>
		</div>
	</body>
</html>