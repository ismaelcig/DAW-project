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
			include_once ('common/includes/heading.html');//Se incluye head
		?>
	</head>
	<body>
		<!--Barra navegación-->
		<?php include_once ('common/includes/navbars.html'); ?>
		<!--Libros-->
		<div id="book-container" class="container-fluid">
			<div id="book-items" class="container">
				<?php
					//Cargar libros
					include_once ('common/includes/book-item.php');
					include_once ('common/BD/fachadas/BookFacade.php');
					include_once ('common/BD/objetos/VOs/BookVO.php');
					
					foreach(findBookItems(null,null,null,null) as $bVO) {
						createBookItem($bVO);
					}
				?>
			</div>
		</div>
		
		
		
		
		
	</body>
</html>