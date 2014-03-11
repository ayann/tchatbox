<?php 
	session_start(); 
	require 'requires/is_log.php';
	notlog();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>message</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link href="/discussion_instantanee/stylesheets/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="/discussion_instantanee/stylesheets/css/styles_msg.css" rel="stylesheet" media="screen">
	</head>
	<body>
	    <div class="jumbotron">
	      	<div class="container">
	      		<div class="row">
	      		  	<div class="col-xs-6 col-md-2">
	      		    	<div class="thumbnail">
	      		      		<img src="">
	      		    	</div>
	      		    	<br>
	      		  	</div>
	      		  
	      		  	<div class="btn-group" style="float:right;">
	      		  		<span id="monId" style="display:none"><?php echo $_SESSION['id'] ?></span>
	      		  		<a class="btn btn-default" href="">Mon Compte</a>
	      		  		<div class="btn-group">
		      		  	  	<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
		      		  	    	Membre en ligne <span class="caret"></span>
		      		  	  	</button>
		      		  	  	<ul class="dropdown-menu" role="menu">
		      		  	    	<?php  
		      		  	    		require 'class/db.php';
		      		  	    		$id=(int) injection($_SESSION['id']);
		      		  	    		$query="SELECT * FROM users WHERE id!=$id AND sign_in=1";
		      		  	    		$res=$DB->query($query);
		      		  	    		if($res){
		      		  	    			while($data = $res->fetch(PDO::FETCH_OBJ)) {
		      		  	    				?>
		      		  	    					<li>
		      		  	    						<a href="#" data-id="<?php echo $data->id; ?>">
		      		  	    							<?php echo $data->pseudo; ?>
			      		  	    					</a>
			      		  	    				</li>
		      		  	    				<?php
		      		  	    			}
		      		  	    		}
		      		  	    	?> 
		      		  	  	</ul>
		      		  	</div>
	      		  		<a class="btn btn-default" href="logout.php">Se deconnecter</a>
		      		</div>
	      		</div>
				<div class="" id="mlc">
				  	Liste des conversation
				</div>
				<div id="msg">
		
				</div>
			    <div class="col-md-8">
					<textarea name="msg" placeholder="Tapez votre message ..." class="form-control" rows="3"></textarea>
			    </div>
				<div class="col-md-4">
					<a id="send"class="btn btn-success" href="#">Envoyer un message</a>
				</div>
	      	</div>
	    </div>
	    <hr>
      	<footer>
	        <p>&copy; Armand Niampa 2013</p>
     	</footer>

		<script src="/discussion_instantanee/stylesheets/js/jquery.js"></script>
		<script src="/discussion_instantanee/stylesheets/js/bootstrap.min.js"></script>
		<script src="/discussion_instantanee/stylesheets/js/main_msg.js"></script>
	</body>
</html>