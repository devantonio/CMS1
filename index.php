<?php include "includes/header.php";?>

    <!-- Navigation -->
<?php include "includes/nav.php";?>




    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php 




                    if(isset($_GET['page'])) {
                       echo $page = escape($_GET['page']);
                    } else {
                        $page = "";//if GET is not set to page, declare page variable so we dont get error 
                    }

                    if($page == "" || $page == 1) {
                        $page_1 = 0;//page 1 
                    } else {
                        $page_1 = ($page * 5) - 5;
                    }

                    if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
                       $post_query_count = "SELECT * FROM posts";
                    } else {
                         $post_query_count = "SELECT * FROM posts WHERE post_status = 'published'";
                    }

                    
                    $find_count = mysqli_query($connection, $post_query_count);
                    $count = mysqli_num_rows($find_count);//number of post

                    if($count < 1) {
                        echo "<h1 class='text-center'>No Posts Yet.</h1>";
                    } else {

                    $count = ceil($count / 5);//divide the number of posts by the number of posts we want on a page 


                    $query = "SELECT * FROM posts LIMIT $page_1, 5";//$page_1 is the
                    $select_all_posts_query = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($select_all_posts_query)) {
                        $post_title = $row['post_title'];
                        $post_id = $row['post_id'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content = substr($row['post_content'], 0,350);//making an excerpt
                        $post_status = $row['post_status'];

                        
                           
                        
                        
                     
                    
                ?>
                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_posts.php?author=<?php echo $post_author ?>&p_id=<?php echo $post_id; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="images/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>
             <?php } }  //else {

            //     header("Location: index.php");
 echo $_SERVER['REQUEST_URI']; 
            // } ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php";?>

        </div>
        <!-- /.row -->

        <hr>


        <ul class="pager">
            
            <?php 
                for($i = 1; $i <= $count; $i++) { //loop through the number of posts thats divided by five which is 3 in this case

                    if($i == $page) {//$i is constantly looping so if $i is on the same number that page is on
                        echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";
                    } else { //if $i is not on the same number $page is on 
                        echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                    }
                }

             ?>
        </ul>
 <!-- Footer -->

<?php include "includes/footer.php";?>