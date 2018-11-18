<html>
	<head>
		<title>Librería Online</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<?php 
		/**
		 * Página principal.
		 * 
		 * @author Ismael Conde Iglesias <ismaelci@outlook.es>
		 * @version 1.0
		 */
			include ("common/Libro.php");
			include ("common/DB.php");
		?>
		<div id="header">
			
		</div>
		<div id="container">
			<div id="container-Header">
				<h2>Últimos Libros</h2>
			</div>
			<div id="book-items">
				<div class="book-item">
					<div class="item-img">
						<a href="#">
							<img src="https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/mid/9780/0995/9780099590088.jpg" alt="Sapiens">
						</a>
					</div>
					<div class="item-info">
						<h3 class="item-title">
							<a href="#">Sapiens</a><br>
						</h3>
						<p class="item-author">
							<a href="#">Yuval Noah Harari</a>
						</p>
						<p class="item-price">9,99€</p>
					</div>
					<div class="item-action">
						<a href="#" class="add-basket">Añadir al carro</a>
					</div>
				</div>
				<div class="book-item">
					<div class="item-img">
						<a href="#">
							<img src="https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/mid/9780/1419/9780141986005.jpg" alt="Good Night Stories for Rebel Girls">
						</a>
					</div>
					<div class="item-info">
						<h3 class="item-title">
							<a href="#">Good Night Stories for Rebel Girls</a><br>
						</h3>
						<p class="item-author">
							<a href="#">Elena Favilli</a>
						</p>
						<p class="item-price">21,25€</p>
					</div>
					<div class="item-action">
						<a href="#" class="add-basket">Añadir al carro</a>
					</div>
				</div>
				<div class="book-item">
					<div class="item-img">
						<a href="#">
							<img src="https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/mid/9781/7873/9781787330870.jpg" alt="21 Lessons for the 21st Century">
						</a>
					</div>
					<div class="item-info">
						<h3 class="item-title">
							<a href="#">21 Lessons for the 21st Century</a>
						</h3>
						<p class="item-author">
							<a href="#">Yuval Noah Harari</a>
						</p>
						<p class="item-price">15,90€</p>
					</div>
					<div class="item-action">
						<a href="#" class="add-basket">Añadir al carro</a>
					</div>
				</div>
				<div class="book-item">
					<div class="item-img">
						<a href="#">
							<img src="https://d1w7fb2mkkr3kw.cloudfront.net/assets/images/book/mid/9780/0993/9780099302780.jpg" alt="Guns, Germs And Steel">
						</a>
					</div>
					<div class="item-info">
						<h3 class="item-title">
							<a href="#">Guns, Germs And Steel</a>
						</h3>
						<p class="item-author">
							<a href="#">Jared Diamond</a>
						</p>
						<p class="item-price">12,90€</p>
					</div>
					<div class="item-action">
						<a href="#" class="add-basket">Añadir al carro</a>
					</div>
				</div>
			</div>
		</div>
			
			
			
		
	</body>
</html>