<?php 

if(IfItIsMethod('post')) {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        login_user($_POST['username'], $_POST['password']);
    } else {
        redirect('/cms_template');
    }
}


 ?>




<div class="col-md-4">

                


                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <form action="search.php" method="post">
                        <div class="">
                            <input name="search" type="text" class="form-control">
                            <span class="input-group-btn">
                                <button class="btn btn-default" name="submit" type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                            </button>
                            </span>
                        </div>
                    </form>
                    <!-- /.input-group -->
                </div>

                <!-- Login -->
                <div class="well">

                    
                    <?php if(isset($_SESSION['user_role'])): ?>
                        <h4>Logged in as <?php echo $_SESSION['username']; ?></h4>
                        <a href="includes/logout.php" class="btn btn-primary">Logout</a>
                    <?php else: ?>

                    <h4>Login</h4>
                    <form  method="post">
                        <div class="form-control">
                            <input name="username" type="text" class="form-control" placeholder="Enter Username">
                        </div>
                        <div class="input-group">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password">
                          
                            <span class="input-group-btn">
                                <button class="btn btn-primary" name="login" type="submit">Submit</button>
                            </span>
                        </div>
                        <div class="form-group">
                            <a href="forgot_password.php?forgot=<?php echo uniqid(true);?>">Forgot Password</a>
                        </div>


                    </form>

                <?php endif; ?>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">

                
                   





                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <ul class="list-unstyled">
                                <?php 

                        $query = "SELECT * FROM categories LIMIT 4";
                        $select_cateories_sidebar = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($select_cateories_sidebar)) {
                            $cat_title = $row['cat_title'];
                            $cat_id = $row['cat_id'];

                            echo "<li><a href=\"category.php?category=$cat_id\">{$cat_title}</a></li>";
                         
                        } 
                    ?>
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <?php include "includes/widget.php"; ?>

            </div>