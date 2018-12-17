<!DOCTYPE html>
<html>
	<head>
		<?php 
		/**
		 * Página principal.
		 * 
		 * @author Ismael Conde Iglesias <ismaelci@outlook.es>
		 * @version 1.0
		 */
			require_once ('common/includes/heading.html');//Se incluye head
			require_once ('common/includes/Utilidades.php');
			require_once ('common/BD/fachadas/BookFacade.php');
			require_once ('common/BD/fachadas/UserFacade.php');
			require_once ('common/BD/objetos/VO/BookVO.php');
			require_once ('common/BD/objetos/DTO/OrderDTO.php');
			Utilidades::_log('Entra ------->index.php<-------');

			//Comenzar session (inicializa variables de sesión)
			Utilidades::initSession();
			
		?>
		<title>BookWorld</title>
		<!--CSS de esta página-->
		<link rel="stylesheet" href="css/master.css">
		<link rel="stylesheet" href="css/book-item.css">
		<!--JS específico-->
		<script type="text/javascript" src="js/index.js"></script>
	</head>
	<body>
		<!--Barra navegación-->
		<?php require_once ('common/includes/navbars.html'); ?>
		<!--Libros-->
		<div id="container" class="container-fluid">
			<div id="book-items" class="container">
				<?php
					/***Cargar libros***/
					
					$list = null;//Libros a cargar
					
					//Si hay que cargar la lista de favoritos
					if(isset($_GET['favList']) && isset($_SESSION['activeUser'])){
						$user_id = $user->getId();
						$list = UserFacade::getFavoritos();
						
					}else{//Variables por las que se filtra
						$genre   = Utilidades::get('genre');
						$author  = Utilidades::get('author');
						$minPrice= Utilidades::get('min');
						$maxPrice= Utilidades::get('max');
						
						$list = BookFacade::findBy($genre, $author, $minPrice, $maxPrice);
					}
					
					//Cargamos la lista
					foreach($list as $bookVO)
					{//Se crea una caja por cada libro
						include('common/includes/book-item.html');
					}
				?>
			</div>
			
			
			<!--Botón Volver arriba-->
			<a id="back-to-top" class="btn btn-primary btn-lg back-to-top" 
				href="#" role="button">
					<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
		</div>
	</body>
</html>