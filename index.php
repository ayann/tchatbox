<?php 
	session_start();
	require 'pages/requires/is_log.php';
	loged(); 
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Tchat Box</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="stylesheets/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="stylesheets/css/styles.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<?php require 'requires/navbar.html'; ?>
		<div class="container">

			<?php include 'requires/notif.php'; ?>
			<div class="row">
				<div class="col-md-8 ">
					<div class="jumbotron">
					    <div class="container">
					        <p>Bienvenue sur Tchat Box le site de discussion instantanée qui vous rapproche. Retrouver vos proches, vos amis, vos collègues pour partager vos émotions ou travailler ou que ce soit et partout dans le monde</p>
					    	<img class="img-responsive" src="stylesheets/img/illus_tchat_02.png" alt="">
					    </div>
					</div>				
				</div>
				<div class="col-md-4">
					<a href="#" id="insLink" class="btn btn-default btn-lg btn-block">S'inscrire</a>
					<form role="form" id="formIns" action="pages/register.php" method="post" enctype="multipart/form-data">
					  	<div class="form-group">
						    <label for="Iemail">Addresse Email </label>
						    <input type="email" name="email" class="form-control" id="Iemail" placeholder="Enter email" required>
						</div>

						<div class="form-group">
						    <label for="Ipseudo">Pseudo</label>
						    <input type="text" name="pseudo" class="form-control" id="Ipseudo" placeholder="Enter pseudo" required>
						 </div>

					  	<div class="form-group">
					    	<label for="Imp">Mot de passe</label>
					    	<input type="password" name="mp" class="form-control" id="Imp" placeholder="Password" required>
					  	</div>

					  	<div class="form-group">
					    	<label for="Icmp">Confirmer Mot de passe</label>
					    	<input type="password" name="cmp" class="form-control" id="Icmp" placeholder="Password" required>
					  	</div>

					  	<div class="form-group">
					    	<label for="Iphoto">Photo</label>
					    	<input type="file" id="Iphoto" name="photo">
					    	<p class="help-block">Format acceptÃ© .jpg - .jpeg - .png</p>
					  	</div>

					  	<button type="submit" class="btn btn-success">S'inscrire</button>
					</form>
				</div>
			</div>

	     	<hr>

	      	<footer>
		        <p>&copy; Armand Niampa 2013</p>
	     	</footer>
		</div>
		<script src="stylesheets/js/jquery.js"></script>
		<script src="stylesheets/js/main.js"></script>
	</body>
</html>