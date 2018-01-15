<?php 


	


	if(isset($_POST['create_post'])) {


		$post_title = escape($_POST['title']);
		$post_author = escape($_POST['user']);
		$post_category_id = escape($_POST['post_category']);
		$post_status = escape($_POST['post_status']);
 
		$post_image = escape($_FILES['image']['name']);
		$post_image_temp = escape($_FILES['image']['tmp_name']);

		$post_tags = escape($_POST['post_tags']);
		$post_content = escape($_POST['post_content']);
		$post_date = date('d-m-y');
		//$post_comment_count = 4;

		move_uploaded_file($post_image_temp, "../images/$post_image");

		$query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";

		$query .= "VALUES({$post_category_id},'{$post_title}','{$post_author}',now(), '{$post_image}','{$post_content}','{$post_tags}', '{$post_status}' ) ";

		$create_post_query = mysqli_query($connection, $query); 




    confirmQuery($create_post_query);

    $post_id = mysqli_insert_id($connection);//pulls out last created id from the db

		echo "<p class='bg-success'>Post Added. <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";

		

		
 

	}


 ?>



<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="title">Post Title</label>
		<input type="text" class="form-control" name="title">
	</div>

	<div class="form-group">
		<label for="category">Category</label>
		<select name="post_category" id="">
	


	<?php 

		$query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirmQuery($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)) {
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];

                echo "<option value='$cat_id'>$cat_title</option>";
            }//the cat_id needs to coorespond with the cat_title in the DB
//i change /*echo "<option value=''>$cat_title</option>";*/ 
//to this /*echo "<option value='$cat_id'>$cat_title</option>";*/


	 ?>
	 	</select>
	</div>

	<!-- <div class="form-group">
		<label for="title">Post Author</label>
		<input type="text" class="form-control" name="author">
	</div> -->
	<div class="form-group">
		<label for="users">Users</label>
		<select name="user" id="">
	


	<?php 

		$query = "SELECT * FROM users";
            $select_users = mysqli_query($connection, $query);

            confirmQuery($select_users);

            while($row = mysqli_fetch_assoc($select_users)) {
                $user_id = $row['user_id'];
                $username = $row['username'];

                echo "<option value='$username'>$username</option>";
            }//the cat_id needs to coorespond with the cat_title in the DB
//i change /*echo "<option value=''>$cat_title</option>";*/ 
//to this /*echo "<option value='$cat_id'>$cat_title</option>";*/


	 ?>
	 	</select>
	</div>

	<div class="form-group">
		<select name="post_status">
			<option value="draft">Post Status</option><!--value draft so we dont see the post-->
			<option value="draft">Draft</option>
			<option value="published">Publish</option>
		</select>
		
	</div>
	
	<div class="form-group">
		<label for="post_image">Post Image</label>
		<input type="file" name="image">
	</div>

	<div class="form-group">
		<label for="post_tags">Post Tags</label>
		<input type="text" class="form-control" name="post_tags">
	</div>

	<div class="form-group">
		<label for="post_content">Post Content</label>
		<textarea class="form-control" name="post_content" id="" cols="110" rows="10"></textarea>
	</div>

	<div class="form-group">
		<input name="create_post" value="Publish Post" type="submit" class="btn btn-primary">
	</div>
</form>