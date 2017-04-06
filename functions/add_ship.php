<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLSt = "INSERT INTO shipping (shipcompany) VALUES ('" . mysql_real_escape_string($_REQUEST['shipcompany']) . "')";
		
	mysql_query($SQLSt);
	
	mysql_close($con);

	header("Location: ../dashboard.php?p=settings_shipping");
?>