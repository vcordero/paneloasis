<?php


if(!isset($_SESSION)): 
        session_start(); 
    endif;
if ($_SESSION['user'] == "") {
	
	header("Location: index.php");
}

include '../config.php';

$SQLSt = "DELETE FROM users WHERE id = " . $_REQUEST['id'];

mysql_query($SQLSt);

mysql_close($con);
if (isset($_SESSION['back'])){
	if ($_SESSION['back'] == "ALL") {
		
	header("Location: ../dashboard.php?p=customers_list&message=1");
	}elseif ($_SESSION['back'] == "A") {
		
	header("Location: ../dashboard.php?p=list_users_a&message=1");
	}elseif ($_SESSION['back'] == "B") {
		
	header("Location: ../dashboard.php?p=list_users_b&message=1");
	}elseif ($_SESSION['back'] == "C") {
		
	header("Location: ../dashboard.php?p=list_users_c&message=1");
	}
}else{
	header("Location: ../dashboard.php?p=customers_list&message=1");

}


?>