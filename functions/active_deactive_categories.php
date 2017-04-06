<?php

	include '../config.php';

	/*if(isset($_POST['order'])){
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
	}*/

	if(isset($_POST['deletecat'])){
		$cat_number = $_POST['cat_id'];
		$SqlUpdatetOrder = "UPDATE cats set photo = '".$_POST['photo']."' WHERE id = ".$cat_number."";
		//echo $SqlUpdatetOrder;
		$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
		//echo $result_update;
		header("Location: ../dashboard.php?p=select_categories");
	}

	if(isset($_POST['changecategories'])){
	

		$SqlStat = "SELECT  * FROM cats ORDER BY id ASC";
		$result = mysql_query($SqlStat);

		while($categories = mysql_fetch_array($result)) {
			//echo $categories['id'].'<br>';

			if(in_array($categories['id'], $_POST['category'])){
			  //echo  $categories['id'].' was checked! <br>';
				$SqlUpdatetOrder = "UPDATE cats set active_app = 'y' WHERE id =" .$categories['id']." ";
				//echo $SqlUpdatetOrder;
				$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
			}else{
				//echo  $categories['id'].' NO was checked! <br>';
				$SqlUpdatetOrder = "UPDATE cats set active_app = 'n' WHERE id =" .$categories['id']." ";
				//echo $SqlUpdatetOrder;
				$result_update = mysql_query($SqlUpdatetOrder) or die("Error en: " . mysql_error());
			}
		}
		
		header("Location: ../dashboard.php?p=select_categories");
		
	}
?>