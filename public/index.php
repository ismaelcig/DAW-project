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
		<!--Productos-->
		<div id="a" class="container-fluid">
			<div class="container">
				<?php
					//TODO: Cargar libros
					include_once ('common/includes/book-item.php');
					include_once ('common/BD/fachadas/BookFacade.php');
					include_once ('common/BD/objetos/VOs/BookVO.php');
					foreach(findAllBooks() as $b) {
					//foreach(findBookItems(null,null,null,null) as $b) {
						createBookItem(new BookVO($b));
					}
				?>
			</div>
		</div>
		
		
		
		
		
	</body>
</html>