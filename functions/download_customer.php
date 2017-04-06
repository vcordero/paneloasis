<?php 
		
	include '../config.php';

	$mensaje 	=	"";// Mensaje de respuesta
	$tipo 		=	$_POST['type']; // Tipo de producto
	$name 		= 	""; // Nombre de salida del archivo

	if($tipo==1){
		$name 	=	"Clientes A";
	}elseif ($tipo==2) {
		$name 	=	"Clientes B";
	}else{
		$name 	=	"Clientes C";
	}
	

 	$SqlConsult = 	"SELECT * FROM users WHERE role = ".$tipo." ";
	$resultado 	= 	mysql_query($SqlConsult);

		if (!$resultado) die('Couldn\'t fetch records');
			$num_fields = 	mysql_num_fields($resultado);
			$headers 	= 	array();
		for ($i = 0; $i < $num_fields; $i++) {
		    $headers[] = mysql_field_name($resultado , $i);
		}

		$fp = fopen('php://output', 'w');
		if ($fp && $resultado) {

		    header('Content-Type: text/csv');
		    header('Content-Disposition: attachment; filename="'.$name.'".csv"');
		    header('Pragma: no-cache');
		    header('Expires: 0');
		    fputcsv($fp, $headers);

		    while ($row = mysql_fetch_array($resultado,MYSQLI_NUM)){
		        fputcsv($fp, array_values($row));
		    }
		    die;

		    $mensaje =	0;
		}else{
			 $mensaje =	1;
		}
			
	
	mysql_close($con); // Cierro la Base de datos

	header("Location: ../dashboard.php?p=customers_export&message=".$mensaje."");
		
?>