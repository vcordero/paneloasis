<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLSt = "INSERT INTO items (item, itcode, uncost, unprice, cat, itdesc, itweb, unmeasure, supplier, quantity,itnote) VALUES ('" 
	. $_REQUEST['item'] . "','" 
	. $_REQUEST['itcode'] . "'," 
	. $_REQUEST['uncost'] . ","
	. $_REQUEST['unprice'] . ",'"
	. $_REQUEST['cat'] . "','"
	. mysql_real_escape_string($_REQUEST['t1']) . "','"
	. $_REQUEST['itweb'] . "','"
	. $_REQUEST['unmeasure'] . "','"
	. $_REQUEST['supplier'] . "','"
        
                . $_REQUEST['quantity'] . "','"
	. mysql_real_escape_string($_REQUEST['t2']) . "')";
		
	mysql_query($SQLSt);

	mysql_close($con);

	header("Location: ../dashboard.php?p=items_list");
?>