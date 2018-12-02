<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/master.css">
<?php 
			require_once ('common/includes/heading.html');//Se incluye head
			require_once ('common/includes/Utilidades.php');
			//Comenzar session (inicializa variables de sesión)
			initSession();
		?>
	<script type="text/javascript" src="js/prueba.js"></script>
</head>

<body>
<!--Barra navegación-->
<nav class="navbar navbar-inverse navbar-fixed-top">
	<div class="left">
		<!--Logo-->
		<a class="navbar-brand" href="prueba.php">
			<img src="img/logo.png" width="80" height="80" class="align-top" alt="">
		</a>
	</div>
	<div class="right">
		<!--Row1-->
		<div class="d-flex p-2">
			<div class="col-md-12 top-bar">
				<div class="container-fluid">
					<ul class="nav navbar-nav">
						<!--Contacto-->
						<li>
							<a href="#">
								<span class="glyphicon glyphicon-envelope move-icon"></span>
								Contact
							</a>
						</li>
						<!--Idioma-->
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<span id="language"></span>
								<span id="lang"><?php echo $_SESSION['lang']?></span>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu dropdown-content">
								<li><a href="prueba.php?lang=EN">EN - English</a></li>
								<li><a href="prueba.php?lang=ES">ES - Español</a></li>
							</ul>
						</li>
						<!--Moneda-->
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">
								<?php echo $_SESSION['currency']?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu dropdown-content">
								<li><a href="prueba.php?currency=EURO">EURO €</a></li>
								<li><a href="prueba.php?currency=USD">USD $</a></li>
							</ul>
						</li>
						<!--Prueba-->
						<li>
							<a id="asd" href="#">
								Espáñia
							</a>
						</li><!--
						<li>
							<form id="foo">
								<label for="bar">A bar</label>
								<input id="bar" name="bar" type="text" value="" />

								<input type="submit" value="Send" />
							</form>
						</li>-->
					</ul>
					
					<!--Account-->
					<ul class="nav navbar-nav navbar-right">
						<li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
						<li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</nav>























<div class="container">
	<div class="col-xs-12 col-md-6">
		<!-- First product box start here-->
		<div class="prod-info-main prod-wrap clearfix">
			<div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="product-image"> 
							<img src="img/p4.png" class="img-responsive"> 
							<span class="tag2 hot">
								HOT
							</span> 
						</div>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="product-deatil">
							<h5 class="name">
								<a href="#">
									Product Code/Name here
								</a>
								<a href="#">
									<span>Product Category</span>
								</a>                            

							</h5>
							<p class="price-container">
								<span>$199</span>
							</p>
							<span class="tag1"></span> 
					</div>
					<div class="description">
						<p>A Short product description here </p>
					</div>
					<div class="product-info smart-form">
						<div class="row">
							<div class="col-md-12"> 
								<a href="javascript:void(0);" class="btn btn-danger">Add to cart</a>
								<a href="javascript:void(0);" class="btn btn-info">More info</a>
							</div>
							<div class="col-md-12">
								<div class="rating">Rating:
									<label for="stars-rating-5"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-4"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-3"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-2"><i class="fa fa-star text-warning"></i></label>
									<label for="stars-rating-1"><i class="fa fa-star text-warning"></i></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end product -->
	</div>
	<div class="col-xs-12 col-md-6">
		<!-- First product box start here-->
		<div class="prod-info-main prod-wrap clearfix">
			<div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="product-image"> 
							<img src="img/p1.png" alt="194x228" class="img-responsive"> 
							<span class="tag2 hot">
								HOT
							</span> 
						</div>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="product-deatil">
							<h5 class="name">
								<a href="#">
									Product Code/Name here <span>Product Category</span>
								</a>
							</h5>
							<p class="price-container">
								<span>$50</span>
							</p>
							<span class="tag1"></span> 
					</div>
					<div class="description">
						<p>A Short product description here </p>
					</div>
					<div class="product-info smart-form">
						<div class="row">
							<div class="col-md-12"> 
								<a href="javascript:void(0);" class="btn btn-danger">Add to cart</a>
								<a href="javascript:void(0);" class="btn btn-info">More info</a>
							</div>
							<div class="col-md-12">
								<div class="rating">Rating:
									<label for="stars-rating-5"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-4"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-3"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-2"><i class="fa fa-star text-warning"></i></label>
									<label for="stars-rating-1"><i class="fa fa-star text-warning"></i></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end product -->
	</div>
	<div class="col-xs-12 col-md-6">
	<!-- First product box start here-->
		<div class="prod-info-main prod-wrap clearfix">
			<div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="product-image"> 
							<img src="img/p2.png" alt="194x228" class="img-responsive"> 
							<span class="tag3 special">
								Special
							</span> 
						</div>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="product-deatil">
							<h5 class="name">
								<a href="#">
									Product Code/Name here <span>Product Category</span>
								</a>
							</h5>
							<p class="price-container">
								<span>$299</span>
							</p>
							<span class="tag1"></span> 
					</div>
					<div class="description">
						<p>A Short product description here </p>
					</div>
					<div class="product-info smart-form">
						<div class="row">
							<div class="col-md-12"> 
								<a href="javascript:void(0);" class="btn btn-danger">Add to cart</a>
								<a href="javascript:void(0);" class="btn btn-info">More info</a>
							</div>
							<div class="col-md-12">
								<div class="rating">Rating:
									<label for="stars-rating-5"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-4"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-3"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-2"><i class="fa fa-star text-warning"></i></label>
									<label for="stars-rating-1"><i class="fa fa-star text-warning"></i></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end product -->
	</div>
	<div class="col-xs-12 col-md-6">
		<!-- First product box start here-->
		<div class="prod-info-main prod-wrap clearfix">
			<div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="product-image"> 
							<img src="img/p3.png" alt="194x228" class="img-responsive"> 
							<span class="tag2 sale">
								SALE
							</span> 
						</div>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="product-deatil">
							<h5 class="name">
								<a href="#">
									Product Code/Name here <span>Product Category</span>
								</a>
							</h5>
							<p class="price-container">
								<span>$1000</span>
							</p>
							<span class="tag1"></span> 
					</div>
					<div class="description">
						<p>A Short product description here </p>
					</div>
					<div class="product-info smart-form">
						<div class="row">
							<div class="col-md-12"> 
								<a href="javascript:void(0);" class="btn btn-danger">Add to cart</a>
								<a href="javascript:void(0);" class="btn btn-info">More info</a>
							</div>
							<div class="col-md-12">
								<div class="rating">Rating:
									<label for="stars-rating-5"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-4"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-3"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-2"><i class="fa fa-star text-warning"></i></label>
									<label for="stars-rating-1"><i class="fa fa-star text-warning"></i></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end product -->


			
	</div>


	<div class="col-xs-12 col-md-6">
		<!-- First product box start here-->
		<div class="prod-info-main prod-wrap clearfix">
			<div class="row">
					<div class="col-md-5 col-sm-12 col-xs-12">
						<div class="product-image"> 
							<img src="img/p3.png" alt="194x228" class="img-responsive"> 
							<span class="tag2 sale">
								SALE
							</span> 
						</div>
					</div>
					<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="product-deatil">
							<h5 class="name">
								<a href="#">
									Product Code/Name here <span>Product Category</span>
								</a>
							</h5>
							<p class="price-container">
								<span>$1000</span>
							</p>
							<span class="tag1"></span> 
					</div>
					<div class="description">
						<p>A Short product description here </p>
					</div>
					<div class="product-info smart-form">
						<div class="row">
							<div class="col-md-12"> 
								<a href="javascript:void(0);" class="btn btn-danger">Add to cart</a>
								<a href="javascript:void(0);" class="btn btn-info">More info</a>
							</div>
							<div class="col-md-12">
								<div class="rating">Rating:
									<label for="stars-rating-5"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-4"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-3"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-2"><i class="fa fa-star text-warning"></i></label>
									<label for="stars-rating-1"><i class="fa fa-star text-warning"></i></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end product -->
		


			
	</div>

	<div class="col-xs-12 col-md-6">
		<!-- First product box start here-->
		<div class="prod-info-main prod-wrap clearfix">
			<div class="row">
				<div class="col-md-5 col-sm-12 col-xs-12">
					<div class="product-image"> 
						<img src="img/p3.png" alt="194x228" class="img-responsive"> 
						<span class="tag2 sale">
							SALE
						</span> 
					</div>
				</div>
				<div class="col-md-7 col-sm-12 col-xs-12">
					<div class="product-deatil">
						<h5 class="name">
							<a href="#">
								Product Code/Name here <span>Product Category</span>
							</a>
						</h5>
						<p class="price-container">
							<span>$1000</span>
						</p>
						<span class="tag1"></span> 
					</div>
					<div class="description">
						<p>A Short product description here </p>
					</div>
					<div class="product-info smart-form">
						<div class="row">
							<div class="col-md-12"> 
								<a href="javascript:void(0);" class="btn btn-danger">Add to cart</a>
								<a href="javascript:void(0);" class="btn btn-info">More info</a>
							</div>
							<div class="col-md-12">
								<div class="rating">Rating:
									<label for="stars-rating-5"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-4"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-3"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-2"><i class="fa fa-star text-danger"></i></label>
									<label for="stars-rating-1"><i class="fa fa-star text-warning"></i></label>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- end product -->	
	</div>
	
	<?php
include_once ('common/BD/fachadas/AuthorFacade.php');
/*
$authors = AuthorFacade::findAll();
foreach($authors as $dto){
	echo '<h4>'.$dto->getId().': '.$dto->getName().'</h4>';
}*/
//echo '<h4>'.print_r(AuthorFacade::findById(15)).'</h4>';


?>

</div>

</body>
</html>