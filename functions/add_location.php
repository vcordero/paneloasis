<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLSt = "INSERT INTO locations (location, address) VALUES ('" . mysql_real_escape_string($_REQUEST['location']) . "','" . mysql_real_escape_string($_REQUEST['t1']) . "')";
		
	mysql_query($SQLSt);
	
	mysql_close($con);

	header("Location: ../dashboard.php?p=location_list");
?>