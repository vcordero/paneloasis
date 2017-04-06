<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	$password1 = $_REQUEST['password'];
	$password2 = $_REQUEST['repassword'];
	if (($password1 != $password2) or ($password1 ==NULL)){
		$error = "ERRRORRRRRR";
		//var_dump($error);exit();
	}else{
		//var_dump($_SESSION['user']);exit();
		$SQLSt = "UPDATE users SET password = '". $password1. "' 
		where user = '" .$_SESSION['user']."'";
		mysql_query($SQLSt);
		mysql_close($con);
	}


	header("Location: ../dashboard.php");
?>