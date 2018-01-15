<!-- PROCEDRUAL PHP
 -->
<?php include "includes/header.php" ?>

<?php 
    if(is_admin($_SESSION['username'])){
        header("Location: index.php");

    }
    
 ?>
<!-- Navigation -->
<?php include "includes/nav.php" ?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin
                    <small>Author</small>
                </h1>

                <?php 

                	if(isset($_GET['source'])){
                		$source = escape($_GET['source']);
                        echo $source;
                	} else {
                		$source = "";
                	}

                	switch ($source) {
                		case 'add_user':
                			include "includes/add-user.php";
                			break;
                		
                		case 'edit-user':
                			include "includes/edit-user.php";
                			break;

                		case '200':
                			echo "nice 200";
                			break;

                			default:
                			include "includes/view_all_users.php";
                	}


                 ?>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>
