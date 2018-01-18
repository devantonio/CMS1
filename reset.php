<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php 	
$verified = false;
	if(!isset($_GET['email']) && !isset($_GET['token'])) {
		redirect('index');
	}

// $email = 'sandy@yahoo.com';
// $token = '96e13c0eb166b30834717a633bc140959a687dc79fe2ec27b1fca149259c2bd088c4747ec9ad4b705b9022fc4a1678f83af3';

if($stmt = mysqli_prepare($connection, 'SELECT username, user_email, token FROM users WHERE token=?')) {

	mysqli_stmt_bind_param($stmt, "s", $_GET['token']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $username, $user_email, $token);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);

	//echo $username;

	if($_GET['token'] !== $token || $_GET['email'] !== $user_email) {
		
		redirect('index');
	}

	if(isset($_POST['password']) && isset($_POST['confirmPassword'])){
		if($_POST['password'] === $_POST['confirmPassword']) {
			$password = $_POST['password'];
			$hashedPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

			if($stmt = mysqli_prepare($connection, "UPDATE users SET token='', user_password='$hashedPassword' WHERE user_email= ? ")){//wedont need token anymore so set to nothing
				mysqli_stmt_bind_param($stmt, "s", $_GET['email']);
				mysqli_stmt_execute($stmt);

				if(mysqli_stmt_affected_rows($stmt) >= 1) {
					redirect('/cms_template/login.php');
				}

				mysqli_stmt_close($stmt);
				
			} 
		}
	}
}
 ?>



<!-- Page Content -->
<div class="container">

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">

                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Reset Password</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">

                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="password" name="password" placeholder="password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="confirmPassword" name="confirmPassword" placeholder="confirm password" class="form-control"  type="password">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <h2>Please check your email</h2>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

