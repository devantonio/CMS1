<?php session_start(); ?>
<?php include "db.php"; ?>
<?php include "../functions.php"; ?>


<?php 

	if(isset($_POST['login'])) {
		
		login_user($_POST['username'],$_POST['password']);
		header("Location: /cms_template");
	}
 ?>