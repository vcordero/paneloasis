<?php 
	
	include '../config.php';

	$mensaje 	=	"";// Mensaje de respuesta
	
	if(isset($_POST['email'])){
	 	// Busco que el correo no exista.
	 	$sql 	= 	"SELECT * FROM mail WHERE description='".$_POST['email']."'";
	  	$query 	=	$mysqli->query($sql);

	  	if($query->num_rows==0){
	  		// Guardo en la BD el nuevo correo
		    $sql 		= 	"INSERT INTO mail (description) VALUES ('".$_POST['email']."')";
		  	$query 		=	$mysqli->query($sql);
		  	$mensaje 	=	0;
		  }else{
		  	$mensaje 	=	1;
		  }
	 	
	}else{
		$mensaje 	=	1;
	}

	
	mysql_close($con); // Cierro la Base de datos

	header("Location: ../dashboard.php?p=settings_general&message=".$mensaje."");
?>