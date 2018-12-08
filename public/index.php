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
			//Comenzar session (inicializa variables de sesión)
			Utilidades::initSession();
		?>
		<!--CSS de esta página-->
		<link rel="stylesheet" href="css/master.css">
	</head>
	<body>
		<!--Barra navegación-->
		<?php require_once ('common/includes/navbars.html'); ?>
		<!--Libros-->
		<div id="container" class="container-fluid">
			<div id="book-items" class="container">
				<?php
					/***Cargar libros***/
					require_once ('common/includes/book-item.php');
					require_once ('common/BD/fachadas/BookFacade.php');
					require_once ('common/BD/objetos/VOs/BookVO.php');
					//Variables por las que filtrar
					$genre   = Utilidades::get('genre');
					$author  = Utilidades::get('author');
					$minPrice= Utilidades::get('min');
					$maxPrice= Utilidades::get('max');
					
					foreach(
						BookFacade::
							findBy($genre, $author, $minPrice, $maxPrice)
						as $bVO)
					{
						new BookItemHtml($bVO);
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