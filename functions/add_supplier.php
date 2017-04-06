<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLSt = "INSERT INTO suppliers (supplier, cpname, address, phone1, phone2, fax, email) VALUES ('" 
	. $_REQUEST['supplier'] . "','" 
	. $_REQUEST['cpname'] . "','" 
	. mysql_real_escape_string($_REQUEST['t1']) . "','"
	. $_REQUEST['phone1'] . "','"
	. $_REQUEST['phone2'] . "','"
	. $_REQUEST['fax'] . "','"
	. $_REQUEST['email'] . "')";
		
	mysql_query($SQLSt);

	mysql_close($con);

	header("Location: ../dashboard.php?p=suppliers_list");
?>