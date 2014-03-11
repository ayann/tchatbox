<?php  
	require 'class/db.php';
	$query="SELECT * FROM users WHERE id!=1 AND sign_in=1";
	$res=$DB->query($query);
	if($res){
		while($data = $res->fetch(PDO::FETCH_OBJ)) {
			?>
				<li><a href="#" data-Id="<?php echo $data->id; ?>"><?php echo $data->pseudo; ?></a></li>
			<?php
		}
	}
?>