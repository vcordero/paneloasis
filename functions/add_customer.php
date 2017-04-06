<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLSt = "INSERT INTO customers (customer, cpname, baddress, phone1, phone2, fax, email, saddress, note) VALUES ('" 
	. $_REQUEST['customer'] . "','" 
	. $_REQUEST['cpname'] . "','" 
	. mysql_real_escape_string($_REQUEST['t1']) . "','"
	. $_REQUEST['phone1'] . "','"
	. $_REQUEST['phone2'] . "','"
	. $_REQUEST['fax'] . "','"
	. $_REQUEST['email'] . "','"
	. mysql_real_escape_string($_REQUEST['t2']) . "','"
	. mysql_real_escape_string($_REQUEST['t3']) . "')";
		
	mysql_query($SQLSt);

	mysql_close($con);

	header("Location: ../dashboard.php?p=customers_list");
?>