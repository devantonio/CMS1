<?php ob_start(); ?>
<?php session_start(); ?>

<?php 

		$_SESSION['username'] = null; //null cancels their session
		$_SESSION['firstname'] = null;
		$_SESSION['lastname'] = null;
		$_SESSION['user_role'] = null;

		header("Location: /cms_template");
 ?>