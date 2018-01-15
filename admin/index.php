<?php include "includes/header.php" ?>



<div id="page-wrapper">

    <?php if($connection) { echo "conn"; } ?>
    <!-- Navigation -->
        <?php include "includes/nav.php" ?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin

                    <small><?php echo $_SESSION['username']; ?></small>
                </h1>

               
                
            </div>
        </div>
        <!-- /.row -->





    <!-- /.row -->
    
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-text fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                

                                    
                                    

                                <div class='huge'><?php echo $post_counts = recordCount('posts'); ?></div>
                                 


                          
                                <div>Posts</div>
                            </div>
                        </div>
                    </div>
                    <a href="posts.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">

                                   <div class='huge'><?php echo $comment_counts = recordCount('comments'); ?></div>

                              <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    <a href="comments.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-user fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                            
                                 <div class='huge'><?php echo $user_counts = recordCount('users'); ?></div>


                                <div> Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="users.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-list fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                
                               <div class='huge'><?php echo $category_counts = recordCount('categories'); ?></div>


                                 <div>Categories</div>
                            </div>
                        </div>
                    </div>
                    <a href="categories.php">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
                        <!-- /.row -->


        <?php 
            // $query = "SELECT * FROM posts WHERE post_status = 'published'";
            // $select_all_published_posts = mysqli_query($connection,$query);
            // $post_published_count = mysqli_num_rows($select_all_published_posts);

           $post_published_count = checkStatus('posts','post_status','published');


            // $query = "SELECT * FROM posts WHERE post_status = 'draft'";
            // $select_all_draft_posts = mysqli_query($connection,$query);
            $post_draft_count = checkStatus('posts','post_status','draft');

            // $query = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
            // $unapproved_comments_query = mysqli_query($connection,$query);
            $unnaproved_comment_count = checkStatus('comments','comment_status','unapproved');

            // $query = "SELECT * FROM users WHERE user_role = 'subscriber'";
            // $select_all_subcribers = mysqli_query($connection,$query);
            $user_subscriber_count = checkStatus('users','user_role','subscriber');                                        

         ?>



        <div class="row">
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

            
<?php

$element_text = ['All Posts', 'Active Posts', 'Draft Posts', 'Categories', 'Users', 'Comments', 'Pending Comments', 'Subscribers'];

$element_count = [$post_counts, $post_published_count, $post_draft_count, $category_counts, $user_counts, $comment_counts, $unnaproved_comment_count, $user_subscriber_count];

for($i = 0; $i < 8; $i++) {

echo "['$element_text[$i]'" . "," . "$element_count[$i]],";

}

?>
//[ 'fff', 444],
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: '',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
}
    </script>

    <div id="columnchart_material" style="width: 100%; height: 500px;"></div>
</div>










    </div>
    <!-- /.container-fluid -->

    



</div>
<!-- /#page-wrapper -->



<?php include "includes/footer.php" ?>
