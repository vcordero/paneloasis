<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';
	
	$SQLsts = "SELECT * FROM items WHERE id=" . $_REQUEST['item'];
	$result = mysql_query($SQLsts);
	$row = mysql_fetch_row($result);
	
	
	$totalPrice = floatval($row[4]) * floatval($_REQUEST['quantity']);
	$totalQuantity = intval($row[11]) - intval($_REQUEST['quantity']);
	$profit = (floatval($row[4]) - floatval($row[3])) * floatval($_REQUEST['quantity']);
	
	$SQLSt2 = "INSERT INTO sales (customer, selldate, location, item, quantity, totalprice, note, profit) VALUES ('" 
	. $_REQUEST['customer'] . "','" 
	. $_REQUEST['selldate'] . "','" 
	. $_REQUEST['location'] . "','"
	. $row[1] . "',"
	. $_REQUEST['quantity'] . ","
	. floatval($totalPrice)  . ",'"
	. mysql_real_escape_string($_REQUEST['t1']) . "',"
	. $profit . ")";
		
	mysql_query($SQLSt2);
	
	$SQLSt3 = "UPDATE items SET quantity =" . $totalQuantity . " WHERE id=" . $_REQUEST['item'];;
	mysql_query($SQLSt3);

	mysql_close($con);

	header("Location: ../dashboard.php?p=sales_list");
?>