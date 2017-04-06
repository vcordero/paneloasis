<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include '../config.php';

$SQLSt = "DELETE FROM sales WHERE id = " . $_REQUEST['id'];

mysql_query($SQLSt);

mysql_close($con);

header("Location: ../dashboard.php?p=sales_list");

?>