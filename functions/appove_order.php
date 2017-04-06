<?php

	include '../config.php';

	if(isset($_POST['order'])){
		$order_number = $_POST['order_id'];
		$SqlUpdatetOrder = "UPDATE order_web set dispenser = 1 WHERE (order_number = ".$order_number." AND id <> 0)";
		//echo $SqlUpdatetOrder;
		$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
		//echo $result_update;
		header("Location: ../dashboard.php?p=web_list");
	}

	if(isset($_POST['reinstate'])){
		$order_number = $_POST['order_id'];
		$SqlUpdatetOrder = "UPDATE order_web set dispenser = 0 WHERE (order_number = ".$order_number." AND id <> 0)";
		//echo $SqlUpdatetOrder;
		$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
		//echo $result_update;
		header("Location: ../dashboard.php?p=web_list");
	}

	if(isset($_POST['deleteorder'])){
		$order_number = $_POST['order_id'];
		$SqlUpdatetOrder = "DELETE FROM order_web WHERE order_number=".$order_number." ";
		//echo $SqlUpdatetOrder;
		$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
		//echo $result_update;
		header("Location: ../dashboard.php?p=web_list");
	}


	// Funcionas de pedidos de la app movil
	if(isset($_POST['deleteorderapp'])){
		$order_number = $_POST['order_id'];
		$SqlUpdatetOrder = "DELETE FROM order_app WHERE order_number=".$order_number." ";
		//echo $SqlUpdatetOrder;
		$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
		//echo $result_update;
		header("Location: ../dashboard.php?p=app_list");
	}

	if(isset($_POST['orderapp'])){
		$order_number = $_POST['order_id'];
		$SqlUpdatetOrder = "UPDATE order_app set dispenser = 1 WHERE (order_number = ".$order_number." AND id <> 0)";
		//echo $SqlUpdatetOrder;
		$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
		//echo $result_update;
		header("Location: ../dashboard.php?p=app_list");
	}

	if(isset($_POST['reinstateapp'])){
		$order_number = $_POST['order_id'];
		$SqlUpdatetOrder = "UPDATE order_app set dispenser = 0 WHERE (order_number = ".$order_number." AND id <> 0)";
		//echo $SqlUpdatetOrder;
		$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
		//echo $result_update;
		header("Location: ../dashboard.php?p=app_list");
	}
?>