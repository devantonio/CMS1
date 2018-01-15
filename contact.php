
 <?php  include "includes/header.php"; ?>
<!-- Navigation -->
    
    <?php  include "includes/nav.php"; ?>

<?php



    if(isset($_POST['submit'])) {

        ini_set("SMTP","ssl://smtp.gmail.com");
   ini_set("smtp_port","587");
   ini_set("sendmail_from","tonio.ae91@gmail.com");

        $msg = wordwrap($msg,70);
        
        // $to       = escape($_POST['username']);
        $subject  = wordwrap(escape($_POST['subject'],70));
        $body     = escape($_POST['body']);
        $header   = "From: " . escape($_POST['email']);

        


        // send email
mail("tonio.ae21@gmail.com", $subject, $body, $header);
}
?>


    
    
 
    <!-- Page Content -->
    <div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Contact</h1>
                    <form role="form" action="contact.php" method="post" id="login-form" autocomplete="off">
                        <h6 class="text-center"></h6>
                        
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                        </div>

                         <div class="form-group">
                            <label for="subject" class="sr-only">Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                        </div>

                         <div class="form-group">
                            <textarea name="body" id="body" class="form-control" cols="40" rows="10"></textarea>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
