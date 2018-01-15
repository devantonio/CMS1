<?php 

	if(isset($_POST['create_user'])) {


        $username = escape($_POST['username']);
        $user_password = escape($_POST['user_password']);
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_email = escape($_POST['user_email']);
        // $user_image = ['user_image']);
        $user_role = escape($_POST['user_role']);

        $user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost'=> 10));

		$query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";

		$query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}' ) ";

		$add_user_query = mysqli_query($connection, $query); 

		confirmQuery($add_user_query);

		echo "User Created: " . " " . "<a href='users.php'>View Users</a> ";
 

	}


 ?>



<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">
		<label for="firstname">Firstname</label>
		<input type="text" class="form-control" name="user_firstname">
	</div>
	
	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input type="text" name="user_lastname" class="form-control">
	</div>


	<div class="form-group">
		<label>User Role</label>
		<br>
		<select name="user_role" id="">
			<option value="subscriber">Select Options</option>
			<option value="admin">Admin</option>
			<option value="subscriber">Subcriber</option>
		</select>
		<br>
		<br>

	<div class="form-group">
		<label for="username">Username</label>
		<input type="text" class="form-control" name="username">
	</div>

<!-- 	<div class="form-group">
		<label for="user_image">User Image</label>
		<input type="file" class="form-control" name="user_image">
	</div>
 -->
	
	<div class="form-group">
		<label for="user_password">Password</label>
		<input type="text" class="form-control" name="user_password">
	</div>

	<div class="form-group">
		<label for="email">Email</label>
		<input type="text" class="form-control" name="user_email">
	</div>


	<div class="form-group">
		<input name="create_user" value="Add User" type="submit" class="btn btn-primary">
	</div>
</form>