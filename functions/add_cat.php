<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLSt = "INSERT INTO cats (cat) VALUES ('" . mysql_real_escape_string($_REQUEST['cat']) . "')";
		
	mysql_query($SQLSt);
	
	mysql_close($con);

	header("Location: ../dashboard.php?p=cat_list");
?>