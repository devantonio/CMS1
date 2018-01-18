<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>



<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


// require './vendor/phpmailer/phpmailer/src/PHPMailer.php';
// require './vendor/phpmailer/phpmailer/src/exception.php';
// require './vendor/phpmailer/phpmailer/src/smtp.php';
// require './classes/config.php';//autoload in composer.json loads this automatically composer dump-autoload -o




    if(isset($_GET['forgot_password'])){

        redirect('index');

    }


    if(ifItIsMethod('post')){

        if(isset($_POST['email'])) {

            $email = $_POST['email'];

            $length = 50;

            $token = bin2hex(openssl_random_pseudo_bytes($length));


            if(email_exists($email)){


                if($stmt = mysqli_prepare($connection, "UPDATE users SET token ='{$token}' WHERE user_email= ?")){
                	
                    mysqli_stmt_bind_param($stmt, "s", $email);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_close($stmt);



                    /**
                     *
                     * configure PHPMailer
                     *
                     *
                     */
require './vendor/autoload.php';//requires all classes in classes folder

                    $mail = new PHPMailer(true);// Passing `true` enables exceptions

		//$mail->SMTPDebug = 2;
                    $mail->isSMTP();
                    $mail->Host = Config::SMTP_HOST;//the class in the classes folder
                    $mail->Username = Config::SMTP_USER;//the class in the classes folder
                    $mail->Password = Config::SMTP_PASSWORD;//the class in the classes folder
                    $mail->Port = Config::SMTP_PORT;//the class in the classes folder
                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPAuth = true;
                    $mail->isHTML(true);
                    $mail->Charset = 'UTF-8';//como estas 


                    $mail->setFrom('tonio.ae91@gmail.com', 'Antonio English');
                    $mail->addAddress($email);

                    $mail->Subject = 'This is a test email';

                    $mail->Body = '<p>Please click to reset your password

                    <a href="http://localhost:/cms_template/reset.php?email='.$email.'&token='.$token.' ">http://localhost:888/cms/reset.php?email='.$email.'&token='.$token.'</a>



                    </p>';


                        if($mail->send()) {
                        	$emailSent = true;
                        } else {
                        	echo "Email not sent";
                        }

    //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;






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


                        <?php if(!isset($emailSent)): ?>


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                            <?php else: ?>


                                <h2>Please check your email</h2>


                            <?php endIf; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer.php";?>

</div> <!-- /.container -->

