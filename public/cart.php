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
			require_once(Utilidades::getRoot().'common/BD/objetos/DTO/OrderDTO.php');
			require_once(Utilidades::getRoot().'common/BD/objetos/VO/BookVO.php');
			Utilidades::_log('Entra ------->cart.php<-------');

			//Comenzar session (inicializa variables de sesión)
			Utilidades::initSession();
			Utilidades::requiredObj($_SESSION['activeUser']);//Obligatorio tener usuario
		?>
		<title>BookWorld</title>
		<!--CSS de esta página-->
		<link rel="stylesheet" href="css/cart.css">
		<!--JS específico-->
		<script type="text/javascript" src="js/cart.js"></script>
	</head>
	<body>
		<!--Barra navegación-->
		<?php require_once ('common/includes/navbars.html'); ?>
		<!--Carro-->
		<?php $isEmpty = (0 < sizeOf($_SESSION['cart']->getBookVOs()) ? false : true);//Para simplificar?>
		<div id="container" class="container">
			<div id="cart-container" class="row">
				<!--Si no hay items-->
				<h2 class="<?php if(!$isEmpty) echo 'hidden';?> text-center" style="margin-bottom: 20px;">
					<span id="emptyCart">Your cart is empty.</span>
				</h2>
				
				
				<!--Cabeceras-->
				<div class="col-md-12 col-xs-12 cabeceras <?php if($isEmpty) echo 'hidden';?>">
					<h4><span id="book" class="col-md-9 col-xs-9">Book</span></h4>
					<h4><span id="price" class="col-md-2 col-xs-2">Price</span></h4>
					<!--<h4><span id="quantity" class="col-md-2 col-xs-2">Quantity</span></h4>             -->
					<!--<h4><span id="subtotal" class="col-md-2 col-xs-2 text-center">Subtotal</span></h4> -->
					<span id="" class="col-md-1"></span>
				</div>
				
				
				<!--Lista Libros-->
				<div class="col-md-12 col-xs-12 <?php if($isEmpty) echo 'hidden';?>">
					<?php 
						//Cargar libros del carro
						foreach($_SESSION['cart']->getBookVOs() as $bookVO){
							include('common/includes/cart-item.html');
						}
					?>
				</div>
				
				
				<!--Footer-->
				<div class="col-md-12 col-xs-12">
					<div class="row">
						<!--Total-->
						<p class="col-xs-2 col-xs-offset-8 text-right <?php if($isEmpty) echo 'hidden';?>">
							<strong style="font-size: 20px;">
								<span id="total">Total</span>: 
								<?php echo Utilidades::getMoney($_SESSION['cart']->getTotal());?>
							</strong>
						</p>
						<!--Botón Seguir comprando-->
						<a href="index.php" class="col-sm-5 col-xs-6 btn btn-warning">
							<i class="fa fa-angle-left"></i> <span id="contShop">Continue Shopping</span>
						</a>
						<!--Botón Checkout-->
						<a href="#" id="checkout-btn"
							class="col-sm-5 col-sm-offset-2 col-xs-6 btn btn-success 
							<?php if($isEmpty) echo 'disabled';?>">
							<span id="checkout">Checkout</span> <i class="fa fa-angle-right"></i>
						</a>
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