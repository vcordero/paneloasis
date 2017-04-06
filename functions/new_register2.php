<?php 
	
	session_start();

	include '../config.php';


	$email 		= 	$_POST['email'];
	$phone		= 	$_POST['phone'];
	$username 	= 	$_POST['username'];
	$pass 		= 	$_POST['pass'];
	
	// Comparo las claves

	$userquery=$mysqli->query("select * from users where user='$username'") ; 
	$data=mysqli_fetch_assoc($userquery);
	
	if ($data==NULL){
		//significa que ese username no existe en la bd. es valido.
		$SQLSt = "INSERT INTO users (user,password,email,phone,type,role) VALUES ('".$username."','".$pass."','". $email."','". $phone."',2,1)";
		$sql=mysql_query($SQLSt);
	
      if($sql){
        $_SESSION['message']=1; // exitoso
        
      }else{
        $_SESSION['message']=2; // problemas insertando el usuario
        
      }
    }else{
		$_SESSION['message']=3; // existe el usuario
		
    }
	
	
    
    header("Location: ../index.php");
	
?>