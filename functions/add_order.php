<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLsts = "SELECT * FROM items WHERE id=" . $_REQUEST['item'];
	$result = mysql_query($SQLsts);
	$row = mysql_fetch_row($result);
	
	
	$totalCost = floatval($row[3]) * floatval($_REQUEST['quantity']);
	$totalQuantity = intval($row[11]) + intval($_REQUEST['quantity']);
	
	$SQLSt2 = "INSERT INTO orders (supplier, issuedate, receiptdate, location, trackref, shipby, item, quantity, note, totalcost) VALUES ('" 
	. $_REQUEST['supplier'] . "','" 
	. $_REQUEST['issuedate'] . "','" 
	. $_REQUEST['receiptdate'] . "','"
	. $_REQUEST['location'] . "','"
	. $_REQUEST['trackref'] . "','"
	. $_REQUEST['shipby'] . "','"
	. $row[1] . "',"
	. $_REQUEST['quantity'] . ",'"
	. mysql_real_escape_string($_REQUEST['t1']) . "',"
	. floatval($totalCost) . ")";
		
	mysql_query($SQLSt2);
	
	$SQLSt3 = "UPDATE items SET quantity =" . $totalQuantity . " WHERE id=" . $_REQUEST['item'];
	mysql_query($SQLSt3);
	
	mysql_close($con);

	header("Location: ../dashboard.php?p=orders_list");
?>