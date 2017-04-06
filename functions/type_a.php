<?php
	

	include '../config.php';
	//$SqlStat = "SELECT * FROM customers where email like('%hotmail%') ORDER BY id DESC";

	$SqlStat = "SELECT * FROM users where role = 1";


	$result = mysql_query($SQLsts);
	$row = mysql_fetch_row($result);

 	var_dump($row);exit();
   echo json_encode($row);
 


?>