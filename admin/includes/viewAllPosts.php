<?php 
include "delete-modal.php";

//collecting the post that is checked
if(isset($_POST['checkBoxArray'])) {//if checkbox is checked
	foreach($_POST['checkBoxArray'] as $postValueId) {//collecting all checked post ids through the foreach loop
		// echo 
		$bulk_options = $_POST['bulk_options'];//using this in a switch statement 

		switch($bulk_options) {
			case 'draft':
				
				$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";

				$update_to_draft_status = mysqli_query($connection,$query);

				confirmQuery($update_to_draft_status);

				break;

			case 'published':
				$query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";

				$update_to_published_status = mysqli_query($connection,$query);

				confirmQuery($update_to_published_status);

				break;

			case 'delete':
				$query = "DELETE FROM posts WHERE post_id = {$postValueId} ";

				$delete_post = mysqli_query($connection,$query);

				confirmQuery($delete_post);

				break;
			
			case 'clone':


				$query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";
				$select_post_query = mysqli_query($connection, $query); 

				 while($row = mysqli_fetch_assoc($select_post_query)) {
					{$post_id = $row['post_id'];
			        $post_author = $row['post_author'];
			        $post_content = $row['post_content'];
			        $post_title = $row['post_title'];
			        $post_category_id = $row['post_category_id'];
			        $post_status = $row['post_status'];
			        $post_image = $row['post_image'];
			        $post_tags = $row['post_tags'];
			        $post_comment_count = $row['post_comment_count'];
			        $post_date = $row['post_date'];}
		
			    }

			    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";

				$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(), '{$post_image}','{$post_content}','{$post_tags}', '{$post_status}' ) ";
				
				$clone_post_query = mysqli_query($connection, $query);

				if(!$clone_post_query) {
					die("QUERY FAILED" . mysqli_error($connection));
				}

				break;

		}
	}
}

?>


<form action="" method="post">
	<table class="table table-bordered table-hover">
		<div id="bulkOptionsContainer" class="col-xs-4">
			<select class="form-control" name="bulk_options" id="">
				<option value="">Select Options</option>
				<option value="published">Publish</option>
				<option value="draft">Draft</option>
				<option value="delete">Delete</option>
				<option value="clone">Clone</option>
			</select>
		</div>

		<div class="col-xs-4">
			<input type="submit" name="submit" class="btn btn-success" value="Apply">
			<a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
		</div>

                	<thead>
                		<tr>
                			<td><input type="checkbox" name="checkbox" id="selectAllBoxes"></td>
                			<th>Id</th>
                			<th>Users</th>
                			<th>Title</th>
                			<th>Category</th>
                			<th>Status</th>
                			<th>Image</th>
                			<th>Tags</th>
                			<th>Comments</th>
                			<th>Date</th>
                			<th>Post Views</th>
                			<th>View Post</th>
                			<th>Edit</th>
                			<th>Delete</th>
                			<th>Reset Post Views</th>
                		</tr>
                	</thead>
	                <tbody>

	                	<?php 

	                		//$query = "SELECT * FROM posts ORDER BY post_id DESC";
	                	//JOINING TABLES
	                	    $query = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
	                	    $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
	                	    $query .= " FROM posts ";
	                	    $query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";//posts.post_category_id = categories.cat_id"; has to be thesame in both tables to join

   							$select_posts = mysqli_query($connection, $query);

						    while($row = mysqli_fetch_assoc($select_posts)) {
						    	$post_id = $row['post_id'];
						    	$post_views_count = $row['post_views_count'];
						        $post_author = $row['post_author'];
						        $post_user = $row['post_user'];
						        $post_title = $row['post_title'];
						        $post_category_id = $row['post_category_id'];
						        $post_status = $row['post_status'];
						        $post_image = $row['post_image'];
						        $post_tags = $row['post_tags'];
						        $post_comment_count = $row['post_comment_count'];
						        $post_date = $row['post_date'];
						        $category_title = $row['cat_title'];
						        $category_id = $row['cat_id'];

						        echo "<tr>";

						        ?>
								 <!-- putting the post id that is checked into an array -->
									<td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td><!-- need to provide the specific id for the post that is checked
								    filling the empty array with ids of post we want to delete-->


								<?php 

									
								 
						        


						        echo "<td>$post_id</td>";


						        if(!empty($post_author)) {
						        	echo "<td>$post_author</td>";
						        } elseif(!empty($post_user)) {
						        	 echo "<td>$post_user</td>";
						        }
						       
						        



						        echo "<td>$post_title</td>";
						        //RELATIONAL TABLES
						      
					// if($post_category_id == 0)
     //                {
     //                    echo "<td></td>";
     //                }
     //            else
     //            {
     //                $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
     //                $select_category_id = mysqli_query($connection, $query);
     //                while($row=mysqli_fetch_assoc($select_category_id))
     //                {
     //                    $cat_id = $row['cat_id'];
     //                    $cat_title = $row['cat_title'];
     //                    echo "<td>{$cat_title}</td>";
     //                }
     //            }

// $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
//                   $select_category_id = mysqli_query($connection, $query);
 						        ;
// while ($row = mysqli_fetch_assoc($select_category_id)) {
    //$cat_title = $row['cat_title'];
 						        
 	echo "<td>";					        
    echo $category_title;
//}
echo "</td>";
						        
						        echo "<td>$post_status</td>";
						        echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
						        echo "<td>$post_tags</td>";


						        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
						        $send_comment_query = mysqli_query($connection, $query);

						        $row = mysqli_fetch_array($send_comment_query);
						        $comment_id = $row['comment_id'];
						        $count_comments = mysqli_num_rows($send_comment_query);

						        echo "<td><a href='post_comments.php?id=$post_id'>$count_comments</a></td>";

						        echo "<td>$post_date</td>";
						        echo "<td>$post_views_count</td>";
						        
						        echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
								echo "<td><a class='btn btn-info' href='posts.php?source=edit-post&p_id={$post_id}'>Edit</a></td>";

						        	?>

						        		<form method="post" action="#">
						        			<input type="hidden" name="post_id" value="<?php echo $post_id ?>">

						        			<?php 

						        				echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>'
						        			 ?>
						        		</form>

						        	<?php


						         //echo "<td><a rel='{$post_id}' class='delete-link' href='javascript:void(0)'>Delete</a></td>";//prent the pound symbol from showing in the browsers attr
						        // echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete');\" href='posts.php?delete={$post_id}'>Delete</a></td>";




						        echo "<td><a class='btn btn-danger' href='posts.php?reset={$post_id}'>Reset Post Views</a></td>";
						        echo "</tr>";
							}


	                	 ?>
	                	
	    		</tbody>
	</table>
</form>


				<?php 
//secure way
					if(isset($_POST['delete'])) {
						
								$the_post_id = escape($_POST['post_id']);

								$query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
								$delete_query = mysqli_query($connection, $query);

								header("Location: posts.php");
						
					}

					// if(isset($_GET['delete'])) {
					// 	$the_post_id = escape($_GET['delete']);

					// 	$query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
					// 	$delete_query = mysqli_query($connection, $query);

					// 	header("Location: posts.php");
					// }


					if(isset($_GET['reset'])) {
						if(isset($_SESSION['user_role'])) {
							if($_SESSION['user_role'] == 'admin') {
								$the_post_id = escape($_GET['reset']);

								$query = "UPDATE posts SET post_views_count = 0 WHERE post_id = " . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
								$reset_query = mysqli_query($connection, $query);

								header("Location: posts.php");
							}
						}
					}




				 ?>


				 <script>
				 	$(document).ready(function() {
				 		$(".delete-link").on('click', function() {
				 			var id = $(this).attr("rel");
				 			var delete_url = "posts.php?delete="+ id +"";

				 			$(".modal-delete-link").attr("href",delete_url);

				 			$("#myModal").modal('show');
				 		});
				 	});



				 </script>