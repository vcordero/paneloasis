<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	

	include '../config.php';

	$username 	= 	$_POST['user'];
	$message 	=	"";

	$userquery=$mysqli->query("select * from users where user='$username'") ; 
	$data=mysqli_fetch_assoc($userquery);
	$val1= $_REQUEST['type'];
	$val2 =$_REQUEST['role'];
	
	if (($data == NULL) or ($val1 == NULL) or ($val2 == NULL)){
		//significa que ese username no existe en la bd. es valido.

     
		$SQLSt = "INSERT INTO users (user, password, email, phone,type,role, note) VALUES ('" 
		. $_REQUEST['user'] . "','" 
		. $_REQUEST['password'] . "','"
		. $_REQUEST['email'] . "','"
		. $_REQUEST['phone'] . "','"
		. $_REQUEST['type'] . "','"
		. $_REQUEST['role'] . "','"
		
		. mysql_real_escape_string($_REQUEST['t3']) . "')";
		
		$sql=mysql_query($SQLSt);
	
      if($sql){
        $message=1;
      }else{
        $message=2;
      }
    }else{
		$message=3;
    }
	
    
    header("Location: ../dashboard.php?p=new_user&message=".$message."");
	
?>