<?php

session_start();
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include '../config.php';

$SQLSt = "DELETE FROM users WHERE id = " . $_REQUEST['id'];

mysql_query($SQLSt);

mysql_close($con);

header("Location: ../dashboard.php?p=customers_list&Emessage=1");

?>