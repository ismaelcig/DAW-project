<!DOCTYPE html>
<html>
	<head>
		<?php
			require_once ('common/includes/heading.html');//Se incluye head
			session_start();
		?>
		<title>Bookworld</title>
		<!--JS-->
		<!--<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>-->
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

		<script type="text/javascript" src="js/signup.js"></script>
		<!--CSS-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="css/signup.css">
	</head>
	<body>
		<span id="lang" class="hidden"><?php if(isset($_SESSION['lang'])) echo $_SESSION['lang']; else echo 'EN';?></span>
		
		<form id="regForm" class="container form" role="form" method="post" action="login.php">
			<h3><span id="logInfo">Login Info</span>:</h3>
			<div class="form-group">
				<div class="form-group">
					<input name="_account" type="text" class="form-control" placeholder="Cool Unique Name" required>
				</div>
				<div class="form-group">
					<input id="_pass" name="_pass" type="password" class="form-control" placeholder="Password" required>
				</div>
					<div class="form-group">
					<input id="_pass2" name="_pass2" type="password" class="form-control" placeholder="Repeat Password" required>
				</div>
			</div>
			
			<hr>
			
			<h3>
				<div class="form-group">
					<span id="moreInfo">Additional Info</span>:<br/>
					<small class="text-muted"><span id="reqShip">Required for shipping</span></small>
				</div>
			</h3>
			<div class="form-group">
				<div class="form-group">
					<input name="_name" type="text" class="form-control" placeholder="Real Name">
				</div>
				<div class="form-group">
					<input name="_surnames" type="text" class="form-control" placeholder="Surnames">
				</div>
				<div class="form-group">
					<input name="_address" type="text" class="form-control" placeholder="Address">
				</div>
				<div class="form-group">
					<input name="_email" type="email" class="form-control" aria-describedby="emailHelp" placeholder="something@gmail.com">
					<small class="form-text text-muted"><span id="emailPriv">We'll never share your email with anyone else.</span></small>
				</div>
			</div>
			
			<hr>
			
			<input type="hidden" name="signup" value="signup">
			<div class="form-group">
				<button type="submit" class="btn btn-primary btn-block">
					<span id="signup">Sign Up</span>
				</button>
				<a href="index.php" class="btn btn-default btn-block">
					<span id="notNow">Not now</span>
				</a>
			</div>
			
		</form>
		
		
	</body>
</html>