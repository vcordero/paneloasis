<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	
	include '../config.php';

	$mensaje 	=	"";// Mensaje de respuesta
	$date 		=	date('Y-m-d'); // Fecha actual
	$tipo 		=	$_POST['type']; // Tipo de producto
	$actually_file 	=	""; // Archivo que se va a borrar

	// Borra el .csv
  	$directorio = '../cvs';
  	foreach(glob($directorio.'/*.*') as $file){
  		$save_file_name 	=	explode("&",$file);
		$save_file_type 	=	explode("/",$save_file_name[0]); 
		
		if($save_file_type[2]==$tipo){
			$actually_file 	=	$file;
		}else{
			$mensaje 	=	1;
		}
  	}
	  	
	// Verifica que se subiò el archivo
    if(isset($_FILES['file_cvs']['name']))
    {
    	// Directorio donde se guarda el .csv
    	$uploaddir 	= 	'../cvs/';
		$uploadfile = 	$uploaddir.$tipo.'&'.$date.'&'.basename($_FILES['file_cvs']['name']);	
		$path 		= 	substr($uploadfile,3);		

    	if (move_uploaded_file($_FILES['file_cvs']['tmp_name'], $uploadfile)) {
    		
    		// Borra de la BD
    		$sql 	= 	"DELETE FROM product WHERE type=".$tipo."";
		  	$query 	=	$mysqli->query($sql);
    		
    		// Borro del archivo
    		if($actually_file!=''){
    			unlink($actually_file);
    		}
    		
    		// Lee el nuevo archivo
    		$values 	=	array();
		   	
		   	$folder 	=	"../cvs/".$tipo.'&'.$date.'&'.$_FILES['file_cvs']['name'];
			$fp 		= 	fopen ( $folder, "r" );

			while (( $data = fgetcsv ( $fp , 100000 , "," )) !== FALSE ) { // Mientras hay líneas que leer...

			    $i = 0;
			    foreach($data as $row) {		       
			        $values[$i] =	$row;
			         $i++ ;
			    }

			    // Guardo en la BD los nuevos prouctos
			    $sql 	= 	"INSERT INTO product (image, description, retail_price,wholesale_price,type) VALUES ('".$values[0]."','".$values[1]."',".$values[2].",".$values[3].",".$tipo.")";
			  	$query 	=	$mysqli->query($sql);
			  	
			}
			fclose ( $fp ); // Cierro el archivo
			$mensaje 	= 	0;
		}else{
			$mensaje 	=  	1;
		}
    }else{
	   $mensaje 	= 	1;
    }
	
	mysql_close($con); // Cierro la Base de datos

	header("Location: ../dashboard.php?message=".$mensaje."");
?>