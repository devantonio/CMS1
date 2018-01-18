<?php 
ob_start();
//more securable way connecting to the database 
	$db['db_host'] = "localhost";
	$db['db_user'] = "root";
	$db['db_pass'] = "";
	$db['db_name'] = "cms";

	foreach ($db as $key => $value) {
		define(strtoupper($key), $value);
	}

	$connection = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

	$query = "SET NAMES utf8";
	mysqli_query($connection,$query);

	if(!$connection) {
		echo "Problem connecting to the database";
	}




// $connection = mysqli_connect('localhost', 'root', '', 'cms');

// 	if($connection) {
// 		echo "we are connected";
// 	} else {
// 		echo "Problem connecting to the database";
// 	}



 ?>