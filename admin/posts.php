<!-- PROCEDRUAL PHP
 -->
<?php include "includes/header.php" ?>


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
                        //echo $source;
                	} else {
                		$source = "";
                	}

                	switch ($source) {
                		case 'add_post':
                			include "includes/add-post.php";
                			break;
                		
                		case 'edit-post':
                			include "includes/edit-post.php";
                			break;

                		case '200':
                			echo "nice 200";
                			break;

                			default:
                			include "includes/viewAllPosts.php";
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
