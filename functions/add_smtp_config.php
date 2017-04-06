<?php 
	
	session_start();
	if ($_SESSION['user'] == "") {
		
		header("Location: index.php");
	}
	

	include '../config.php';
    
    
    $host_name = $_POST['host_name'];
    $port = $_POST['port'];
	$from_email = $_POST['from_email'];
    $to_admin = $_POST['to_admin'];
	$from_name = $_POST['from_name'];
	$user_name = $_POST['user_name'];
    $password = $_POST['password'];
    
   	//echo ($id);exit();
	$SQLSt = "UPDATE `smtp_config` SET ".
			"	`host_name`='".$host_name."',".
			"	`port`='".$port."',".
			"	`from_email`='".$from_email."',".
            "	`to_admin`='".$to_admin."',".
            "	`from_name`='".$from_name."',".
            "	`user_name`='".$user_name."',".
			"	`password`='".$password."'" ;
   // echo $SQLSt;exit();

	mysql_query($SQLSt) or die(mysql_error());

	mysql_close($con);

/*    
	$username 	= 	$_POST['user'];
	$message 	=	"";

	$userquery=$mysqli->query("select * from smtp_config where user='$username'") ; 
	$data=mysqli_fetch_assoc($userquery);
	$val1= $_REQUEST['type'];
	$val2 =$_REQUEST['role'];
	
	if (($data == NULL) or ($val1 == NULL) or ($val2 == NULL)){
		//significa que ese username no existe en la bd. es valido.

     
		$SQLSt = "INSERT INTO smtp_config (user, password, email, phone,type,role, note) VALUES ('" 
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
    */
	
    
    header("Location: ../dashboard.php?p=add_smtp&message=".$message."");
	
?>