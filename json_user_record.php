<?php

	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}

	include 'config.php';




	///Metodo para retornar todos los datos ne formato JSON
	if(isset($_GET['json']))
	{
		$query = $mysqli->query("select * from user_record where type='estimate' group by invoice_id");
		//$row_json = $query_json->fetch_assoc();

		$aaData = array();
		while ($row = mysqli_fetch_assoc($query)) {
		    $aaData[] = $row;
		}

		$response = array(
		  'aaData' => $aaData,
		  'iTotalRecords' => count($aaData),
		  'iTotalDisplayRecords' => count($aaData)
		);
		echo json_encode($response);
	}




	//Metodo para retornar todos los datos de un estimate 
	if(isset($_GET['invoice_id']))
	{

		$invoice_id = $_GET['invoice_id'];

		echo "<style type='text/css'>
			  	table tr:nth-child(odd) td {background-color: #D1E6E6;}
			  	table tr:nth-child(even) td {background-color: #f6f6f6;}
			  </style>";

		echo "<table>
			<thead>

					<tr>			
						<th> Invoice ID</th>			
						<th> Invoice Number</th>
						<th> Type</th>
						<th> Date</th>
						<th> Description</th>												
					</tr>

				</thead>
		";

		echo "<tbody>";

		$query_all = $mysqli->query("select * from user_record where invoice_id='$invoice_id' ");
		

		while($row_all = $query_all->fetch_assoc())
		{
							
			$invoice_id = $row_all['invoice_id'];					
			$invoice_no = $row_all['invoice_number'];
			$customer = $row_all['customer'];
			$type = $row_all['type'];
			$date = $row_all['date'];
			$description = $row_all['description'];
			

			echo "<tr>	
					<td>$invoice_id</td>
					<td>$invoice_no</td>					
					<td>$type</td>
					<td>$date</td>
					<td>$description</td>					
				</tr>
									  
			";
		}

		echo "</tbody></table>";
	
	}

	
?>