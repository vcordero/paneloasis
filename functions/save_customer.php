<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	//$username = $_POST['username'];
	//$password = $_POST['password'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$note = $_POST['t3'];
	$role = $_POST['group2'];
	if (isset($_SESSION['newid'])){
		$id = $_SESSION['newid'];
	}
	//echo ($id);exit();
	$SQLSt = "UPDATE `users` SET ".
			"	`email`='".$email."',".
			"	`phone`='".$phone."',".
			"	`note`='".$note."',".
			"	`role`=".$role."".
			"	 WHERE id = ".$id." ";
   // echo $SQLSt;exit();

	mysql_query($SQLSt) or die(mysql_error());

	mysql_close($con);

	header("Location: ../dashboard.php?p=customers_list&message=2");
?>