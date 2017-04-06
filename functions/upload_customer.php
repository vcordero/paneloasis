<?php 
	
	
	include '../config.php';

	$mensaje 	=	"";// Mensaje de respuesta
	$tipo 		=	$_POST['type']; // Tipo de producto
 	$directorio = '../import'; // Directorio donde se guarda el archivo csv temporalmente
 
	// Verifica que se subiò el archivo
    if(isset($_FILES['import_cvs']['name']))
    {
    	// Directorio donde se guarda el .csv
    	$uploaddir 	= 	'../import/';
		$uploadfile = 	$uploaddir.basename($_FILES['import_cvs']['name']);	
		$path 		= 	substr($uploadfile,3);		

    	if (move_uploaded_file($_FILES['import_cvs']['tmp_name'], $uploadfile)) {
    		
  
    		$values 	=	array();
		   	$folder 	=	$uploadfile;
			$fp 		= 	fopen ( $folder, "r" );

			while (( $data = fgetcsv ( $fp , 100000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...

			    $i = 0;
			    foreach($data as $row) {		       
			        $values[$i] =	$row;
			         $i++ ;
			    }

			    // Guardo en la BD los nuevos prouctos
			    $sql 	= 	"INSERT INTO users (user,password,email,type,role) VALUES ('".$values[1]."','".$values[2]."','".$values[3]."',2,".$tipo.")";
			  	$query 	=	$mysqli->query($sql);
			  	
			}
			fclose ( $fp ); // Cierro el archivo
			unlink($uploadfile); // lo borro de la carpeta
    		
		}else{
			$mensaje 	=  	1;
		}
    }else{
	   $mensaje 	= 	1;
    }
	
	mysql_close($con); // Cierro la Base de datos

	header("Location: ../dashboard.php?p=customers_import&message=".$mensaje."");
?>