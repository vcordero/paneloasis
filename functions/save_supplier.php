<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLSt = "UPDATE suppliers SET supplier = '"
	. $_REQUEST['supplier'] . "', cpname = '" 
	. $_REQUEST['cpname'] . "', address = '" 
	. mysql_real_escape_string($_REQUEST['t1']) . "', phone1 = '" 
	. $_REQUEST['phone1'] . "', phone2 = '" 
	. $_REQUEST['phone2'] . "', fax = '" 
	. $_REQUEST['fax'] . "', email = '"	
	. $_REQUEST['email'] . "' WHERE id= " . $_REQUEST['id'];
		
	mysql_query($SQLSt);

	mysql_close($con);

	header("Location: ../dashboard.php?p=suppliers_list");
?>