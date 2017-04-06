<?php
	

	include 'config.php';
	//$SqlStat = "SELECT * FROM customers where email like('%hotmail%') ORDER BY id DESC";

	$SqlStat = "SELECT * FROM users ";


	$result = mysql_query($SqlStat);
	//$result_row = mysql_fetch_array($result);

	$newArray = array();

	while($row = mysql_fetch_array($result)) {
	   $newArray[] = $row;
	}

	//$prueba[0]="silma";
	//$prueba[1]="Jesus";
	header('Content-type: application/json; charset=utf-8');
	echo json_encode($newArray);

   //echo json_encode($row);
 


?>