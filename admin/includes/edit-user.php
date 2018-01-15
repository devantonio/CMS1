<?php 

	if(isset($_GET['u_id'])) {
		 $u_id = escape($_GET['u_id']);
		 
	

	//echo " <br>id: ";  echo $u_id;
	$query = "SELECT * FROM users WHERE user_id = $u_id";
	$select_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users)) {
    	$user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
	}



	if(isset($_POST['update_user'])) {

		$username = escape($_POST['username']);
        $user_firstname = escape($_POST['user_firstname']);
        $user_lastname = escape($_POST['user_lastname']);
        $user_email = escape($_POST['user_email']);
        $user_password = escape($_POST['user_password']);
        // $user_image = ['user_image'];
        $user_role = escape($_POST['user_role']);

    	if(!empty($user_password)) {

    		$query_password = "SELECT user_password FROM users WHERE user_id = $u_id";
    		$get_user = mysqli_query($connection, $query_password);

    		confirmQuery($get_user);

    		$row = mysqli_fetch_array($get_user);
    		$db_user_password = $row['user_password'];
    	

	    	if($db_user_password != $user_password) {
	    		$hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
	    	}



		$query = "UPDATE users SET ";
		$query .="username = '{$username}', ";
		$query .="user_firstname = '{$user_firstname}', ";
		$query .="user_lastname = '{$user_lastname}', ";
		$query .="user_email = '{$user_email}', ";
		$query .="user_password = '{$hashed_password}', ";
		$query .="user_role = '{$user_role}' ";
		$query .="WHERE user_id = {$user_id} ";


		$update_user = mysqli_query($connection, $query);

		confirmQuery($update_user);

		echo "User Updated" . " <a href='users.php'>View Users</a>";
		
		}
	}
	
} else {
		header("Location: index.php");
	}
?>





<form action="" method="post" enctype="multipart/form-data">
	<div class="form-group">
		<label for="firstname">Firstname</label>
		<input value="<?php echo $user_firstname; ?>" type="text" class="form-control" name="user_firstname">
	</div>




	<div class="form-group">
		<label for="lastname">Lastname</label>
		<input value="<?php echo $user_lastname;?>" type="text" class="form-control" name="user_lastname">
	</div>

	<div class="form-group">
		<label for="username">Username</label>
		<input value="<?php echo $username;?>" type="text" class="form-control" name="username">
	</div>
	


<div class="form-group">
		<label>User Role</label>
		<br>
		<select name="user_role" id="">
	
			<option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
<?php

	if($user_role == 'admin') {
		echo "<option value='subscriber'>subscriber</option>";
	} else {
		echo "<option value='admin'>admin</option>";
	}


?>
		   
		</select>
		<br>
		<br>



	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" class="form-control" value="<?php echo $user_email;?>" name="user_email">
		
	</div>

	<div class="form-group">
		<label for="password">Password</label>
		<input type="password" class="form-control" value="<?php echo $user_password;?>" name="user_password">
		
	</div>

	
	<div class="form-group">
		<input name="update_user" value="Update User" type="submit" class="btn btn-primary">
	</div>
</form>