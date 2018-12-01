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
			initSession();
		?>
	</head>
	<body>
		<!--Barra navegación-->
		<?php require_once ('common/includes/navbars.html'); ?>
		<!--Libros-->
		<div id="book-container" class="container-fluid">
			<div id="book-items" class="container">
				<?php
					/***Cargar libros***/
					require_once ('common/includes/book-item.php');
					require_once ('common/BD/fachadas/BookFacade.php');
					require_once ('common/BD/objetos/VOs/BookVO.php');
					//Variables por las que filtrar
					$genre   = get('genre');
					$author  = get('author');
					$minPrice= get('min');
					$maxPrice= get('max');
					
					foreach(
						BookFacade::
							findBy($genre, $author, $minPrice, $maxPrice)
						as $bVO)
					{
						new BookItemHtml($bVO);
					}
				?>
			</div>
		</div>
		
		
		
		
		
	</body>
</html>