<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLSt = "UPDATE items SET item = '"
	. $_REQUEST['item'] . "', itcode = '" 
	. $_REQUEST['itcode'] . "', uncost = " 
	. $_REQUEST['uncost'] . ", unprice = " 
	. $_REQUEST['unprice'] . ", cat = '" 
	. $_REQUEST['cat'] . "', itdesc = '"	
	. mysql_real_escape_string($_REQUEST['t1']) . "', itweb = '"
	. $_REQUEST['itweb'] . "', unmeasure = '"
	. $_REQUEST['unmeasure'] . "', supplier = '"
	. $_REQUEST['supplier'] . "', itnote = '"
	. mysql_real_escape_string($_REQUEST['t2']) 
	. "' WHERE id= " . $_REQUEST['id'];
		
	mysql_query($SQLSt);

	mysql_close($con);
	
	header("Location: ../dashboard.php?p=items_list");
?>