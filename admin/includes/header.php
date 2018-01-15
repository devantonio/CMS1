<?php ob_start(); ?><!--output buffering//we will need this when we are redirecting users//this is in charge of buffering our request in the headers of the script that way when we are done with the script it will send everything at the same time-->
<?php ini_set('max_execution_time', 123456); ?>
<?php include "../includes/db.php"; ?>
<?php include "../functions.php"; ?>

<?php session_start(); ?><!--to use the data we collect from login.php-->

<?php 

if(!isset($_SESSION['user_role'])) {
    header("Location: /cms_template");
}


 ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>
    

    <!-- Bootstrap Core CSS -->
    <link href="/cms_template/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    

    <link href="./css/loader.css" rel="stylesheet">

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    
    <script src="js/jquery.js"></script>
    
    
</head>
<body>

    <div id="wrapper">
