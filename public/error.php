<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php
			require_once ('common/includes/heading.html');//Se incluye head
			session_start();
		?>
		<title>Error</title>
	</head>
	<body>
		<span id="lang" class="hidden"><?php if(isset($_SESSION['lang'])) echo $_SESSION['lang']; else echo 'EN';?></span>
		<header>
			<h1>
				<span id="sorryTitle">We are sorry :(</span><br/>
				<small class="text-muted">
					<span id="sorrySubtitle">It seems like there was an error</span>
				</small>
			</h1>
		</header>
		
		<div class="container">
			<?php 
				$msgId = (isset($_GET['msg']) ? $_GET['msg'] : '');
			?>
			<!--Si llega un mensaje-->
			<div class="<?php if('' == $msgId) echo 'hidden';?>">
				<h2>
					<span id="<?php echo $msgId;?>"></span>
				</h2>
			</div>
			<!--Si no llega-->
			<div class="<?php if('' != $msgId) echo 'hidden';?>">
				<img src="img/technical_support.png" ><br/>
				<span id="techSupport">Our best employer is working on it.</span>
			</div>
			<!--Volver a index.php-->
			<div>
				<a class="btn btn-primary" href="index.php">
					<span id="back">Go back</span>
				</a>
			</div>
		</div>
		
	</body>
</html>